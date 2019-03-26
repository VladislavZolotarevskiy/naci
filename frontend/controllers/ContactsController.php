<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Contacts;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends SiteController
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
     * Displays a single Contacts model.
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
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id=NULL)
    { 
        $request = Yii::$app->request;
        $model = new Contacts();
        if ($model->load($request->post()) && $model->save()) {
            return $this->redirect(Url::to('../persons/view/'.$model->id_person));
        }
        else {
            if ($person_id == NULL) {
                $model->load($request->get());
                return $this->renderAjax('create',[
                'model' => $model,
                'person_id' => $model->id_person
                ]);
            }
            else {
                return $this->renderAjax('create',[
                'model' => $model,
                'person_id' => $person_id
                ]);
            }    
        }
        
    }
    public function actionPerformAjaxValidation()
    {
        $model = new Contacts();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous('persons-view'));
        }

        return $this->renderAjax('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Contacts model.
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
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
