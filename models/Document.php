<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Document extends ActiveRecord
{
    public $services = []; // Массив услуг из формы

    public static function tableName() { return '{{%document}}'; }

    public function rules()
    {
        return [
            // total_amount УБРАН из required, рассчитывается автоматически
            [['patient_id', 'organization_id', 'staff_id', 'document_type_id', 'document_number', 'document_date'], 'required'],
            [['patient_id', 'organization_id', 'staff_id', 'document_type_id'], 'integer'],
            [['total_amount'], 'number'],
            [['document_number'], 'string', 'max' => 50],
            [['status'], 'in', 'range' => ['draft', 'issued', 'cancelled'], 'skipOnEmpty' => true],
            [['document_date'], 'date', 'format' => 'php:Y-m-d'],
            [['services'], 'safe'], // Разрешаем передачу массива услуг
            [['patient_id'], 'exist', 'targetClass' => Patient::class, 'targetAttribute' => 'id'],
            [['organization_id'], 'exist', 'targetClass' => Organization::class, 'targetAttribute' => 'id'],
            [['staff_id'], 'exist', 'targetClass' => Staff::class, 'targetAttribute' => 'id'],
            [['document_type_id'], 'exist', 'targetClass' => DocumentType::class, 'targetAttribute' => 'id'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID', 'patient_id' => 'Пациент', 'organization_id' => 'Организация',
            'staff_id' => 'Исполнитель', 'document_type_id' => 'Тип документа',
            'document_number' => 'Номер справки', 'document_date' => 'Дата выдачи',
            'total_amount' => 'Общая сумма', 'status' => 'Статус',
        ];
    }

    public function getPatient() { return $this->hasOne(Patient::class, ['id' => 'patient_id']); }
    public function getOrganization() { return $this->hasOne(Organization::class, ['id' => 'organization_id']); }
    public function getStaff() { return $this->hasOne(Staff::class, ['id' => 'staff_id']); }
    public function getDocumentType() { return $this->hasOne(DocumentType::class, ['id' => 'document_type_id']); }
    public function getDocumentServices() { return $this->hasMany(DocumentService::class, ['document_id' => 'id']); }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->status = $this->status ?: 'draft';
            // Рассчитываем сумму ДО сохранения, чтобы пройти валидацию
            $this->total_amount = $this->calculateTotal();
            return true;
        }
        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        // Сохраняем услуги только после получения ID родительского документа
        if (!empty($this->services) && is_array($this->services)) {
            DocumentService::deleteAll(['document_id' => $this->id]);
            foreach ($this->services as $srv) {
                if (!empty($srv['service_id']) && !empty($srv['amount'])) {
                    $ds = new DocumentService();
                    $ds->document_id = $this->id;
                    $ds->service_id = $srv['service_id'];
                    $ds->amount = (float)$srv['amount'];
                    $ds->service_date = $srv['service_date'] ?? $this->document_date;
                    $ds->save(false);
                }
            }
        }
    }

    private function calculateTotal(): float
    {
        $total = 0;
        if (!empty($this->services) && is_array($this->services)) {
            foreach ($this->services as $srv) {
                $total += (float)($srv['amount'] ?? 0);
            }
        }
        return $total;
    }
}