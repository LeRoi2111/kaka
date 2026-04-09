<?php
namespace app\controllers\operator;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;

class IndexController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => fn() => !Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->role, ['operator', 'admin']),
                    ],
                ],
                'denyCallback' => fn() => Yii::$app->response->redirect(['/site/login']),
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'operator';
        $this->view->title = 'Кабинет оператора';

        $db = Yii::$app->db;
        $stats = [
            'patients' => (new \yii\db\Query())->from('patient')->count('*', $db),
            'organizations' => (new \yii\db\Query())->from('organization')->count('*', $db),
            'documents' => (new \yii\db\Query())->from('document')->count('*', $db),
            'documents_issued' => (new \yii\db\Query())->from('document')->where(['status' => 'issued'])->count('*', $db),
        ];

        return $this->render('index', ['stats' => $stats]);
    }
}