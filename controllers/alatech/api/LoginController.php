<?php

namespace app\controllers\alatech\api;

use Yii;
use app\base\BaseController;
use app\base\authorization\Login;
use app\base\authorization\User;
use yii\filters\VerbFilter;

class LoginController extends BaseController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['POST']
            ]
        ]
        return $behaviors;
       
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
