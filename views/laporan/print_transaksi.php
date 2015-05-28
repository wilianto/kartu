<!DOCTYPE HTML>
<html>
    <head>
        <title>Print Laporan Transaksi</title>
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
                    <h1>Laporan Transaksi</h1>
                    <h2>Kawah Putih</h2>
                    <h3>Ciwidey - Bandung</h3>
                </div>
                <div class="content">
                    <table border="0">
                        <tr>
                            <td>Periode</td><td>:</td><td><?= $start_date ?> s/d <?= $end_date ?></td>
                        </tr>
                        <tr>
                            <td>Operator</td><td>:</td><td><?= $user->username ?></td>
                        </tr>
                        <tr>
                            <td>Total</td><td>:</td><td><?= Yii::$app->formatter->asCurrency($total, 'IDR') ?></td>
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
