<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user = false;

    public function rules()
    {
        return [
            ['username', 'required', 'message' => 'Vui lòng không bỏ trống!'],
            ['password', 'required', 'message' => 'Vui lòng không bỏ trống!'],
            ['username', 'exist', 'targetClass' => '\app\models\User', 'message' => 'Người dùng không tồn tại!'],
            ['password', 'validatePassword']
        ];
    }

    public function validatePassword($attribute, $params): bool
    {
        $this->_user = User::findOne(['username' => $this->username]);
        if (!$this->_user->validatePassword($this->password)) {
            $this->addError($attribute, 'Mật khẩu không đúng!');
        }
    }

    public function getUser()
    {
        return $this->_user;
    }
}