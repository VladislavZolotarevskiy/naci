<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IncidentRefService;
use frontend\models\IncidentRefServiceSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncidentRefServiceController implements the CRUD actions for IncidentRefService model.
 */
class IncidentRefServiceController extends SiteController
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
     * Lists all IncidentRefService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentRefServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IncidentRefService model.
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
     * Creates a new IncidentRefService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IncidentRefService(['scenario' => 'without_db']);;
        $session = Yii::$app->session;
        $session->open();   
        if (Yii::$app->request->post()){
            $ref_service_id = Yii::$app->request->post()['IncidentRefService']['ref_service_id'];
            $session['ref_service_id'] = $ref_service_id;
            $session['marker'] = ++$session['marker'];
            //return $this->redirect(['/incident/create']);
        }
        else {
           return $this->render('create', [
            'model' => $model, 
            ]);
            }       
    }    
//        $model = new IncidentRefService();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        return $this->render('create', [
//            'model' => $model,
//        ]);

    /**
     * Updates an existing IncidentRefService model.
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
     * Deletes an existing IncidentRefService model.
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
     * Finds the IncidentRefService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncidentRefService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncidentRefService::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
