<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefServiceRefImportance;
use yii\helpers\Url;
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
    public function actionImportance($person_ref_service_id)
    {
        $importance = PersonsRefServiceRefImportance::importanceList(
                ['person_ref_service_id' => $person_ref_service_id]);
        return $this->render('importance', [
            'importance_list' => $importance,
            'person_ref_service_id' => $person_ref_service_id,
        ]);
    }
    
    /**
     * Creates a new PersonsRefServiceRefImportance model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_ref_service_id)
    {
        $model = new PersonsRefServiceRefImportance();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect([
                'importance',
                'person_ref_service_id' => $person_ref_service_id]);
        }
        else {
            return $this->render('create', [
            'model' => $model,
            'person_ref_service_id' => $person_ref_service_id,    
            ]);
        }    
    }

    /**
     * Deletes an existing PersonsRefServiceRefImportance model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Url::previous('persons-service-importance'));
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
