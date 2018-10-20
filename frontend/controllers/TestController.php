<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;

/**
 * TTicketController implements the CRUD actions for TTicket model.
 */
class TestController extends Controller
{
public function actionIndex(){
   return $this->render('test', ['time' => date('H:i:s')]);
} 

}