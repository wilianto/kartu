<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no')->textInput(['maxlength' => true,'readonly' => true, 'value' => 'AUTO']) ?>

    <?= $form->field($model, 'tgl')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true, 'value' => $model->user->username]) ?>

    <?= $form->field($model, 'no_kartu')->textInput(['id' => 'no_kartu']) ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true, 'id' => 'nominal']) ?>

    <?= $form->field($model, 'nama')->textInput(['readonly' => true, 'id' => 'nama']) ?>

    <?= $form->field($model, 'alamat')->textarea(['readonly' => true, 'id' => 'alamat']) ?>

    <?= $form->field($model, 'saldo_awal')->textInput(['readonly' => true, 'id' => 'saldo_awal']) ?>

    <?= $form->field($model, 'keterangan')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$url = Url::to(['saldo/kartu']);
$js = <<<JS
    $("#no_kartu").keypress(function(e){
      if(e.which == '13'){
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: "$url",
            data: {no_kartu: $(this).val()}
        }).done(function(msg){
            if(msg.length > 0){
                var json = $.parseJSON(msg);
                $("#nama").val(json['nama']);
                $("#alamat").val(json['alamat']);
                $("#saldo_awal").val(json['saldo']);
                $("#nominal").focus();
            }
            else{
              alert('Nomor Kartu tidak terdaftar!');
              $("#nama").val('');
              $("#alamat").val('');
              $("#saldo_awal").val('');
            }
        });

      }
    });
JS;
$this->registerJs($js);
?>
