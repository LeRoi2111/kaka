<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Service extends ActiveRecord
{
    public static function tableName() { return '{{%service}}'; }

    public function rules()
    {
        return [
            [['name', 'code'], 'required'],
            [['name', 'code', 'description'], 'trim'],
            ['name', 'string', 'max' => 255],
            ['code', 'string', 'max' => 20],
            ['code', 'unique'],
            ['description', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return ['id' => 'ID', 'name' => 'Наименование услуги', 'code' => 'Код услуги', 'description' => 'Описание'];
    }
}