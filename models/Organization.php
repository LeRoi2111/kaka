<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "organization".
 *
 * @property int $id
 * @property string $name
 * @property string|null $license_number
 * @property string $inn
 * @property string|null $kpp
 * @property string|null $ogrn
 * @property string $legal_address
 * @property string|null $actual_address
 * @property int|null $default_staff_id
 *
 * @property Staff $defaultStaff
 * @property Document[] $documents
 */
class Organization extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'organization';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'inn', 'legal_address'], 'required'],
            [['default_staff_id'], 'integer'],
            [['name', 'legal_address', 'actual_address'], 'string', 'max' => 255],
            [['license_number'], 'string', 'max' => 50],
            [['inn', 'kpp'], 'string', 'max' => 12],
            [['ogrn'], 'string', 'max' => 15],
            [['default_staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['default_staff_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'license_number' => 'License Number',
            'inn' => 'Inn',
            'kpp' => 'Kpp',
            'ogrn' => 'Ogrn',
            'legal_address' => 'Legal Address',
            'actual_address' => 'Actual Address',
            'default_staff_id' => 'Default Staff ID',
        ];
    }

    /**
     * Gets query for [[DefaultStaff]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'default_staff_id']);
    }

    /**
     * Gets query for [[Documents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::class, ['organization_id' => 'id']);
    }
}
