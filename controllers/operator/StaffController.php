<?php
namespace app\controllers\operator;

use Yii;
use app\models\Staff;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;

class StaffController extends Controller
{
    public function init() { parent::init(); $this->layout = 'operator'; }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [['allow' => true, 'matchCallback' => fn() => !Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->role, ['operator', 'admin'])]],
                'denyCallback' => fn() => Yii::$app->response->redirect(['/site/login']),
            ],
            'verbs' => ['class' => VerbFilter::class, 'actions' => ['delete' => ['POST']]],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Staff::find(),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 15],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id) { return $this->render('view', ['model' => $this->findModel($id)]); }
    public function actionCreate()
    {
        $model = new Staff();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Сотрудник добавлен.');
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Данные обновлены.');
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Запись удалена.');
        return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null) return $model;
        throw new NotFoundHttpException('Запись не найдена.');
    }
}