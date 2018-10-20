<?php

namespace frontend\controllers;

use Yii;
use frontend\models\PersonsRefRegion;
use frontend\models\PersonsRefRegionSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
     * Lists all PersonsRefRegion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonsRefRegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonsRefRegion model.
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
     * Creates a new PersonsRefRegion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($person_id = null)
    {
        $model = new PersonsRefRegion();
        
        if (!$person_id == null) {
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

        else {return $this->render('create', [
            'model' => $model,
        ]);
        }
    }

    /**
     * Updates an existing PersonsRefRegion model.
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
     * Deletes an existing PersonsRefRegion model.
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
        else {
            return $this->redirect(['index']);
        }
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
