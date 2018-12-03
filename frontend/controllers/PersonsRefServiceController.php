<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefServiceRefImportance;
use frontend\models\PersonsRefService;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PersonsRefServiceController implements the CRUD actions for PersonsRefService model.
 */
class PersonsRefServiceController extends SiteController
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

   public function actionCreate($person_id)
    {
        $model = new PersonsRefService();
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous('persons-view'));
        }
        else {
            return $this->render('create', [
            'model' => $model,
            'person_id' => $person_id,
            ]);    
        }
    }

    /**
     * Deletes an existing PersonsRefService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        PersonsRefServiceRefImportance::deleteAll(['persons_ref_service_id' => $id]);
        $this->findModel($id)->delete();
        return $this->redirect(Url::previous('persons-view'));
    }
        
    /**
     * Finds the PersonsRefService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefService::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
