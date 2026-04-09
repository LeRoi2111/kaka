<?php

namespace app\controllers\user;

use app\models\Announcements;
use app\models\Auth;
use app\models\Feedback;
use app\models\Order;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Users;



class AuthController extends Controller
{

    public function actionLogin()
    {
        if ($this->request->isPost) {
            //du($_POST);
            extract($_POST);
            if(Auth::checkUser($email, $password)){
                return $this->redirect('/user/home');
            }
        }
        return $this->render('login');
    }

    public function actionRegister()
    {
        if ($this->request->isPost) {
            //du($_POST);

            $user = new User();

            $user-> attributes = $this->request->post();

            $user -> password_hash = Yii::$app -> security ->generatePasswordHash($this->request->post()['password']);
            $user -> role_id = 2;//user
            $user -> save();

            Auth::setUser($user);

            return $this->redirect('/user/home');

        }
        return $this->render('register');
    }

    public function actionLogout()
    {
        Auth::logout();
        return $this->goHome();

    }

}
