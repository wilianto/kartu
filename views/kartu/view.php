<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kartu */

$this->title = "Lihat Kartu " . $model->no_kartu;
$this->params['breadcrumbs'][] = ['label' => 'Kartu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->no_kartu;
?>
<div class="kartu-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_kartu',
            'tgl_daftar',
            'nama',
            'alamat:ntext',
            'no_tlp',
            [
                'attribute' => 'saldo',
                'value' => Yii::$app->formatter->asCurrency($model->saldo, 'IDR'),
            ],
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
        ],
    ]) ?>

</div>
