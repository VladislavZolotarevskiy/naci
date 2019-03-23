<?php

namespace frontend\modules\user\controllers;

use Yii;
use frontend\modules\user\models\ManageUser;

use frontend\models\User;
use frontend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\filters\AccessControl;

/**
 * TTicketController implements the CRUD actions for TTicket model.
 */
class ManagementController extends Controller
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'index',
                            'create',
                            'perform-ajax-validation',
                            'delete',
                            'update',
                            'change-password'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => [
                            'self-update',
                            'change-self-password'],
                        'allow' => true,
                        'roles' => ['user'],
                    ]
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreate()
    {
        $model = new ManageUser();
        if ($model->load(Yii::$app->request->post()) && ($model->createUser() != null)) {
            return $this->redirect(['index']);
        }
        return $this->renderAjax('create', [
                    'model' => $model,
        ]);
    }
    
    public function actionPerformAjaxValidation()
    {
        $model = new ManageUser();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
        }
    }
    
    public function actionDelete($id) {
        ManageUser::deleteUser($id);
        return $this->redirect(['index']);
    }

    public function actionUpdate($id)
    {
        $model = ManageUser::findUser($id);
        if ($model->load(Yii::$app->request->post())) {
            ManageUser::updateUser($model);
            return $this->redirect(['index']);
        }
        return $this->renderAjax('update', [
            'model' => $model,
            'id' => $id
        ]);
    }
    public function actionSelfUpdate()
    {
        $model = ManageUser::findUser(Yii::$app->getUser()->id);
        if ($model->load(Yii::$app->request->post())) {
            ManageUser::selfUpdateUser($model);
            return $this->redirect(['index']);
        }
        return $this->renderAjax('update-self', [
            'model' => $model,
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionChangePassword($id){
        $model = ManageUser::findUser($id);
        if ($model->load(Yii::$app->request->post())) {
            ManageUser::changePassword($model);
            return $this->redirect(['index']);
        }
        return $this->renderAjax('change-password', [
            'model' => $model,
        ]); 
    }
    public function actionChangeSelfPassword(){
        $model = ManageUser::findUser(Yii::$app->getUser()->id);
        if ($model->load(Yii::$app->request->post())) {
            ManageUser::changePassword($model);
            return $this->redirect(['index']);
        }
        return $this->renderAjax('change-password', [
            'model' => $model,
        ]); 
    }
}
