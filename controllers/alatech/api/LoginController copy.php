<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\ContactForm;

class LoginController extends BaseController
{

    public function behaviors()
    {
       
    }

   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    

   
}
