<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class DocumentType extends ActiveRecord
{
    public static function tableName() { return '{{%document_type}}'; }

    public function rules()
    {
        return [
            [['name', 'template_file'], 'required'],
            [['name', 'template_file'], 'trim'],
            ['name', 'string', 'max' => 100],
            ['template_file', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return ['id' => 'ID', 'name' => 'Наименование', 'template_file' => 'Файл шаблона'];
    }
}