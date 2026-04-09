<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;

class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    public $password; // Виртуальное поле для формы

    public static function tableName() { return '{{%user}}'; }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['username', 'email', 'password', 'role'];
        $scenarios[self::SCENARIO_UPDATE] = ['username', 'email', 'role'];
        return $scenarios;
    }

    public function rules()
    {
        return [
            [['username', 'email', 'role'], 'required'],
            [['username', 'email'], 'trim'],
            [['username', 'email'], 'unique'],
            ['email', 'email'],
            ['role', 'in', 'range' => ['admin', 'operator', 'accountant']],
            ['password', 'required', 'on' => self::SCENARIO_CREATE],
            ['password', 'string', 'min' => 6, 'on' => self::SCENARIO_CREATE],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'email' => 'Email',
            'password' => 'Пароль',
            'role' => 'Роль',
            'created_at' => 'Дата создания',
        ];
    }

    public static function findIdentity($id) { return static::findOne(['id' => $id]); }
    public static function findIdentityByAccessToken($token, $type = null) { throw new NotSupportedException(); }
    public static function findByUsername($username) { return static::findOne(['username' => $username]); }
    public function getId() { return $this->id; }
    public function getAuthKey() { return null; }
    public function validateAuthKey($authKey) { return false; }
    public function validatePassword($password) { return Yii::$app->security->validatePassword($password, $this->password_hash); }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function getRole() { return $this->role; }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->password)) {
                $this->setPassword($this->password);
            }
            if ($this->isNewRecord) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }
}