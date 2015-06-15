<?php

use app\models\Item;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\DetailTransaksi;


/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaksi-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model) ?>

    <?= $form->field($model, 'no')->textInput(['maxlength' => true,'readonly' => true, 'value' => 'AUTO']) ?>

    <?= $form->field($model, 'tgl')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput(['readonly' => true, 'value' => Yii::$app->user->identity->username]) ?>

    <?= $form->field($model, 'no_kartu')->textInput(['id' => 'no_kartu']) ?>

    <b><?= 'Isi Saldo untuk Tiket:' ?></b>
    <table class="table table-striped" style="width: 50%">
      <tr>
        <b><td width="80px">Jumlah</td></b>
        <b><td>Item</td></b>
        <b><td>Harga</td></b>
      </tr>
      <?php
      $rows = Item::find()->asArray()->all();

      if(!empty($rows)){
        foreach($rows as $row){
          echo "<tr>";

          $item = $row['nama'];
          $harga = $row['harga'];
          $id = $row['id'];

          echo "<td><b>";
      ?>

      <?php echo $form->field(new DetailTransaksi(), "[{$row['id']}]qty")->textInput(['class' => 'qty form-control', 'data-id' => 'harga-'.$row['id']])->label(false); ?>
      <?php echo $form->field(new DetailTransaksi(), "[{$row['id']}]harga")->hiddenInput(['class' => 'harga form-control', 'id' => 'harga-'.$row['id'], 'value' => $harga])->label(false); ?>
      <?php echo $form->field(new DetailTransaksi(), "[{$row['id']}]nama")->hiddenInput(['class' => 'nama form-control', 'value' => $item])->label(false); ?>
      <?php echo $form->field(new DetailTransaksi(), "[{$row['id']}]item_id")->hiddenInput(['class' => 'item form-control', 'value' => $id])->label(false); ?>


      <?php
          echo "</b></td>";
          echo "<td><b>";
          echo $item;
          echo "</b></td>";
          echo "<td><b>";
          echo Yii::$app->formatter->asCurrency($harga, 'IDR');
          echo "</b></td>";
          echo "</tr>";
        }
      }
      ?>
    </table>


    <?= $form->field($model, 'nominal')->textInput(['readonly' => true, 'maxlength' => true, 'id' => 'nominal']) ?>

    <?= $form->field($model, 'nama')->textInput(['readonly' => true, 'id' => 'nama']) ?>

    <?= $form->field($model, 'alamat')->textarea(['readonly' => true, 'id' => 'alamat']) ?>

    <?= $form->field($model, 'saldo_awal')->textInput(['readonly' => true, 'id' => 'saldo_awal']) ?>

    <?= $form->field($model, 'saldosekarang')->textInput(['readonly' => true, 'id' => 'saldosekarang']) ?>

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
                $("input.qty:first").focus();
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
    $("#no_kartu").focus();

    $("input.qty").keyup(function(e){
      var totalnom = 0;
      $("input.qty").each(function(){
        var harga_id = $(this).data('id');
        var harga = $("#"+harga_id).val();
        var nom = $(this).val() * harga;
        totalnom = totalnom + nom;
      });
      $("#nominal").val(totalnom);
      var saldo_sekarang = parseInt($("#saldo_awal").val()) + parseInt($("#nominal").val());
      if(isNaN(saldo_sekarang)){
        saldo_sekarang = 0;
      }
      $("#saldosekarang").val(saldo_sekarang);
    })
JS;
$this->registerJs($js);
?>
