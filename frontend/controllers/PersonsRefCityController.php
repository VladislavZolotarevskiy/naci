<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefCity;
use frontend\models\PersonsRefCitySearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonsRefCityController implements the CRUD actions for PersonsRefCity model.
 */
class PersonsRefCityController extends SiteController
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
     * Lists all PersonsRefCity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonsRefCitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonsRefCity model.
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
     * Creates a new PersonsRefCity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id = null)
    {
        $model = new PersonsRefCity();

        if (!$person_id == null){
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/persons/view', 'id' => $person_id]);
            }
            else {
                return $this->render('create', [
                'model' => $model,
                'person_id' => $person_id,
                ]);    
            }
        }
        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        else {
            return $this->render('create', [
            'model' => $model,
        ]);
        }
    }
    /**
     * Updates an existing PersonsRefCity model.
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
        ]);
    }

    /**
     * Deletes an existing PersonsRefCity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $view_id = null)
    {
        $this->findModel($id)->delete();
        if (!$view_id == null) {
            return $this->redirect(['/persons/view', 'id' => $view_id]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the PersonsRefCity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonsRefCity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonsRefCity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
