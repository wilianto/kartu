<?php

namespace app\models;

use Yii;
use app\models\DetailTransaksi;
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
    public $saldosekarang;


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
            [['no', 'tgl', 'user_id', 'no_kartu', 'nominal', 'saldo_awal', 'tipe'], 'required'],
            [['kartu_id'], 'required', 'message' => 'Kartu belum diisi atau tidak terdaftar'],
            [['tgl'], 'safe'],
            [['nominal', 'saldo_awal'], 'number'],
            [['nama', 'nama'], 'string'],
            [['no_kartu'], 'string'],
            [['alamat', 'alamat'], 'string'],
            [['sisasaldo', 'saldosekarang'], 'number'],
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
            'sisasaldo' => 'Sisa Saldo',
            'saldosekarang' => 'Saldo Sekarang',
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

    public function getDetailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::className(), ['transaksi_id' => 'id']);
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

    public static function getReport($tipe, $start_date, $end_date, $operator = 0){
        if(!empty($operator) || $operator != 0){
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
        }else{
            $sql = "SELECT SUM(nominal) AS total, u.username AS username
                    FROM transaksi t
                    INNER JOIN user u ON u.id = t.user_id
                    WHERE tipe=:tipe
                        AND tgl>=:start_date
                        AND tgl<=:end_date
                    GROUP BY u.username ";

            $command = Yii::$app->db->createCommand($sql);
            $command->bindParam(':tipe', $tipe);
            $command->bindParam(':start_date', $start_date);
            $command->bindParam(':end_date', $end_date);
        }

        return $command->queryAll();
    }

    public static function getReportDetail($tipe, $start_date, $end_date, $operator = 0){
        if(!empty($operator) || $operator != 0){
            $sql = "SELECT dt.nama AS nama, SUM(qty) AS total_qty
                    FROM transaksi t
                    INNER JOIN detail_transaksi dt ON dt.transaksi_id = t.id
                    WHERE tipe=:tipe
                        AND tgl>=:start_date
                        AND tgl<=:end_date
                        AND user_id=:user_id
                    GROUP BY dt.nama
                    ORDER BY dt.nama";

            $command = Yii::$app->db->createCommand($sql);
            $command->bindParam(':tipe', $tipe);
            $command->bindParam(':start_date', $start_date);
            $command->bindParam(':end_date', $end_date);
            $command->bindParam(':user_id', $operator);
        }else{
            $sql = "SELECT dt.nama AS nama, SUM(qty) AS total_qty, u.username AS username
                    FROM transaksi t
                    INNER JOIN user u ON u.id = t.user_id
                    INNER JOIN detail_transaksi dt ON dt.transaksi_id = t.id
                    WHERE tipe=:tipe
                        AND tgl>=:start_date
                        AND tgl<=:end_date
                    GROUP BY u.username, dt.nama
                    ORDER BY u.username, dt.nama";

            $command = Yii::$app->db->createCommand($sql);
            $command->bindParam(':tipe', $tipe);
            $command->bindParam(':start_date', $start_date);
            $command->bindParam(':end_date', $end_date);
        }

        return $command->queryAll();
    }
}
