<!DOCTYPE HTML>
<html>
    <head>
        <title>Print <?= $model->no ?></title>
        <style>
        body{
            font-size: 14px;
            font-family: arial;
        }
        h1{
            font-size: 18px;
            margin: 0px;
        }
        h2{
            font-size: 16px;
            margin: 0px;
        }
        .container{
            max-width: 300px;
            min-width: 300px;
            width: 300px;
        }
        .header{
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }
        .content{
            padding-top: 5px;
            padding-bottom: 5px;
        }
        .footer{
            padding-top: 10px;
            border-top: 1px dashed #000;
            text-align: center;
        }
        @media print{
            .no-print{
                display: none;
            }
        }
        </style>
        <script>
        window.print();
        setTimeout("window.close()", 100);
        </script>
    </head>
    <body>
        <div class="container">
            <div class="no-print">
                <button type="button" onclick="window.print()">Print</button>
            </div>
            <div class="print">
                <div class="header">
                    <h1>Kawah Putih</h1>
                    <h2>Ciwidey - Bandung</h2>
                </div>
                <div class="content">
                    <table border="0">
                        <tr>
                            <td>No Transaksi</td><td>:</td><td><?= $model->no ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td><td>:</td><td><?= $model->tgl ?></td>
                        </tr>
                        <tr>
                            <td>Operator</td><td>:</td><td><?= $model->user->username ?></td>
                        </tr>
                        <tr>
                            <td colspan=3>
                                &nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td>No Kartu</td><td>:</td><td><?= $model->kartu->no_kartu ?></td>
                        </tr>
                        <tr>
                            <td>Nama</td><td>:</td><td><?= $model->kartu->nama ?></td>
                        </tr>
                        <tr>
                            <td>Alamat</td><td>:</td><td><?= $model->kartu->alamat ?></td>
                        </tr>
                        <tr>
                            <td>Saldo Keluar</td><td>:</td><td><?= Yii::$app->formatter->asCurrency($model->nominal, 'IDR') ?></td>
                        </tr>
                        <tr>
                            <td>Sisa Saldo</td><td>:</td><td><?= Yii::$app->formatter->asCurrency($model->saldo_awal - $model->nominal, 'IDR') ?></td>
                        </tr>
                    </table>
                </div>
                <div class="footer">
                    Terima kasih atas kunjungannya
                </div>
            </div>
        </div>
    </body>
</html>