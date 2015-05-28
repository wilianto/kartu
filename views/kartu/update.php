<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Kartu */

$this->title = 'Edit Kartu: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kartu', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_kartu, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kartu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
