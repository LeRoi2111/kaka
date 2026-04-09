<?php

namespace app\models;
use app\models\User;
use app\models\Admin;
use Yii;

class Auth extends \yii\base\BaseObject
{

    public static function setUser($identity)
    {

        $session = Yii::$app->session;
        $session->destroy();
        $session->open();

        $session->set('user', $identity);
    }

    public static function checkUser($email, $password)
    {
        $u = User::findOne(['email' => $email, 'role_id' => 2]);

        if($u && Yii::$app -> security -> validatePassword($password, $u -> password_hash)){
          static::setUser($u);
          return true;
        }else{
          Yii::$app -> session -> setFlash('danger', 'Неверный логин или пароль');
          return false;
        }

    }

    public static function isUser()
    {
        $session = Yii::$app->session;
        return $session->has('user');
    }


    public static function setAdmin($identity)
    {

        $session = Yii::$app->session;
        $session->destroy();
        $session->open();

        $session->set('admin', $identity);
    }

    public static function isAdmin()
    {
        $session = Yii::$app->session;
        return $session->has('admin');
    }


    public static function checkAdmin($login, $password)
    {
        $u = User::findOne(['email' => $login,  'role_id' => 1]);

        if($u && Yii::$app -> security -> validatePassword($password, $u -> password_hash)){
          static::setAdmin($u);
          return true;
        }else{
          Yii::$app -> session -> setFlash('danger', 'Неверный логин или пароль');
          return false;
        }

    }


    public static function logout()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->destroy();
    }
}
