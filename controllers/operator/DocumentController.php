<?php
namespace app\controllers\operator;

use Yii;
use app\models\Document;
use app\models\DocumentService;
use app\models\Organization;
use app\models\Staff;
use app\models\Patient;
use app\models\Service;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\services\CertificateGenerator;

class DocumentController extends Controller
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
                'rules' => [
                    ['allow' => true, 'matchCallback' => fn() => !Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->role, ['operator', 'admin'])],
                    ['allow' => true, 'actions' => ['index', 'view'], 'matchCallback' => fn() => !Yii::$app->user->isGuest && in_array(Yii::$app->user->identity->role, ['accountant', 'operator', 'admin'])],
                ],
                'denyCallback' => fn() => Yii::$app->response->redirect(['/site/login']),
            ],
            'verbs' => ['class' => VerbFilter::class, 'actions' => ['delete' => ['POST']]],
        ];
    }

    public function actionIndex()
    {
        $query = Document::find()->with(['patient', 'organization', 'staff', 'documentType']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => ['pageSize' => 15]
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
                Yii::$app->session->setFlash('success', 'Документ создан.');
                return $this->redirect(['view', 'id' => $model->id]);
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
        if ($model->status === 'issued') {
            Yii::$app->session->setFlash('warning', 'Документ уже выдан. Редактирование невозможно.');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->services = Yii::$app->request->post('DocumentService', []);
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Документ обновлён.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $existingServices = DocumentService::find()->where(['document_id' => $id])->asArray()->all();

        return $this->render('update', [
            'model' => $model,
            'servicesData' => $existingServices,
            'patients' => Patient::find()->select(['id', 'last_name', 'first_name', 'middle_name'])->asArray()->all(),
            'orgs' => Organization::find()->select(['id', 'name'])->indexBy('id')->column(),
            'staff' => Staff::find()->select(['id', 'last_name', 'first_name', 'middle_name'])->asArray()->all(),
            'docTypes' => \yii\helpers\ArrayHelper::map(\app\models\DocumentType::find()->all(), 'id', 'name'),
            'services' => \yii\helpers\ArrayHelper::map(Service::find()->all(), 'id', 'name'),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Документ удалён.');
        return $this->redirect(['index']);
    }








private function splitToChars(string $value, int $length): array
{
    $clean = preg_replace('/[^0-9A-ZА-ЯЁ\.]/ui', '', mb_strtoupper($value));
    $chars = mb_str_split(str_pad($clean, $length, ' '));
    return array_slice($chars, 0, $length);
}



    public function actionViewCertificate($id)
    {
        $document = $this->findModel($id);

        // Подготавливаем данные строго под структуру шаблона
        $data = [
            // === ОРГАНИЗАЦИЯ ===
            'org_name' => $document->organization->name ?? '',
            'org_inn' => str_pad(preg_replace('/[^0-9]/', '', $document->organization->inn ?? ''), 12, ' ', STR_PAD_RIGHT),
            'org_kpp' => str_pad(preg_replace('/[^0-9]/', '', $document->organization->kpp ?? ''), 9, ' ', STR_PAD_RIGHT),
            'org_license' => $document->organization->license_number ?? '',

            // === НАЛОГОПЛАТЕЛЬЩИК (пациент) ===
            'taxpayer_last' => $document->patient->last_name ?? '',
            'taxpayer_first' => $document->patient->first_name ?? '',
            'taxpayer_middle' => $document->patient->middle_name ?? '',
            'taxpayer_inn' => str_pad(preg_replace('/[^0-9]/', '', $document->patient->inn ?? ''), 12, ' ', STR_PAD_RIGHT),
            'taxpayer_birth' => $document->patient->birth_date ? date('d.m.Y', strtotime($document->patient->birth_date)) : '',
            'taxpayer_doc_code' => $document->patient->typePersonDocument->code ?? '',
            'taxpayer_doc_num' => $document->patient->document_series_number ?? '',
            'taxpayer_doc_date' => $document->patient->document_issue_date ? date('d.m.Y', strtotime($document->patient->document_issue_date)) : '',

            // === ДОКУМЕНТ ===
            'doc_number' => $document->document_number ?? '',
            'doc_year' => $document->document_date ? date('Y', strtotime($document->document_date)) : date('Y'),
            'doc_date' => $document->document_date ? date('d.m.Y', strtotime($document->document_date)) : '',
            'corr_number' => '0', // Номер корректировки: 0 = первичная, 1+ = исправленная (пока заглушка)
            // === СУММЫ ===
            'amount_code_1' => number_format($this->sumByCode($document->id, '1'), 2, '.', ''),
            'amount_code_2' => number_format($this->sumByCode($document->id, '2'), 2, '.', ''),
            'amount_total' => number_format($document->total_amount, 2, '.', ''),

            // === ПОДПИСЬ ===
            'staff_fio' => trim("{$document->staff->last_name} {$document->staff->first_name} {$document->staff->middle_name}"),

            // === ПРОЧЕЕ ===
            'is_same_person' => '1', // упрощённо: всегда один человек
        ];

        // Рендерим view с данными и моделью для доступа к связанным записям (услуги)
        return $this->renderPartial('certificate', [
            'data' => $data,
            'document' => $document,
        ]);
    }

    /**
     * Суммирует услуги по коду (1 = лечение, 2 = медикаменты)
     */
    private function sumByCode(int $docId, string $code): float
    {
        return (new \yii\db\Query())
            ->from('document_service ds')
            ->innerJoin('service s', 'ds.service_id = s.id')
            ->where(['ds.document_id' => $docId, 's.code' => $code])
            ->sum('ds.amount') ?: 0.00;
    }

    protected function findModel($id)
    {
        if (($model = Document::findOne(['id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('Документ не найден.');
    }
}