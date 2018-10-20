<?php

namespace frontend\controllers;

use Yii;
use frontend\models\IncidentRefRegion;
use frontend\models\IncidentRefRegionSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncidentRefRegionController implements the CRUD actions for IncidentRefRegion model.
 */
class IncidentRefRegionController extends SiteController
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
     * Lists all IncidentRefRegion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncidentRefRegionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IncidentRefRegion model.
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
     * Creates a new IncidentRefRegion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new IncidentRefRegion(['scenario' => 'without_db']);;
        $session = Yii::$app->session;
        $session->open();   
        if (Yii::$app->request->post()){
            $ref_region_id = Yii::$app->request->post()['IncidentRefRegion']['ref_region_id'];
            $session['ref_region_id'] = $ref_region_id;
            $session['marker'] = ++$session['marker'];
            return $this->redirect(['/incident-ref-city/create']);
        }
        else {
           return $this->render('create', [
            'model' => $model, 
            ]);
            }       
    }    
//            else {
//                return $this->render('create', [
//                'model' => $model,
//                'incident_id' => $incident_id,    
//                ]);
//            }
//        }
//        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id, ]);
//        }
//
//        else {
//            return $this->render('create', [
//            'model' => $model, 
//            ]);
//        }
        
            
//        if (!$incident_id == null){
//           if ($model->loadMultiple('ref_region_id', Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//            }
//            else {
//                return $this->render('create', [
//                'model' => $model,
//                'incident_id' => $incident_id,    
//                ]);
//            }    
//        }
//        elseif ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }
//
//        else {
//            return $this->render('create', [
//            'model' => $model,
//            ]);
//        }
    //}    
    /**
     * Updates an existing IncidentRefRegion model.
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
     * Deletes an existing IncidentRefRegion model.
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
     * Finds the IncidentRefRegion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncidentRefRegion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncidentRefRegion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
