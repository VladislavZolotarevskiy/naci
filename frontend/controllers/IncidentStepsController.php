<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Incident;
use frontend\models\IncidentSteps;
use frontend\models\IncidentStepsRefImportance;
use frontend\models\Snapshot;
use frontend\models\User;
use frontend\models\IncidentStepsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use DateTime;

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
     * Lists all IncidentSteps models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentStepsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
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
        //add old incident info to model                
        if ($ref_type_steps_id ==2 || $ref_type_steps_id ==3){
            $old_step = IncidentSteps::oldIncidentStep($incident_id);
            $model->res_person = $old_step['res_person'];
            $model->message = $old_step['message'];
            $importance->ref_importance_id = $old_step['ref_importance_id'];
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $importance->incident_steps_id = $model->id;
            $importance->load(Yii::$app->request->post());
            $importance->save();
            $incident = Incident::findOne($incident_id);
        //if importance is critical change incident->type 1=2
            if ($importance->ref_importance_id == 4) {
                $incident->type = 2;
                $incident->save();
            }
        //if opened step change status to open    
            if ($model->ref_type_steps_id == 1) {
                $incident->status = 2;
                $incident->save();
            }
        //if closeded status change status to closed and calculate duration/stoppage    
            elseif ($model->ref_type_steps_id == 3) {
                $incident->status = 3;
                $incident->duration = $this->convertTimestamp(strtotime($model->clock) - strtotime($model->needlessTime($model->incident_id, 1)['clock']));
                $incident->stoppage = $this->convertTimestamp($this->serviceStopped($model->incident_id));
                $incident->save();
            }
        //use no-send marker    
            if ($model->no_send == 1) {
                return $this->redirect([
                '/incident/view',
                    'id' => $incident_id]);
            }
            return $this->redirect([
                'send',
                'incident_steps_id' => $model->id,
                'ref_importance_id' => $importance->ref_importance_id,
                'inc_number' => Incident::findOne($incident_id)['inc_number'],
                ]);
        }    
        return $this->render('create', [
            'model' => $model,
            'importance' => $importance,
            'ref_type_steps_id' => $ref_type_steps_id,
            'old_step' => $old_step,
            'inc_number' => Incident::findOne($incident_id)['inc_number']                
        ]);
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
        foreach($arr as $item) {
            switch ($item->ref_type_steps_id){
                //открытие
                case 1:
                    //если сервис встал начинаем отсчет
                    if ($item->service_stop_marker == 1) {
                        $begin_time =  strtotime($item->clock);
                        break;
                    }
                    break;
                //дополнение    
                case 2:
                    //если сервис встал
                    if ($item->service_stop_marker == 1) {
                        //если переменная с началом не пуста, считаем простой иначе начинаем отсчет
                        if ($begin_time == null){
                            $begin_time =  strtotime($item->clock);
                            break;
                        }
                        $result += strtotime($item->clock) - $begin_time;
                        break;
                    }
                    //если сервис в работе и переменная с началом не пуста, значит считаем простой и обнуляем переменную с началом простоя
                    if (!$begin_time == null) {
                        $result += strtotime($item->clock) - $begin_time;
                        $begin_time = null;
                    }
                    break;
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
            return $this->redirect(['send',
                'incident_steps_id' => $model->id,
                'ref_importance_id' => $importance->ref_importance_id,
                'inc_number' => $incident['inc_number']]);
        }

        return $this->render('update', [
            'model' => $model,
            'importance' => $importance,
            'inc_number' => $incident['inc_number'],
            'son_of_a_dog' => $this->convertTimestamp($this->serviceStopped($model->incident_id))
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
    
    public function actionSend($ref_importance_id, $incident_steps_id, $inc_number)
    {
        $model = $this->findModel($incident_steps_id);
        $snapshot = new Snapshot;
        if ($model->load(Yii::$app->request->post(), '') &&
                $snapshot->load(Yii::$app->request->post())){
            $phone_array = explode("\r\n", $snapshot->phone);
            $mail_array = explode("\r\n", $snapshot->email);
            $model->no_send = 2;
            if ($ref_importance_id == 4){
                $array = [
                    'phone' => $phone_array,
                    'mail' => $mail_array  
                ];
                $model->snapshot = json_encode($array, JSON_FORCE_OBJECT);
                $model->save();
            }
            else {
                $array = [
                    'phone' => $phone_array
                ];
                $model->snapshot = json_encode($array, JSON_FORCE_OBJECT);
                $model->save();
            }
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
            'inc_number' => $inc_number    
        ]);
        }    
    }
    public function actionSnapshot($incident_steps_id,$ref_importance_id) {
        $model = $this->findModel($incident_steps_id);
        $this->layout = '/no_menu';
        return $this->render('snapshot',[
            'model' => $model,
            'ref_importance_id' => $ref_importance_id   
        ]);
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
}
