<?php
namespace app\models;

use yii\db\ActiveRecord;

class DocumentService extends ActiveRecord
{
    public static function tableName() { return '{{%document_service}}'; }

    public function rules()
    {
        return [
            [['document_id', 'service_id', 'amount', 'service_date'], 'required'],
            [['amount'], 'number'],
            [['service_date'], 'date', 'format' => 'php:Y-m-d'],
            [['document_id'], 'exist', 'targetClass' => Document::class, 'targetAttribute' => 'id'],
            [['service_id'], 'exist', 'targetClass' => Service::class, 'targetAttribute' => 'id'],
        ];
    }

    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }
}