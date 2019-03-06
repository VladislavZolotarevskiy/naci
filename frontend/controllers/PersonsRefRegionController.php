<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefRegion;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * PersonsRefRegionController implements the CRUD actions for PersonsRefRegion model.
 */
class PersonsRefRegionController extends SiteController
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
     * Creates a new PersonsRefRegion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id)
    {
        $model = new PersonsRefRegion();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::to('../persons/view/'.$person_id));
        }
        else {
            return $this->render('create', [
            'model' => $model,
            'person_id' => $person_id,    
            ]);
        }
    }
    
    /**
     * Deletes an existing PersonsRefRegion model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$person_id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Url::to('../persons/view/'.$person_id));
    }
    /**
     * Finds the PersonsRefRegion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefRegion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefRegion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
