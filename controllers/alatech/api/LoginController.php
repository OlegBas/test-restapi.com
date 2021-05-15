<?php

namespace app\controllers\alatech\api;

use Yii;
use app\base\BaseController;
use app\models\authorization\LoginForm;
use app\models\authorization\User;
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
            ];
        return $behaviors;
       
    }

   
   

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post(), '') && $model->validate()){
            $user = User::findOne(['username' => $model->username]);
            if($user != null) {
                if(strlen($user->accessToken) > 0) {
                    return $this->userFunc($model,403,['field' => '*','val' => 'Already logged in'],true);
                }
                else if($user->password == md5($model->password)) {
                    $user->refreshAccessToken();
                    $user->save();
                    Yii::$app->user->login($user);
                    return [
                        'token' => $user->accessToken,
                   ];
                }
                return $this->userFunc($model,400,['field' => '*','val' => 'Invalid credentials'],true);
            }
            return $this->userFunc($model,400,['field' => '*','val' => 'Invalid credentials'],true);
        } 
    }

    

   
}
