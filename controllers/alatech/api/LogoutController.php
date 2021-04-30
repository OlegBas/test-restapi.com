<?php

namespace app\controllers\alatech\api;

use Yii;
use app\base\BaseController;
use app\base\authorization\Login;
use app\base\authorization\User;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;

class LogoutController extends BaseController
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authorization'] =[
            'class' => HttpBearerAuth::class,
        ]
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
        $model = new Login();
        // 2 param - $formName	string	The form name to use to load the data into the model. If not set, formName() is used.
        if($model->load(Yii::$app->request->post(), '') && $model->validate())
        {
            //Получаем 1 объект по имени пользователя
            $user = User::findOne(['username' => $model->username]);
            if($user != null) {
                //Если пользователь уже авторизован
                if(strlen($user->accessToken) > 0) {
                    Yii::$app->response->statusCode = 403;
                    $model->addError('*', 'Already logged in');
                    return $model->errors;
                }//Если пароль выбранного пользователя в БД = паролю из формы, авторизуем пользователя
                else if($user->password == $model->password) {
                    $user->refreshAccessToken();
                    $user->save();
                    Yii::$app->user->login($user); //авторизация пользователя
                    return [
                        'token' => $user->accessToken,
                    ];
                }
            }
            //Установка кода ошибки
            Yii::$app->response->statusCode = 400;
            //Добавление ошибки в массив ошибок
            //TODO warning 
            $model->addError('*', 'Invalid credentials');
            //Возврат массива объектов
            return $model->errors;
        }
        Yii::$app->response->statusCode = 400;
        return $model->errors;
    }

    

   
}
