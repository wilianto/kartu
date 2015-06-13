<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "detail_transaksi".
 *
 * @property integer $id
 * @property integer $transaksi_id
 * @property integer $item_id
 * @property string $nama
 * @property string $harga
 * @property integer $qty
 *
 * @property Item $item
 * @property Transaksi $transaksi
 */
class DetailTransaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'detail_transaksi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaksi_id', 'nama', 'harga', 'qty'], 'required'],
            [['transaksi_id', 'item_id', 'qty'], 'integer'],
            [['harga'], 'number'],
            [['nama'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'transaksi_id' => 'Transaksi ID',
            'item_id' => 'Item ID',
            'nama' => 'Nama',
            'harga' => 'Harga',
            'qty' => 'Qty',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaksi()
    {
        return $this->hasOne(Transaksi::className(), ['id' => 'transaksi_id']);
    }
}
