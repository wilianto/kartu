<!DOCTYPE HTML>
<html>
    <head>
        <title>Print Laporan Saldo</title>
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
                    <h1>Laporan Isi Saldo</h1>
                    <h2>Kawah Putih</h2>
                    <h3>Ciwidey - Bandung</h3>
                    <p>Periode: <?= $start_date ?> s/d <?= $end_date ?></p>
                </div>
                <div class="content">
                    <table border="0">
                        <tr>
                            <td width="120px"><b>Operator</b></td><td><b>Total Isi Saldo</b></td>
                        </tr>
                        <?php
                        $nominal_total = 0;
                        foreach($total as $v){
                            ?>
                            <tr>
                                <td><?= $v['username'] ?></td><td align="right"><?= Yii::$app->formatter->asCurrency($v['total'], 'IDR') ?></td>
                            </tr>
                            <?php
                            $nominal_total += $v['total'];
                        }
                        ?>
                        <tr>
                            <td><b>Total</b></td><td align="right"><?= Yii::$app->formatter->asCurrency($nominal_total, 'IDR') ?></td>
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
