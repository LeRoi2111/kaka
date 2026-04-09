<?php
namespace app\controllers\admin;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\db\Query;

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
                        'matchCallback' => function () {
                            return !Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin';
                        },
                        'denyCallback' => function () {
                            Yii::$app->session->setFlash('error', 'Доступ запрещён. Требуется роль администратора.');
                            return Yii::$app->response->redirect(['/site/login']);
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $this->layout = 'admin';
        $this->view->title = 'Панель администратора';

        $db = Yii::$app->db;

        $stats = [
            'users' => (new Query())->from('user')->count('*', $db),
            'patients' => (new Query())->from('patient')->count('*', $db),
            'organizations' => (new Query())->from('organization')->count('*', $db),
            'documents' => (new Query())->from('document')->count('*', $db),
            'documents_issued' => (new Query())->from('document')->where(['status' => 'issued'])->count('*', $db),
        ];

        return $this->render('index', [
            'stats' => $stats,
        ]);
    }
}