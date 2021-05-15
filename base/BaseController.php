<?php
namespace app\base;


use Yii;
use yii\rest\Controller;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

class BaseController  extends Controller{
    // public function behaviors(){
    //     $behaviors = parent::behaviors();
    //     return $behaviors;
    // }


    public function checkAccess ( $action, $model = null, $params = [] ){
        return true;
    }


    public function beforeAction($action)
    {
        $value = parent::beforeAction($action);
        $this->checkAccess($this->action->id);
        return $value; 
    }

    protected function userFunc($model,$statusCode,$errorInfo,$isReturn){
        Yii::$app->response->statusCode = $statusCode;
        if($errorInfo) $model->addError($errorInfo['field'], $errorInfo['val']);
        if($isReturn) return $model->errors;
    }
}