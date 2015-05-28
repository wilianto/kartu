<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Transaksi */

$this->title = $model->no;
$this->params['breadcrumbs'][] = ['label' => 'Transaksi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaksi-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <button type="button" class="btn btn-primary" onclick="printInvoice()"><span class="glyphicon glyphicon-print"></span> Print</button><br><br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no',
            'tgl',
            [
                'attribute' => 'user_id',
                'value' => $model->user->username,
            ],
            [
                'attribute' => 'kartu_id',
                'format' => 'raw',
                'value' => Html::a($model->kartu->no_kartu, ['kartu/view', 'id' => $model->kartu->id]),
            ],
            [
                'attribute' => 'nominal',
                'value' => Yii::$app->formatter->asCurrency($model->nominal, 'IDR'),
            ],
            [
                'attribute' => 'saldo_awal',
                'value' => Yii::$app->formatter->asCurrency($model->saldo_awal, 'IDR'),
            ],
            'keterangan:ntext',
        ],
    ]) ?>

</div>
<?php
$url = Url::to(['transaksi/print', 'id' => $model->id]);
$js = <<<JS
    function printInvoice(){
        window.open("$url", "_blank", "width=320, height=500, resizable=false, scollbars=false, top=100, left=400");
    }
JS;
$this->registerJs($js, \yii\web\View::POS_END);
if(Yii::$app->session->hasFlash("print")){
    Yii::$app->session->getFlash("print");
    $this->registerJs("printInvoice()");
}
?>
