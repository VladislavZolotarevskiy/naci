<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefCompany;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * PersonsRefCompanyController implements the CRUD actions for PersonsRefCompany model.
 */
class PersonsRefCompanyController extends SiteController
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
     * Creates a new PersonsRefCompany model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id)
    {  
        $model = new PersonsRefCompany();
        $request = Yii::$app->request;
        if ($request->isPost && $model->load($request->post())) {
            $model->persons_id = $person_id;
            $model->save();
            return $this->redirect(Url::previous('persons-view'));
        }
        else {
            return $this->renderAjax('create', [
                'model' => $model,
                'person_id' => $person_id,
            ]);
        }
    }    
    public function actionPerformAjaxValidation($person_id)
    {
        $model = new PersonsRefCompany();
        $model->persons_id = $person_id;
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous('persons-view'));
        }

        return $this->renderAjax('update', [
            'model' => $model
        ]);
    }
    
    /**
     * Deletes an existing PersonsRefCompany model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Url::previous('persons-view'));
    }    

    /**
     * Finds the PersonsRefCompany model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefCompany the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefCompany::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
