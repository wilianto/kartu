<!DOCTYPE HTML>
<html>
    <head>
        <title>Print Saldo Kartu</title>
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
        h3{
            font-size: 14px;
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
                    <h1>Cek Saldo</h1>
                    <h2>Kawah Putih</h2>
                    <h3>Ciwidey - Bandung</h3>
                </div>
                <div class="content">
                    <table border="0">
                        <tr>
                            <td>Tanggal</td><td>:</td><td><?= date('Y-m-d') ?></td>
                        </tr>
                        <tr>
                            <td>No Kartu</td><td>:</td><td><?= $model->no_kartu ?></td>
                        </tr>
                        <tr>
                            <td>Sisa saldo</td><td>:</td><td><?= Yii::$app->formatter->asCurrency($model->saldo, 'IDR') ?></td>
                        </tr>
                    </table>
                </div>
                <div class="footer">
                    <small>Dicetak pada <?= date('Y-m-d') ?> oleh <?= Yii::$app->user->identity->username ?></small>
                </div>
            </div>
        </div>
    </body>
</html>
