<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TransaksiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Isi Saldo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Isi Saldo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no',
            'tgl',
            [
                'attribute' => 'no_kartu',
                'value' => function($data){
                    return $data->kartu->no_kartu;
                },
            ],
            [
                'attribute' => 'nominal',
                'value' => function($data){
                    return Yii::$app->formatter->asCurrency($data->nominal, 'IDR');
                },
            ],
            [
                'attribute' => 'username',
                'value' => function($data){
                    return $data->user->username;
                },
            ],
            // 'saldo_awal',
            // 'keterangan:ntext',
            // 'tipe',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {print}',
                'buttons' => [
                    'print' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['#'], ['onclick' => 'window.open("'.$url.'", "_blank", "width=320, height=500, resizable=false, scollbars=false, top=100, left=400")']);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
