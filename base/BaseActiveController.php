<?php
namespace app\base;


use Yii;
use yii\rest\ActiveController;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

class BaseActiveController  extends ActiveController{
    // public function behaviors(){
    //     $behaviors = parent::behaviors();
    //     return $behaviors;
    // }


    public function checkAccess ( $action, $model = null, $params = [] ){

    }


    public function beforeAction($action)
    {
        $value = parent::beforeAction($action);
        $this->checkAccess($this->action->id);
        return $value; 
    }
}