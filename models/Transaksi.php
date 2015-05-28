<?php

namespace app\models;

use Yii;
use app\models\Kartu;
use yii\db\Query;

/**
 * This is the model class for table "transaksi".
 *
 * @property integer $id
 * @property string $no
 * @property string $tgl
 * @property integer $user_id
 * @property integer $kartu_id
 * @property string $nominal
 * @property string $saldo_awal
 * @property string $keterangan
 * @property string $tipe
 *
 * @property Kartu $kartu
 * @property User $user
 */
class Transaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $nama;
    public $no_kartu;
    public $alamat;
    public $sisasaldo;

    const TIPE_TRANSAKSI = "transaksi";
    const TIPE_SALDO = "saldo";

    public static function tableName()
    {
        return 'transaksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no', 'tgl', 'user_id', 'no_kartu', 'kartu_id', 'nominal', 'saldo_awal', 'tipe'], 'required'],
            [['tgl'], 'safe'],
            [['nominal', 'saldo_awal'], 'number'],
            [['nama', 'nama'], 'string'],
            [['no_kartu'], 'string'],
            [['alamat', 'alamat'], 'string'],
            [['sisasaldo'], 'number'],
            [['keterangan'], 'string'],
            [['tipe'], 'string', 'max' => 16],
            [['no'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'No',
            'tgl' => 'Tgl',
            'user_id' => 'User ID',
            'kartu_id' => 'Kartu ID',
            'nominal' => 'Nominal',
            'saldo_awal' => 'Saldo Awal',
            'keterangan' => 'Keterangan',
            'tipe' => 'Tipe',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKartu()
    {
        return $this->hasOne(Kartu::className(), ['id' => 'kartu_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $kartu = Kartu::find()->where(['id' => $this->kartu_id])->one();

        if($insert){
          if($this->tipe == self::TIPE_SALDO){
            $kartu->saldo += $this->nominal;
            $kartu->save();
          }
          if($this->tipe == self::TIPE_TRANSAKSI){
            $kartu->saldo -= $this->nominal;
            $kartu->save();
          }
        }
    }

    public static function getReport($tipe, $start_date, $end_date, $operator){
        $sql = "SELECT SUM(nominal) AS total
                FROM transaksi
                WHERE tipe=:tipe
                    AND tgl>=:start_date
                    AND tgl<=:end_date
                    AND user_id=:user_id ";

        $command = Yii::$app->db->createCommand($sql);
        $command->bindParam(':tipe', $tipe);
        $command->bindParam(':start_date', $start_date);
        $command->bindParam(':end_date', $end_date);
        $command->bindParam(':user_id', $operator);

        return $command->queryAll();
    }
}
