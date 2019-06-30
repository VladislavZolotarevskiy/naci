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

   public function actionCreate($person_id)
    {   
        $person_ref_service = new PersonsRefService();
        $person_ref_service->persons_id = (int)$person_id;
        $fake_company = new \frontend\models\FakeCompany;
        $fake_importance = new FakeImportance();
        $fake_importance->low = 0;
        $fake_importance->middle = 0;
        $fake_importance->high = 1;
        $fake_importance->critical = 1;
        if (Yii::$app->request->isGet === true) {
            //if (Yii::$app->request->post()) {
                $fake_company->load(Yii::$app->request->get());
                //$person_id = Yii::$app->request->post()['person_id'];
                //$fake_importance->load(Yii::$app->request->post());
            //}
            return $this->renderAjax('create', [
                'person_ref_service' => $person_ref_service,
                'fake_company' => $fake_company,
                'fake_importance' => $fake_importance,
                'person_id' => $person_id
            ]); 
        }
        elseif ($person_ref_service->load(Yii::$app->request->post()) &&
                $fake_importance->load(Yii::$app->request->post()) &&
                $person_ref_service->save()) {
            if ($fake_importance->low === 1) { 
                $person_ref_service_ref_importance = new PersonsRefServiceRefImportance();
                $person_ref_service_ref_importance->ref_importance_id = 1;
                $person_ref_service_ref_importance->person_ref_service_id = $person_ref_service->id;
                //die;var_dump($person_ref_service_ref_importance);
                $person_ref_service_ref_importance->save();
            }
            return var_dump($fake_importance);//$this->redirect(Url::to('../persons/view/'.$person_id));
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
