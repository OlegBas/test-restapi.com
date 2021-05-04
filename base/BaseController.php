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
}