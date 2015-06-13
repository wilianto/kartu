<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KartuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lihat Kartu';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kartu-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kartu', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'no_kartu',
            'tgl_daftar',
            'nama',
            // 'no_tlp',
            [
                'attribute' => 'saldo',
                'value' => function($data){
                    return Yii::$app->formatter->asCurrency($data->saldo, 'IDR');
                },
            ],
            // 'user_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{print} {view} {update} {delete}',
                'buttons' => [
                    'print' => function($url, $model, $key){
                        return Html::a('<span class="glyphicon glyphicon-print"></span>', ['#'], ['onclick' => 'window.open("'.$url.'", "_blank", "width=320, height=500, resizable=false, scollbars=false, top=100, left=400")']);
                    },
                ],
            ],
        ],
    ]); ?>

</div>
