<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "counter".
 *
 * @property integer $id
 * @property integer $no
 * @property string $tipe
 */
class Counter extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'counter';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['no', 'tipe'], 'required'],
            [['no'], 'integer'],
            [['tipe'], 'string', 'max' => 16]
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
            'tipe' => 'Tipe',
        ];
    }

    public static function generate($tipe){
      $counter = self::find()->where(['tipe' => $tipe])->one();
      $return = $counter->no;

      $return = str_pad($return, 9, '0', STR_PAD_LEFT);
      $return = (($tipe == Transaksi::TIPE_SALDO) ? "S" : "T").$return;

      $counter->no++;
      $counter->save();

      return $return;
    }
}
