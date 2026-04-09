<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Staff extends ActiveRecord
{
    public static function tableName() { return '{{%staff}}'; }

    public function rules()
    {
        return [
            [['last_name', 'first_name', 'position'], 'required'],
            [['last_name', 'first_name', 'middle_name', 'position', 'contacts'], 'trim'],
            [['last_name', 'first_name'], 'string', 'max' => 100],
            ['middle_name', 'string', 'max' => 100],
            ['position', 'string', 'max' => 150],
            ['contacts', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID', 'last_name' => 'Фамилия', 'first_name' => 'Имя',
            'middle_name' => 'Отчество', 'position' => 'Должность', 'contacts' => 'Контакты',
        ];
    }

    public function getFullName()
    {
        return trim($this->last_name . ' ' . $this->first_name . ' ' . ($this->middle_name ?? ''));
    }
}