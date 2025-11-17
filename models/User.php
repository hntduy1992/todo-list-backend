<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $id;
    public $username;
    public $password_hash;
    public $authKey;
    public $status;
    public $created_at;
    public $updated_at;
    public $accessToken;

    const int STATUS_ACTIVE = 10;
    const int STATUS_PENDING = 9;
    const int STATUS_DELETE = 1;
    const int STATUS_INACTIVE = 0;


    /**
     * @throws Exception
     */
    public function setPassword($password): void
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey(): void
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    public function validatePassword($password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

   public static function findIdentityByAccessToken($token, $type = null): User|IdentityInterface|null
   {
        return static::findOne([
            'auth_key' => $token,
            'status' => self::STATUS_ACTIVE
        ]);
    }

    /**
     * @param $id
     * @return IdentityInterface|null
     */
    #[\Override] public static function findIdentity($id)
    {
        // TODO: Implement findIdentity() method.
    }

    /**
     * @return int|string
     */
    #[\Override] public function getId()
    {
        // TODO: Implement getId() method.
    }

    /**
     * @return string|null
     */
    #[\Override] public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * @param $authKey
     * @return bool|null
     */
    #[\Override] public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
