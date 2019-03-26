<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefPlace;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * PersonsRefPlaceController implements the CRUD actions for PersonsRefPlace model.
 */
class PersonsRefPlaceController extends SiteController
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
     * Creates a new PersonsRefPlace model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id)
    {
        $model = new PersonsRefPlace();
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
     * Deletes an existing PersonsRefPlace model.
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
     * Finds the PersonsRefPlace model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefPlace the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefPlace::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
