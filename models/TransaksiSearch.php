<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

/**
 * TransaksiSearch represents the model behind the search form about `app\models\Transaksi`.
 */
class TransaksiSearch extends Transaksi
{

    public $no_kartu;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'kartu_id'], 'integer'],
            [['no', 'tgl', 'keterangan', 'tipe', 'no_kartu', 'username'], 'safe'],
            [['nominal', 'saldo_awal'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchTransaksi($params)
    {
        $query = Transaksi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'tgl' => $this->tgl,
            'user_id' => $this->user_id,
            'kartu_id' => $this->kartu_id,
            'nominal' => $this->nominal,
            'saldo_awal' => $this->saldo_awal,
            'tipe' => Transaksi::TIPE_TRANSAKSI,
        ]);

        $query->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchSaldo($params)
    {
        $query = Transaksi::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('kartu')
            ->joinWith('user');

        $query->andFilterWhere([
            'id' => $this->id,
            'tgl' => $this->tgl,
            'nominal' => $this->nominal,
            'saldo_awal' => $this->saldo_awal,
            'tipe' => Transaksi::TIPE_SALDO,
        ]);

        $query->andFilterWhere(['like', 'kartu.no_kartu', $this->no_kartu])
            ->andFilterWhere(['like', 'user.username', $this->username])
            ->andFilterWhere(['like', 'no', $this->no])
            ->andFilterWhere(['like', 'keterangan', $this->keterangan]);

        return $dataProvider;
    }
}
