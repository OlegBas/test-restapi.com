<?php

namespace app\controllers\alatech\api;

use Yii;
use app\base\BaseController;
use app\models\authorization\LogoutForm;
use app\models\authorization\User;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class LogoutController extends BaseController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authorization'] =[
            'class' => HttpBearerAuth::class,
        ];
        $behaviors['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'index' => ['DELETE']
            ]
            ];
        return $behaviors;
       
    }

   

    public function actionIndex()
    {
        $model = new LogoutForm();
        if(!Yii::$app->user->isGuest)
        {
            print_r(Yii::$app->user->identity->username);
            $model->token = Yii::$app->user->getIdentity()->accessToken;
            // User::findIdentityByAccessToken(Yii::$app->request);
            // if($model->token) {
            //     $user = User::findIdentity(Yii::$app->user->getId());
            //     if($user != null) {
            //         if (strlen($user->accessToken) > 0) {
            //             $user->accessToken = '';
            //             $user->save();
            //             return [
            //                 'message' => 'Logout successful'
            //             ];
            //         } else 
            //             return $this->userFunc($model,404,['field' => 'token','val' => 'Not logged in'],true);
                    
            //     }
            // }
            // return $this->userFunc($model,404,['field' => 'token','val' => 'Invalid token'],true);
        }
    }

    

   
}
