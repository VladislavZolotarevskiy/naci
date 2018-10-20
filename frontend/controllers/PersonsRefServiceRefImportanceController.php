<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefServiceRefImportance;
use frontend\models\PersonsRefServiceRefImportanceSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonsRefServiceRefImportanceController implements the CRUD actions for PersonsRefServiceRefImportance model.
 */
class PersonsRefServiceRefImportanceController extends SiteController
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
     * Lists all PersonsRefServiceRefImportance models.
     * @return mixed
     */
    public function actionIndex($person_ref_service_id = null)
    {
        if (!$person_ref_service_id == null){
            $importance = PersonsRefServiceRefImportance::importanceList(
                    ['person_ref_service_id' => $person_ref_service_id]);
            return $this->render('importance', [
                'importance_list' => $importance,
                'person_ref_service_id' => $person_ref_service_id,
            ]);
        }
        else {
        $searchModel = new PersonsRefServiceRefImportanceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        }
    }

    /**
     * Displays a single PersonsRefServiceRefImportance model.
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
     * Creates a new PersonsRefServiceRefImportance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_ref_service_id = null)
    {
        $model = new PersonsRefServiceRefImportance();

        if (!$person_ref_service_id == null){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect([
                    'index',
                    'person_ref_service_id' => $person_ref_service_id]);
            }

            else {
                return $this->render('create', [
                'model' => $model,
                'person_ref_service_id' => $person_ref_service_id,    
            ]);
            }    
        }
        
        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        else {
            return $this->render('create', [
            'model' => $model,
            ]);
        }    
    }

    /**
     * Updates an existing PersonsRefServiceRefImportance model.
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
     * Deletes an existing PersonsRefServiceRefImportance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $person_ref_service_id = null)
    {
        $this->findModel($id)->delete();

        if (!$person_ref_service_id == null){
            return $this->redirect(['index', 'person_ref_service_id' => $person_ref_service_id]);
        }
        else {
            return $this->redirect(['index']);
        }
    }    

    /**
     * Finds the PersonsRefServiceRefImportance model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefServiceRefImportance the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefServiceRefImportance::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
