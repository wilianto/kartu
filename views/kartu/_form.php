<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kartu */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="kartu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_kartu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tgl_daftar')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'no_tlp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saldo')->textInput(['maxlength' => true, 'readonly' => !$model->isNewRecord]) ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true, 'value' => $model->user->username]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
