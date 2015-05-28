<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Kartu */

$this->title = 'Buat Kartu';
$this->params['breadcrumbs'][] = ['label' => 'Kartu', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kartu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
