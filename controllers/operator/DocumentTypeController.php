<?php

namespace app\controllers\operator;

use Yii;
use app\models\DocumentType;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\Patient;
use app\models\Document;
use app\models\Organization;
use app\models\Staff;
use app\models\Service;



class DocumentTypeController extends Controller
{
    public function init()
    {
        parent::init();
        $this->layout = 'operator';
    }
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
            'query' => DocumentType::find(),
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 15],
        ]);
        return $this->render('index', ['dataProvider' => $dataProvider]);
    }
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }
    public function actionCreate()
    {
        $model = new Document();
        $model->document_date = date('Y-m-d');
        $model->status = 'draft';

        if ($model->load(Yii::$app->request->post())) {
            $model->services = Yii::$app->request->post('DocumentService', []);

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Документ успешно создан.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                // Выводим ошибки валидации в лог и flash для отладки
                $errors = implode(', ', $model->getFirstErrors());
                Yii::error("Document create validation failed: $errors");
                Yii::$app->session->setFlash('error', 'Ошибка сохранения: ' . $errors);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'patients' => Patient::find()->select(['id', 'last_name', 'first_name', 'middle_name'])->asArray()->all(),
            'orgs' => Organization::find()->select(['id', 'name'])->indexBy('id')->column(),
            'staff' => Staff::find()->select(['id', 'last_name', 'first_name', 'middle_name'])->asArray()->all(),
            'docTypes' => \yii\helpers\ArrayHelper::map(\app\models\DocumentType::find()->all(), 'id', 'name'),
            'services' => \yii\helpers\ArrayHelper::map(Service::find()->all(), 'id', 'name'),
        ]);
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
        if (($model = DocumentType::findOne($id)) !== null) return $model;
        throw new NotFoundHttpException('Запись не найдена.');
    }
}
