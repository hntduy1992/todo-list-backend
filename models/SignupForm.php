<?php

namespace app\models;

use yii\base\Exception;
use yii\base\Model;

class SignupForm extends Model
{
    public $username;
    public $password;

    public function rules(): array
    {
        return [
            [['username', 'password'], 'required', 'message' => '{attribute} không được bỏ trống!'],

            ['username', 'trim'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Username đã tồn tại!'],
            ['username', 'string', 'min' => 2, 'max' => 20],

            ['password', 'min' => 6, 'message' => 'Mật khẩu phải có ít nhất 6 ký tự!']
        ];
    }

    /**
     * @throws Exception
     */
    public function signup()
    {
        if (!$this->validate()) return null;

        $user = new  User();
        $user->username = $this->username;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->status = User::STATUS_PENDING;
        $user->created_at = time();
        $user->updated_at = time();

        return $user->save() ? $user : null;
    }
}