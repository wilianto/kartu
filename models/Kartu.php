<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kartu".
 *
 * @property integer $id
 * @property string $no_kartu
 * @property string $tgl_daftar
 * @property string $nama
 * @property string $alamat
 * @property string $no_tlp
 * @property string $saldo
 * @property integer $user_id
 *
 * @property User $user
 * @property Transaksi[] $transaksis
 */
class Kartu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kartu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no_kartu', 'tgl_daftar', 'nama', 'alamat', 'no_tlp', 'saldo'], 'required'],
            [['tgl_daftar'], 'safe'],
            [['alamat'], 'string'],
            [['saldo'], 'number'],
            [['no_kartu', 'no_tlp'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 50],
            [['no_kartu'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no_kartu' => 'No Kartu',
            'tgl_daftar' => 'Tgl Daftar',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'no_tlp' => 'No Tlp',
            'saldo' => 'Saldo',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksis()
    {
        return $this->hasMany(Transaksi::className(), ['kartu_id' => 'id']);
    }


}
