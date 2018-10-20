<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IncidentRefPlace;
use frontend\models\IncidentRefPlaceSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncidentRefPlaceController implements the CRUD actions for IncidentRefPlace model.
 */
class IncidentRefPlaceController extends SiteController
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
     * Lists all IncidentRefPlace models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentRefPlaceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IncidentRefPlace model.
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
     * Creates a new IncidentRefPlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   public function actionCreate($incident_id = null)
    {
        $model = new IncidentRefPlace(['scenario' => 'without_db']);;
        $session = Yii::$app->session;
        $session->open();   
        if (Yii::$app->request->post()){
            $ref_place_id = Yii::$app->request->post()['IncidentRefPlace']['ref_place_id'];
            $session['ref_place_id'] = $ref_place_id;
            $session['marker'] = ++$session['marker'];
            return $this->redirect(['/incident-ref-service/create']);
        }
        else {
           return $this->render('create', [
            'model' => $model, 
            ]);
            }       
    }    
    /**
     * Updates an existing IncidentRefPlace model.
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
     * Deletes an existing IncidentRefPlace model.
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
     * Finds the IncidentRefPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncidentRefPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncidentRefPlace::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
