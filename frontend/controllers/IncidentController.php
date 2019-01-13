<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Incident;
use frontend\models\IncidentSteps;
use frontend\models\IncidentRefRegion;
use frontend\models\IncidentRefCity;
use frontend\models\IncidentRefService;
use frontend\models\IncidentRefPlace;
use frontend\models\IncidentSearch;
use yii\helpers\Url;
use frontend\models\TTicketSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * IncidentController implements the CRUD actions for Incident model.
 */
class IncidentController extends SiteController
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
     * Lists all Incident models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->layout = 'main-collapse';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Incident model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $tticketSearchModel = new TTicketSearch(['incident_id' => $id]);
        $tticketDataProvider = $tticketSearchModel
                ->search(Yii::$app->request->queryParams);
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
            'tticketSearchModel' => $tticketSearchModel,
            'tticketDataProvider' => $tticketDataProvider,
        ]);
    }
    
    
    /**
     * Creates a new Incident model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($ref_company_id=NULL)
    {
        
        $session = Yii::$app->session;
        $session->open();
        $model_incident = new Incident();
        if ($ref_company_id !== NULL) {
        $find = \frontend\models\RefCompany::findOne(['name' => $ref_company_id]);    
        $model_incident->ref_company_id = $find->id;}
        $model_incident_ref_city = new IncidentRefCity();
        $model_incident_ref_region = new IncidentRefRegion();
        $model_incident_ref_place = new IncidentRefPlace();
        $model_incident_ref_service = new IncidentRefService();
        if (Yii::$app->request->post() && !Yii::$app->request->isAjax) {
            $session->destroy();
            $session['open'] = true;
            $session['ref_company_id'] = Yii::$app->request->post()['Incident']['ref_company_id'];
            $session['ref_city_id'] = Yii::$app->request->post()['IncidentRefCity']['ref_city_id'];
            $session['ref_region_id'] = Yii::$app->request->post()['IncidentRefRegion']['ref_region_id'];
            $session['ref_place_id'] = Yii::$app->request->post()['IncidentRefPlace']['ref_place_id'];
            $session['ref_service_id'] = Yii::$app->request->post()['IncidentRefService']['ref_service_id'];
            Url::remember();
            return $this->redirect('preview');
        }
        elseif (Yii::$app->request->isAjax) {
            //Yii::$app->response->format = Response::FORMAT_JSON;
            //$model_incident->ref_company_id = Yii::$app->request->post()['Incident']['ref_company_id'];
            $model_incident->load(Yii::$app->request->post());
            $model_incident_ref_city->load(Yii::$app->request->post());
            $model_incident_ref_region->load(Yii::$app->request->post());
            $model_incident_ref_place->load(Yii::$app->request->post());
            $model_incident_ref_service->load(Yii::$app->request->post());
            return 
                $this->renderAjax('create', [
                'model_incident' => $model_incident,
                'model_incident_ref_city' => $model_incident_ref_city,
                'model_incident_ref_region' => $model_incident_ref_region,
                'model_incident_ref_place' => $model_incident_ref_place,
                'model_incident_ref_service' => $model_incident_ref_service,
            ]);
        }
        else {
            return $this->render('create', [
                'model_incident' => $model_incident,
                'model_incident_ref_city' => $model_incident_ref_city,
                'model_incident_ref_region' => $model_incident_ref_region,
                'model_incident_ref_place' => $model_incident_ref_place,
                'model_incident_ref_service' => $model_incident_ref_service,
            ]);
        }    
    }
    
    public function actionPreview() {
        $session = Yii::$app->session;
        $model_incident = new Incident(); 
        //$model_incident_ref_city = new IncidentRefCity();
        $model_incident_ref_region = new IncidentRefRegion();
        $model_incident_ref_place = new IncidentRefPlace();
        $model_incident_ref_service = new IncidentRefService();
        $model_incident->ref_company_id = $session['ref_company_id'];
        
        if (Yii::$app->request->post()){
            $model_incident->save();
            foreach($session['ref_region_id'] as $region_id){
            $model_incident_ref_region = new IncidentRefRegion();
            $model_incident_ref_region->incident_id = $model_incident->id;
            $model_incident_ref_region->ref_region_id = $region_id;
            $model_incident_ref_region->save();
            }    
            foreach($session['ref_city_id'] as $city_id){
                $model_incident_ref_city = new IncidentRefCity();
                $model_incident_ref_city->incident_id = $model_incident->id;
                $model_incident_ref_city->ref_city_id = $city_id;
                $model_incident_ref_city->save();
            }    
            foreach($session['ref_place_id'] as $place_id){
                $model_incident_ref_place = new IncidentRefPlace();
                $model_incident_ref_place->incident_id = $model_incident->id;
                $model_incident_ref_place->ref_place_id = $place_id;
                $model_incident_ref_place->save();
            }    
            foreach($session['ref_service_id'] as $service_id){
                $model_incident_ref_service = new IncidentRefService();
                $model_incident_ref_service->incident_id = $model_incident->id;
                $model_incident_ref_service->ref_service_id = $service_id;
                $model_incident_ref_service->save();
            }
            $session->destroy();
            return $this->redirect(['/incident-steps/create',
            'incident_id' => $model_incident->id,
            'ref_type_steps_id' => 1,
        ]);
        }
        else {
            $period = date('Y');
            $model_incident->inc_number = $this->incNumber($period, 
                    $model_incident->ref_company_id);
            $model_incident->period = $period;

            $model_incident_ref_region = new IncidentRefRegion();
            $model_incident_ref_region->ref_region_id_multiply = Incident::
                    printRegions($session['ref_region_id']);

            $model_incident_ref_city = new IncidentRefCity();
            $model_incident_ref_city->ref_city_id_multiply = Incident::
                    printCities($session['ref_city_id']);

            $model_incident_ref_place = new IncidentRefPlace();
            $model_incident_ref_place->ref_place_id_multiply = Incident::
                    printPlaces($session['ref_place_id']);

            $model_incident_ref_service = new IncidentRefService();
            $model_incident_ref_service->ref_service_id_multiply = Incident::
                    printServices($session['ref_service_id']);

            return $this->render('preview',[
                'model_incident_ref_region' => $model_incident_ref_region,
                'model_incident_ref_city' => $model_incident_ref_city,
                'model_incident_ref_place' => $model_incident_ref_place,
                'model_incident_ref_service' => $model_incident_ref_service,
                'model_incident' => $model_incident
                ]);
        }
    }
    
    private function incNumber ($period, $ref_company_id) {
            $result = Incident::find()
                    ->where(['period' => $period])
                    ->andWhere(['ref_company_id'=>$ref_company_id])
                    ->max('inc_number')+1;
    return $result;
    }

    public function actionOpen() {
            $session = Yii::$app->session;
            if ($session['open'] == true) {
                $model_incident = new Incident(); 
                $model_incident_ref_city = new IncidentRefCity();
                $model_incident_ref_region = new IncidentRefRegion();
                $model_incident_ref_place = new IncidentRefPlace();
                $model_incident_ref_service = new IncidentRefService();
                $model_incident->ref_company_id = $session['ref_company_id'];
                $period = date('Y');
                $model_incident->inc_number = Incident::find()
                        ->where(['period' => $period])
                        ->andWhere(['ref_company_id'=>$model_incident->ref_company_id])
                        ->max('inc_number')+1;
                $model_incident->period = $period;
                $model_incident->save();
                foreach($session['ref_region_id'] as $region_id){
                    $model_incident_ref_region = new IncidentRefRegion();
                    $model_incident_ref_region->incident_id = $model_incident->id;
                    $model_incident_ref_region->ref_region_id = $region_id;
                    $model_incident_ref_region->save();
                }    
                foreach($session['ref_city_id'] as $city_id){
                    $model_incident_ref_city = new IncidentRefCity();
                    $model_incident_ref_city->incident_id = $model_incident->id;
                    $model_incident_ref_city->ref_city_id = $city_id;
                    $model_incident_ref_city->save();
                }    
                foreach($session['ref_place_id'] as $place_id){
                    $model_incident_ref_place = new IncidentRefPlace();
                    $model_incident_ref_place->incident_id = $model_incident->id;
                    $model_incident_ref_place->ref_place_id = $place_id;
                    $model_incident_ref_place->save();
                }
                foreach($session['ref_service_id'] as $service_id){
                    $model_incident_ref_service = new IncidentRefService();
                    $model_incident_ref_service->incident_id = $model_incident->id;
                    $model_incident_ref_service->ref_service_id = $service_id;
                    $model_incident_ref_service->save();
                }
                $session->destroy();
                return $this->redirect(['/incident-steps/create',
                    'incident_id' => $model_incident->id,
                    'ref_type_steps_id' => 1,
                ]);
            }
            else {
                return $this->redirect('site/error');
            }
    }

        /**
     * Updates an existing Incident model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Incident model.
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
    
        /**
     * Finds the Incident model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Incident the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Incident::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
