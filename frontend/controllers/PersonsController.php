<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Persons;
use frontend\models\PersonsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\ContactsSearch;
use frontend\models\PersonsRefCompanySearch;

/**
 * PersonsController implements the CRUD actions for Persons model.
 */
class PersonsController extends SiteController
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
     * Lists all Persons models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'main-collapse';
        $searchModel = new PersonsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persons model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $contactsSearchModel = new ContactsSearch(['id_person' => $id]);
        $contactsDataProvider = $contactsSearchModel->search(Yii::$app->request->queryParams);
        $contactsDataProvider->sort = false;
        $companiesSearchModel = new PersonsRefCompanySearch(['persons_id' => $id]);
        $companiesDataProvider = $companiesSearchModel->search(Yii::$app->request->queryParams);
        $companiesDataProvider->sort = false;
//        $serviceSearchModel = new \frontend\models\PersonsRefServiceSearch([['persons_id' => $id]]);
//        $serviceDataProvider = $serviceSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'contactsDataProvider' => $contactsDataProvider,
            'companiesDataProvider' => $companiesDataProvider,
//            'serviceDataProvider' => $serviceDataProvider
        ]);
    }

    /**
     * Creates a new Persons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Persons();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Persons model.
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
            'id' => $id,
        ]);
    }

    /**
     * Deletes an existing Persons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Persons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persons::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
