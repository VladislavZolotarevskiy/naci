<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Incident;
use frontend\models\IncidentSteps;
use frontend\models\IncidentStepsRefImportance;
use frontend\models\Snapshot;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * IncidentStepsController implements the CRUD actions for IncidentSteps model.
 */
class IncidentStepsController extends SiteController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Displays a single IncidentSteps model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $importance = IncidentStepsRefImportance::findOne([
            'incident_steps_id' => $model->id
            ]);
        return $this->render('view', [
            'model' => $model,
            'importance' => $importance,
        ]);
    }

    /**
     * Creates a new IncidentSteps model.
     * If creation is successful creates a new IncidentStepsRefImportance model.
     * If $no_send = 1 the browser will be redirected to the 'view' page.
     * Else the browser will be redirected to the 'send' page.
     * @return mixed
     */
    public function actionCreate($incident_id, $ref_type_steps_id)
    {
        $model = new IncidentSteps();
        $importance = new IncidentStepsRefImportance;
        $model->super_person = User::fullName();
        $model->clock = date('Y-m-d H:i:s');
        $model->incident_id = $incident_id;
        $model->ref_type_steps_id = $ref_type_steps_id;
        $old_step = null;
        $incident = Incident::findOne($incident_id);
        //add old incident info to model                
        if ($ref_type_steps_id ==2 || $ref_type_steps_id ==3){
            $old_step = IncidentSteps::oldIncidentStep($incident_id);
            $model->res_person = $old_step['res_person'];
            $model->message = $old_step['message'];
            $importance->ref_importance_id = $old_step['ref_importance_id'];
        }
        //POST
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $importance->incident_steps_id = $model->id;
            $importance->load(Yii::$app->request->post());
            $importance->save();
        //if importance is critical change incident->type 1=2
            if ($importance->ref_importance_id == 4) {
                $incident->type = 2;
                $incident->save();
            }
        //switch ref_type_steps_id
            switch ($model->ref_type_steps_id){
                case 1:
                    $incident->status = 2;
                    $incident->save();
                    break;
                case 3:
                    $incident->status = 3;
                    $incident->duration = $this->convertTimestamp(strtotime($model->clock) - strtotime($model->needlessTime($model->incident_id, 1)['clock']));
                    $incident->stoppage = $this->convertTimestamp($this->serviceStopped($model->incident_id));
                    $incident->save();
                    break;
            }
        //use no-send marker    
            if ($model->no_send == 1) {
                return $this->redirect([
                '/incident/view',
                    'id' => $incident_id]);
            }
            $this->snapshotCreate($model->id,$importance->ref_importance_id,$old_step);
            return $this->redirect([
                'send',
                'incident_steps_id' => $model->id,
                'ref_importance_id' => $importance->ref_importance_id
                ]);
        }    
        elseif (Yii::$app->request->isAjax) {
            $model->clock = Yii::$app->request->get()['IncidentSteps']['clock'];
            $importance->ref_importance_id = Yii::$app->request->get()['IncidentStepsRefImportance']['ref_importance_id'];
            $model->res_person = Yii::$app->request->get()['IncidentSteps']['res_person'];
            $model->message = Yii::$app->request->get()['IncidentSteps']['message'];
            return $this->renderAjax('create', [
                'incident_id' => $incident_id,
                'model' => $model,
                'importance' => $importance,
                'ref_type_steps_id' => $ref_type_steps_id,
                'old_step' => $old_step,
                'inc_number' => $incident->inc_number,
                'incident' => $incident
        ]); 
        }
        return $this->render('create', [
            'model' => $model,
            'importance' => $importance,
            'incident_id' => $incident_id,
            'ref_type_steps_id' => $ref_type_steps_id,
            'old_step' => $old_step,
            'inc_number' => $incident->inc_number,
            'incident' => $incident            
        ]);
    }
    
    public function actionPerformAjaxValidationStep ($incident_id,$ref_type_steps_id) {
        $model = $model = new IncidentSteps();
        $model->super_person = User::fullName();
        $model->incident_id = $incident_id;
        $model->ref_type_steps_id = $ref_type_steps_id;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    

    /**
     * Updates an existing IncidentSteps model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $importance = IncidentStepsRefImportance::findOne([
            'incident_steps_id' => $model->id
            ]);
        $incident = Incident::findOne($model->incident_id);
        if ($model->load(Yii::$app->request->post()) && $model->save() &&
                $importance->load(Yii::$app->request->post()) 
                && $importance->save()) {
            if ($importance->ref_importance_id == 4) {
                $incident->type = 2;
                $incident->save();
            }
            else {
                $incident->type = 1;
                $incident->save();
            }    
            if ($model->no_send == 1) {
                return $this->redirect([
                '/incident/view',
                    'id' => $model->incident_id]);
            }
            if ($model->ref_type_steps_id == 3) {
                $incident->duration = $this->convertTimestamp(strtotime($model->clock) - strtotime($model->needlessTime($model->incident_id, 1)['clock']));
                $incident->stoppage = $this->convertTimestamp($this->serviceStopped($model->incident_id));
                $incident->save();
            }
            $this->snapshotCreate($model->id,$importance->ref_importance_id,IncidentSteps::oldIncidentStep($model->incident_id));
            return $this->redirect(['send',
                'incident_steps_id' => $model->id,
                'ref_importance_id' => $importance->ref_importance_id]);
        }
        elseif (Yii::$app->request->isAjax) {
            $model->clock = Yii::$app->request->get()['IncidentSteps']['clock'];
            $importance->ref_importance_id = Yii::$app->request->get()['IncidentStepsRefImportance']['ref_importance_id'];
            $model->res_person = Yii::$app->request->get()['IncidentSteps']['res_person'];
            $model->message = Yii::$app->request->get()['IncidentSteps']['message'];
            return $this->renderAjax('update', [
                'model' => $model,
                'incident_id' => $incident->id,
                'ref_type_steps_id' => $model->ref_type_steps_id,
                'importance' => $importance,
                'inc_number' => $incident->inc_number,
                'incident' => $incident
            ]);
        }    
        return $this->render('update', [
            'model' => $model,
            'incident_id' => $incident->id,
            'ref_type_steps_id' => $model->ref_type_steps_id,
            'importance' => $importance,
            'inc_number' => $incident->inc_number,
            'incident' => $incident
        ]);
    }

    /**
     * Deletes an existing IncidentSteps model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionSend($ref_importance_id, $incident_steps_id)
    {
        $model = $this->findModel($incident_steps_id);
        $snapshot = new Snapshot;
        $incident_step = (IncidentSteps::incidentStep($incident_steps_id));
        $incident = Incident::findOne(['id'=>$incident_step->incident_id]);
        $contacts = json_decode($model['snapshot'],true);
        $text = $model->createText($model);
        $email = IncidentStepsMailController::mailCreate($model,$text['title']);
        if (Yii::$app->request->post()){
            $model->no_send = 2;
            $model->save();
            $snapshot = json_decode($model->snapshot, true);
            $snapshot['message'][0]['text'] = $text['text'];
            $model->snapshot = json_encode($snapshot, JSON_FORCE_OBJECT);
            //shell_exec('/opt/shitov/jshon/naci_sms_send.sh '.'\''.$model->snapshot.'\'');
            return $this->redirect(['/incident/view',
                'id' => $model->incident_id,    
            ]);
        }
        else {
            return $this->render('send', [
            'ref_importance_id' => $ref_importance_id,
            'incident_steps_id' => $incident_steps_id,
            'model' => $model,
            'snapshot' => $snapshot,
            'inc_number' => $incident->inc_number,  
            'contacts' => $contacts,
            'text' => $text,
            'email' => $email
        ]);
        }    
    }
      
    public function actionSnapshot($incident_steps_id,$ref_importance_id) {
        $model = $this->findModel($incident_steps_id);
        return $this->renderAjax('snapshot',[
            'model' => $model,
            'ref_importance_id' => $ref_importance_id   
        ]);
    }
    public function actionSnapshotAdd($incident_steps_id,$contact_type){
        //get model incident_step
        $incident_steps_model = $this->findModel($incident_steps_id);
        $snapshot_model = new Snapshot;
        //get current snapshot
        $current_snapshot = json_decode($incident_steps_model->snapshot, true);
        if (!isset($current_snapshot['phone'])){
            $current_snapshot['phone'] = [];}
        if (!isset($current_snapshot['mail'])){
            $current_snapshot['mail'] = [];}
        $snapshot_model->type = $contact_type;
        $snapshot_model->incident_steps_snapshot = $current_snapshot;
        if ($snapshot_model->load(Yii::$app->request->post())) {
            //add 
            if ($contact_type == 1) {
                $new_item = [
                    'type' => 'моб. телефон',
                    'contact' => Yii::$app->request->post()['Snapshot']['contact'],
                    'contacts_id' => 0,
                    'persons_id' => 0,
                    'persons_full_name' => Yii::$app->request->post()['Snapshot']['persons_full_name'],
                ];
            array_push($current_snapshot['phone'],$new_item);
            //$current_snapshot = ['phone' => $current_snapshot['phone']];
            }
            elseif ($contact_type == 2) {
                $new_item = [
                    'type' => 'e-mail',
                    'contact' => Yii::$app->request->post()['Snapshot']['contact'],
                    'contacts_id' => 0,
                    'persons_id' => 0,
                    'persons_full_name' => Yii::$app->request->post()['Snapshot']['persons_full_name'],
                ];
                array_push($current_snapshot['mail'],$new_item);
//            $current_snapshot = [
//                'phone' => $current_snapshot['phone'],
//                'mail' => $current_snapshot['mail']];
            }
            $incident_steps_model->snapshot = json_encode($current_snapshot, JSON_FORCE_OBJECT);
            $incident_steps_model->save();
            return $this->redirect(Url::previous('incident-steps-send'));
        }
        return $this->renderAjax('_add-snapshot-form',[
            'snapshot_model' => $snapshot_model,
            'incident_steps_model' => $incident_steps_model
        ]);
    }
    public function actionSnapshotDelete($incident_steps_id,$id,$contact_type){
        $incident_steps_model = $this->findModel($incident_steps_id);
        $current_snapshot = json_decode($incident_steps_model->snapshot, true);
        if ($contact_type == 1) {
            unset($current_snapshot['phone'][$id]);
            ksort($current_snapshot['phone']);
        }
        elseif ($contact_type == 2) {
            unset($current_snapshot['mail'][$id]);
            ksort($current_snapshot['mail']);
        }
        $incident_steps_model->snapshot = json_encode($current_snapshot, JSON_FORCE_OBJECT);
        $incident_steps_model->save();
        return $this->redirect(Url::previous('incident-steps-send'));
        
    }
    
    public function actionPerformAjaxValidationSnapshot()
    {
        $model = new Snapshot();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Finds the IncidentSteps model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncidentSteps the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncidentSteps::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    /**
     * calculate time to stopped service
     */
    private function serviceStopped($incident_id) {
        $arr = IncidentSteps::find()
        ->select('id, service_stop_marker, clock, ref_type_steps_id')
        ->where(['incident_id' => $incident_id])
        ->orderBy('clock ASC')
        ->all();
        $begin_time = null;
        $result  = null;
        foreach($arr as $item) {
            switch ($item->ref_type_steps_id){
                //steps_1
                case 1:
                    //if service stopped then starting count
                    if ($item->service_stop_marker == 1) {
                        $begin_time =  strtotime($item->clock);
                        break;
                    }
                    else { break; }
                //steps_2    
                case 2:
                    //if service stopped
                    if ($item->service_stop_marker == 1) {
                        //if var not null count result, else starting count
                        if ($begin_time == null){
                            $begin_time = strtotime($item->clock);
                            break;
                        }
                        else {
                            $result += strtotime($item->clock) - $begin_time;
                            $begin_time = strtotime($item->clock);//тот самый момент, когда 2 дополнения подряд не могут посчитать корректно время простоя
                            break;
                        }    
                    }
                    //if service work and var not null, then count result and reset count
                    else {
                        if (!$begin_time == null) {
                        $result += strtotime($item->clock) - $begin_time;
                        $begin_time = null;
                        break;
                        }
                        else {
                        break;
                        }
                    }    
                // steps 3    
                case 3:
                    if (!$begin_time == null){
                        $result += strtotime($item->clock) - $begin_time;
                        break;
                    }
                    break;
            }
        }
        return $result;
    }
    /*
     * calculate timestamp to HH:MM:SS
     * var - timestamp
     * return hh:mm:ss
     */
    private function convertTimestamp($timestamp){
        $hour = intdiv($timestamp, 3600);
        $min = intdiv(($timestamp%3600), 60);
        $sec = $timestamp%60;
        $arr = [
            1 => $hour,
            2 => $min,
            3 => $sec];
        $i = 1;
        $result = '';
        //add zero in begin
        foreach ($arr as $item) {
            if ($item < 10){
                if ($item == 0){
                    $item = '00';
                }
                else {
                    $item = '0'.$item;
                }    
            }
            if ($i == 1) {
                $result .= $item;
            }
            else {
                $result .= ':'.$item;
            }
            $i += $i;
        }
        return $result;
    }
    
    private function snapshotCreate ($incident_steps_id,$ref_importance_id,$old_step) {
        $model = $this->findModel($incident_steps_id);
        $incident = Incident::findOne(['id'=>$model->incident_id]);
        $contacts_phone = IncidentSteps::contacts($incident->id,$ref_importance_id,1);
        $previous_snapshot = json_decode($old_step['snapshot'], true);
        if (($incident->ref_company_id === 1)||($incident->ref_company_id === 3)) {
            $header = 'NORNIK';
        }
        elseif ($incident->ref_company_id === 2) {
            $header = 'NN.EDINSTVO';
        }
        $message = [
            0 => [
                'text' => $model->message,
                'sms_header' => $header,]
        ];
        if ($ref_importance_id == 4) {
            $contacts_mail = IncidentSteps::contacts($incident->id,$ref_importance_id,2);
            if ($model->ref_type_steps_id == 2 || $model->ref_type_steps_id == 3){
                if (isset($previous_snapshot['phone'])) {
                $contacts_phone = $this->deltaArrayAdd($previous_snapshot['phone'], $contacts_phone);
                }
                if (isset($previous_snapshot['mail'])) {
                $contacts_mail = $this->deltaArrayAdd($previous_snapshot['mail'], $contacts_mail);
                }
                $array = [
                    'message' => $message,
                    'phone' => $contacts_phone,
                    'mail' => $contacts_mail];
                }
            else {
                $array = [
                    'message' => $message,
                    'phone' => $contacts_phone,
                    'mail' => $contacts_mail];
            }
        }    
        else {
            if ($model->ref_type_steps_id == 2 || $model->ref_type_steps_id == 3){
                $contacts_phone = $this->deltaArrayAdd($previous_snapshot['phone'], $contacts_phone);
                $array = [
                    'message' => $message,
                    'phone' => $contacts_phone,
                ];
            }
            elseif ($model->ref_type_steps_id == 1){
                $array = [
                    'message' => $message,
                    'phone' => $contacts_phone];
            }
        }    
        $model->snapshot = json_encode($array, JSON_FORCE_OBJECT);
        $model->save();
    }
    
    private function deltaArrayAdd ($firstArray,$secondArray) {
        if (isset($firstArray)) {
            foreach ($firstArray as $item){
                if ($item['contacts_id'] == 0){
                    array_push($secondArray, $item); 
                }
            }
                ksort($secondArray);
        }
        return $secondArray;
    }
}