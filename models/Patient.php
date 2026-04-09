<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Patient extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%patient}}';
    }

    public function rules()
    {
        return [
            [['last_name', 'first_name', 'birth_date', 'type_person_document_id', 'document_series_number', 'document_issued_by', 'document_issue_date'], 'required'],
            [['last_name', 'first_name', 'middle_name', 'inn', 'document_series_number', 'document_issued_by', 'address', 'phone', 'email'], 'trim'],
            [['last_name', 'first_name'], 'string', 'max' => 100],
            ['middle_name', 'string', 'max' => 100],
            ['inn', 'string', 'max' => 12],
            ['document_series_number', 'string', 'max' => 30],
            ['document_issued_by', 'string', 'max' => 255],
            ['address', 'string', 'max' => 255],
            ['phone', 'string', 'max' => 30],
            ['email', 'string', 'max' => 150],
            ['email', 'email'],
            [['birth_date', 'document_issue_date'], 'date', 'format' => 'php:Y-m-d'],
            ['type_person_document_id', 'integer'],
            ['type_person_document_id', 'exist', 'skipOnError' => true, 'targetClass' => TypePersonDocument::class, 'targetAttribute' => ['type_person_document_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'last_name' => 'Фамилия',
            'first_name' => 'Имя',
            'middle_name' => 'Отчество',
            'birth_date' => 'Дата рождения',
            'inn' => 'ИНН',
            'type_person_document_id' => 'Вид документа',
            'document_series_number' => 'Серия и номер',
            'document_issued_by' => 'Кем выдан',
            'document_issue_date' => 'Дата выдачи',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Email',
        ];
    }

    public function getTypePersonDocument()
    {
        return $this->hasOne(TypePersonDocument::class, ['id' => 'type_person_document_id']);
    }

    public function getFullName()
    {
        return trim($this->last_name . ' ' . $this->first_name . ' ' . ($this->middle_name ?? ''));
    }
}