<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IncidentRefCity;
use frontend\models\IncidentRefCitySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncidentRefCityController implements the CRUD actions for IncidentRefCity model.
 */
class IncidentRefCityController extends SiteController
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
     * Lists all IncidentRefCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentRefCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IncidentRefCity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new IncidentRefCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IncidentRefCity(['scenario' => 'without_db']);
        $session = Yii::$app->session;
        $session->open();   
        if (Yii::$app->request->post()){
            $ref_city_id = Yii::$app->request->post()['IncidentRefCity']['ref_city_id'];
            $session['ref_city_id'] = $ref_city_id;
            $session['marker'] = ++$session['marker'];
            return $this->redirect(['/incident-ref-service/create']);
        }
        else {
           return $this->render('create', [
            'model' => $model, 
            ]);
            }       
    }    
//    {
//        $model = new IncidentRefCity();
//        if (!$incident_id == null) {
//            if (Yii::$app->request->post()){
//                $incident_id = Yii::$app->request->post()['IncidentRefCity']['incident_id'];
//                $ref_city_id = Yii::$app->request->post()['IncidentRefCity']['ref_city_id'];
//                if (is_array($ref_city_id)){
//                    foreach ($ref_city_id as $item){
//                        $model = new IncidentRefCity;
//                        $model->incident_id = $incident_id;
//                        $model->ref_city_id = $item;
//                        $model->save();
//                }
//                return $this->redirect(['/incident-ref-place/create', 'incident_id' => $incident_id]);
//                }
//            else {
//                    $model->save();
//                    return $this->redirect(['/incident-ref-place/create', 'incident_id' => $incident_id]);
//                }    
//            }
//            else {
//                return $this->render('create', [
//                'model' => $model,
//                'incident_id' => $incident_id,    
//                ]);
//            }
//        }
//        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        else {
//            return $this->render('create', [
//            'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing IncidentRefCity model.
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
     * Deletes an existing IncidentRefCity model.
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
     * Finds the IncidentRefCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncidentRefCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncidentRefCity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
