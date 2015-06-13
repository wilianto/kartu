<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(['id' => 'transaksi-form']); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'no')->textInput(['maxlength' => true, 'readonly' => true, 'value' => 'AUTO']) ?>

    <?= $form->field($model, 'tgl')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'no_kartu')->textInput(['id' => 'no_kartu']) ?>

    <?= $form->field($model, 'nominal')->textInput(['maxlength' => true, 'id' => 'nominal']) ?>

    <?= $form->field($model, 'nama')->textInput(['readonly' => true, 'id' => 'nama']) ?>

    <?= $form->field($model, 'alamat')->textarea(['readonly' => true, 'id' => 'alamat']) ?>

    <?= $form->field($model, 'saldo_awal')->textInput(['readonly' => true, 'id' => 'saldo_awal']) ?>

    <?= $form->field($model, 'sisasaldo')->textInput(['readonly' => true, 'id' => 'sisasaldo']) ?>

    <?= $form->field($model, 'keterangan')->textarea() ?>

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

    $("#nominal").keyup(function(){
        var sisa_saldo = parseInt($("#saldo_awal").val()) - parseInt($("#nominal").val());
        if(isNaN(sisa_saldo)){
            sisa_saldo = 0;
        }
        $("#sisasaldo").val(sisa_saldo);
    });

    $("#transaksi-form").submit(function(){
        var sisa_saldo = parseInt($("#saldo_awal").val()) - parseInt($("#nominal").val());
        if(isNaN(sisa_saldo)){
            sisa_saldo = 0;
        }
        if(sisa_saldo <= 0){
            alert("Saldo tidak mencukupi untuk transaksi ini.");
            return false;
        }
    });

    $("#no_kartu").focus();
JS;
$this->registerJs($js);
?>
