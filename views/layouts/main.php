<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Kawah Putih',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    [
                        'label' => 'Home',
                        'url' => ['/site/index'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'User',
                        'url' => ['/user/index'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest && Yii::$app->user->identity->user_type == User::TYPE_ADMIN ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'Item',
                        'url' => ['/item/index'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest && Yii::$app->user->identity->user_type == User::TYPE_ADMIN ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'Kartu', 'url' => ['/kartu/index'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'Isi Saldo',
                        'url' => ['/saldo/create'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'Transaksi',
                        'url' => ['/transaksi/create'],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest ? 'show' : 'hide'
                        ],
                    ],
                    [
                        'label' => 'Laporan',
                        'items' => [
                            ['label' => 'Laporan Isi Saldo', 'url' => ['/laporan/saldo']],
                            ['label' => 'Laporan Transaksi', 'url' => ['/laporan/transaksi']],
                            ['label' => 'Laporan Detail', 'url' => ['/laporan/detail']],
                        ],
                        'options' => [
                            'class' => !Yii::$app->user->isGuest && Yii::$app->user->identity->user_type == User::TYPE_ADMIN ? 'show' : 'hide'
                        ],
                    ],
                    Yii::$app->user->isGuest ?
                        ['label' => 'Login', 'url' => ['/site/login']] :
                        [
                            'label' => 'Logout',
                            'items' => [
                                [
                                    'label' => 'Profile',
                                    'url' => ['/site/profile'],
                                ],
                                [
                                    'label' => 'Logout',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post'],
                                ],
                            ],
                        ],
                ],
            ]);
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Kawah Putih <?= date('Y') ?></p>
            <p class="pull-right"><!-- Develop by <a href="http://bamboodigitalstudio.com" target="_blank">Bamboo Digital Studio</a>--></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
