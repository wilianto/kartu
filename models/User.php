<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $user_type
 *
 * @property Kartu[] $kartus
 * @property Transaksi[] $transaksis
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const TYPE_ADMIN = "admin";
    const TYPE_OPERATOR = "operator";
    const TYPE_BLOKIR = "blokir";

    public $password_repeat;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['password', 'password_repeat', 'user_type'], 'required', 'on' => 'create'],
            [['password', 'password_repeat'], 'safe', 'on' => 'update'],
            [['password'], 'compare'],
            [['username', 'password'], 'string', 'max' => 32],
            [['auth_key', 'access_token'], 'string', 'max' => 128],
            [['user_type'], 'string', 'max' => 16],
            [['username'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'user_type' => 'User Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKartus()
    {
        return $this->hasMany(Kartu::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['user_id' => 'id']);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = self::find()->where(['id' => $id]);
        if($user === null){
            return null;
        }
        return $user->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {
        $user = self::find()->where(['access_token' => $access_token]);
        if($user === null){
            return null;
        }
        return $user->one();
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($auth_key) {
        return $this->auth_key === $auth_key;
    }

    public static function findByUsername($username){
        $user = self::find()->where(['username' => $username])->one();
        if(!count($user)){
            return null;
        }
        return new static($user);
    }

    public static function getUserType($key = null){
        $array = [
            self::TYPE_ADMIN => 'Admin',
            self::TYPE_OPERATOR => 'Operator',
            self::TYPE_BLOKIR => 'Blokir',
        ];

        if($key == null){
            return $array;
        }else{
            return isset($array[$key]) ? $array[$key] : "None";
        }
    }

    public function beforeSave($insert){
        if($this->isNewRecord || (!$this->isNewRecord && isset($this->password) && !empty($this->password))){
            $this->password = self::hashPassword($this->password);
        }else{
            unset($this->password);
        }
        return parent::beforeSave($insert);
    }

    public static function hashPassword($password){
        return md5($password);
    }

    public function validatePassword($password){
        return self::hashPassword($password) === $this->password;
    }

}
