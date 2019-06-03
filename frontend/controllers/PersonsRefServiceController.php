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
        $person_ref_service_model = new PersonsRefService();
        $person_ref_service_ref_importance = new PersonsRefServiceRefImportance();
        $person_ref_service_ref_region = new PersonsRefServiceRefRegion();
        $person_ref_service_ref_region->count = 0;
        $person_ref_service_ref_city = new PersonsRefServiceRefCity();
        $person_ref_service_ref_place = new PersonsRefServiceRefPlace();
        $fake_company_model = new \frontend\models\FakeCompany;
        $fake_importance = new FakeImportance();
        $fake_importance->low = 0;
        $fake_importance->middle = 0;
        $fake_importance->high = 1;
        $fake_importance->critical = 1;
        $count = null;
        if (Yii::$app->request->isAjax) {
            if (Yii::$app->request->post()) {
            $fake_company_model->load(Yii::$app->request->post());
            $fake_importance->load(Yii::$app->request->post());
            isset(Yii::$app->request->post()['count']) ? $count=Yii::$app->request->post()['count'] : false;
            if ($count !== null) {
                $person_ref_service_model->load(Yii::$app->request->post());
                $fake_importance->load(Yii::$app->request->post());
                $person_ref_service_ref_region->count=$count;
            }
            return $this->renderAjax('create', [
                'person_ref_service_model' => $person_ref_service_model,
                'person_ref_service_ref_region' => $person_ref_service_ref_region,
                'person_ref_service_ref_city' => $person_ref_service_ref_city,
                'person_ref_service_ref_place' => $person_ref_service_ref_place,
                'fake_company_model' => $fake_company_model,
                'fake_importance' => $fake_importance,
                'person_id' => $person_id
            ]);    
            }
            elseif (Yii::$app->request->get()) {
            return $this->renderAjax('create', [
                'person_ref_service_model' => $person_ref_service_model,
                'person_ref_service_ref_region' => $person_ref_service_ref_region,
                'person_ref_service_ref_city' => $person_ref_service_ref_city,
                'person_ref_service_ref_place' => $person_ref_service_ref_place,
                'fake_company_model' => $fake_company_model,
                'fake_importance' => $fake_importance,
                'person_id' => $person_id
            ]);    
            }
        }
        elseif ($person_ref_service_model->load(Yii::$app->request->post()) && $person_ref_service_model->save()) {
            return $this->redirect(Url::to('../persons/view/'.$person_id));
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
