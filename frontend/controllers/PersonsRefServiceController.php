<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefServiceRefImportance;
use frontend\models\PersonsRefServiceRefRegion;
use frontend\models\PersonsRefService;
use frontend\models\PersonsRefServiceRefCity;
use frontend\models\PersonsRefServiceRefPlace;
use frontend\models\FakeImportance;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\Response;
use yii\widgets\ActiveForm;

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

   public function actionCreate($person_id=null)
    {   
        $person_ref_service = new PersonsRefService();
        $fake_importance = new FakeImportance();
        $fake_company = new \frontend\models\FakeCompany;
        $request = Yii::$app->request;
        if ($request->isAjax && $request->isGet) {
            //$person_id=$request->post()['person_id'];
            $fake_company->load($request->get());
            return $this->renderAjax('create', [
                 'person_ref_service' => $person_ref_service,
                 'fake_company' => $fake_company,
                 'fake_importance' => $fake_importance,
                 'person_id' => $person_id
                ]);
        }
        if ($person_ref_service->load($request->post())
                && $person_ref_service->save()
                && $fake_importance->load($request->post())) {
            PersonsRefServiceRefImportance::createImportance([
                    'fake_importance_low' => $fake_importance->low,
                    'fake_importance_middle' => $fake_importance->middle,
                    'fake_importance_high' => $fake_importance->high,
                    'fake_importance_critical' => $fake_importance->critical,
                    'person_ref_service_id' => $person_ref_service->id
                    ]);
            return $this->redirect(Url::previous('persons-view'));
        }
    }

    public function actionPerformAjaxValidation()
    {
        $model = new PersonsRefService();
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
            'model' => $model,
        ]);
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
