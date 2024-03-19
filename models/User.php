<?php

namespace app\models;

use PhpParser\Node\Stmt\Return_;
use yii\db\Activerecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const USER = 10;
    const ADMIN = 20;
    public $confirm_password;
    // public $image;

    public function rules()
    {
        return [
            [['name', 'username', 'email', 'password','confirm_password', 'authKey'], 'required', 'on' => 'create'],
            [['name', 'username', 'email','authKey',], 'required', 'on' => 'update'],
            [['username', 'email'], 'unique'],
            [['email'], 'email'],
            ['password', 'string', 'min' => 6],
            ['confirm_password', 'compare', 'compareAttribute' => 'password', 'message' => "Passwords don't match"],
            // ['password', 'match','pattern' => '((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*?[0-9])(?=.*[@#$%]).{8,20})'],
            ['role', 'default', 'value' => 'USER'],
        ];
    }

    public static function IsUserAdmin($username)
    {
        $user = self::findOne(['username' => $username]);
        if ($user->role == 'ADMIN'){
                return true;
        } else {
                return false;
        }
    }

    public static function IsUserSuperAdmin($username)
    {
        $user = self::findOne(['username' => $username]);
        if($user->role == 'SUPERADMIN'){
            return true;
        } else {
            return false;
        }
    }

    public static function IsUser($username)
    {
        $user = self::findOne(['username' => $username]);
        if ($user->role == 'USER'){
                return true;
        } else {
                return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name'
        ];
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
          return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function setPassword($password)
    {
        $this->password_hash = Security::generatePasswordHash($password);
    }

}

?>