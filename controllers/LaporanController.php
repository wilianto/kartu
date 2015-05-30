<?php
namespace app\controllers;

use Yii;
use app\controllers\SiteController;
use app\models\Transaksi;
use app\models\User;
use yii\filters\AccessControl;

class LaporanController extends SiteController{
    public $defaultAction = "saldo";

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => !Yii::$app->user->isGuest && Yii::$app->user->identity->user_type == User::TYPE_ADMIN,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionSaldo(){
        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');
        $operator = Yii::$app->request->get('operator');

        if(!empty($start_date) && !empty($end_date)){
            $user = User::findOne($operator);

            if($operator != 0 && null === $user){
                throw new \yii\web\HttpException(404, "Not Found");
            }

            $total = Transaksi::getReport(Transaksi::TIPE_SALDO, $start_date, $end_date, $operator);

            if($operator != 0){
                return $this->renderPartial('print_saldo', [
                    'total' => $total[0]['total'],
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'user' => $user,
                ]);
            }else{
                return $this->renderPartial('print_saldo_massal', [
                    'total' => $total,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'user' => $user,
                ]);
            }
        }else{
            return $this->render('saldo');
        }
    }

    public function actionTransaksi(){
        $start_date = Yii::$app->request->get('start_date');
        $end_date = Yii::$app->request->get('end_date');
        $operator = Yii::$app->request->get('operator');

        if(!empty($start_date) && !empty($end_date)){
            $user = User::findOne($operator);

            if($operator != 0 && null === $user){
                throw new \yii\web\HttpException(404, "Not Found");
            }

            $total = Transaksi::getReport(Transaksi::TIPE_TRANSAKSI, $start_date, $end_date, $operator);

            if($operator != 0){
                return $this->renderPartial('print_transaksi', [
                    'total' => $total[0]['total'],
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'user' => $user,
                ]);
            }else{
                return $this->renderPartial('print_transaksi_massal', [
                    'total' => $total,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'user' => $user,
                ]);
            }
        }else{
            return $this->render('transaksi');
        }
    }
}
?>
