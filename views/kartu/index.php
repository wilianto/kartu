<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KartuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Kartu';
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

            'id',
            'no_kartu',
            'tgl_daftar',
            'nama',
            'alamat:ntext',
            // 'no_tlp',
            // 'saldo',
            // 'user_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
