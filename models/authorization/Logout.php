<?php

namespace app\models\authorization;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user This property is read-only.
 *
 */
class Logout extends Model
{
   
    public $token;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            ['token', 'required'],
        ];
    }

   
}
