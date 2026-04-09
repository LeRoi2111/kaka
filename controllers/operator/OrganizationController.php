<?php
namespace app\controllers\operator;

use Yii;
use app\models\Organization;
use app\models\OrganizationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class OrganizationController extends Controller
{
    public function init() { parent::init(); $this->layout = 'operator'; }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [['allow' => true, 'matchCallback' => fn() => !Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->role, ['operator', 'admin'])]]],
            'verbs' => ['class' => VerbFilter::class, 'actions' => ['delete' => ['POST']]],
        ];
    }

    public function actionIndex() {
        $searchModel = new OrganizationSearch();
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $searchModel->search(Yii::$app->request->queryParams)]);
    }
    public function actionView($id) { return $this->render('view', ['model' => $this->findModel($id)]); }
    public function actionCreate() {
        $model = new Organization();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Организация добавлена.');
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Данные обновлены.');
            return $this->redirect(['index']);
        }
        return $this->render('update', ['model' => $model]);
    }
    public function actionDelete($id) {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Запись удалена.');
        return $this->redirect(['index']);
    }
    protected function findModel($id) {
        if (($model = Organization::findOne($id)) !== null) return $model;
        throw new NotFoundHttpException('Запись не найдена.');
    }
}