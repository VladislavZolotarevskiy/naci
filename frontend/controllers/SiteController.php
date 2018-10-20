<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Site controller
 */


class SiteController extends Controller
{
    /**
     * Authorization check
     * @param type $action
     * @return boolean
     */
    public function beforeAction($action)
	{
		if (Yii::$app->user->isGuest) {
			return $this->redirect('user/default/login');
		}
		if (!parent::beforeAction($action)) {
			return false;
		}
		return true;
	}	
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }          
    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
}
