<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\jui\DatePicker;
use app\models\User;
use yii\helpers\ArrayHelper;

$this->title = "Laporan Saldo";
?>

<h1><?= $this->title ?></h1>
<?= Html::beginForm(['laporan/saldo'], 'get', ['target' => '_blank']); ?>
<div class="form-group">
    <?= Html::label('Start Date', 'start_date') ?>
    <?= DatePicker::widget(['name' => 'start_date', 'options' => ['class' => 'form-control', 'id' => 'start_date', 'required' => true], 'dateFormat' => 'yyyy-MM-dd']) ?>
</div>
<div class="form-group">
    <?= Html::label('End Date', 'end_date') ?>
    <?= DatePicker::widget(['name' => 'end_date', 'options' => ['class' => 'form-control', 'id' => 'end_date', 'required' => true], 'dateFormat' => 'yyyy-MM-dd']) ?>
</div>
<div class="form-group">
    <?= Html::label('Operator', 'operator') ?>
    <?= Html::dropDownList('operator', [], array_merge([0 => '== Semua == '], ArrayHelper::map(User::find()->all(), 'id', 'username')), ['class' => 'form-control', 'id' => 'operator', 'required' => true]) ?>
</div>
<div class="form-group">
    <?= Html::submitButton('Print', ['class' => 'btn btn-primary']) ?>
</div>
<?= Html::endForm() ?>
