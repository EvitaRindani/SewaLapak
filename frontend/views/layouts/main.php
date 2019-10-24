<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

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
    <body style="background: url('../../frontend/web/images/wallp.jpg') no-repeat top fixed;">
        <?php $this->beginBody() ?>

        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'SewaLapak.com',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Beranda', 'url' => ['/site/index']],
                ['label' => 'Sewa Lapak', 'url' => ['/tanah/index']],
                // ['label' => 'Detail Tanah', 'url' => ['/detail-tanah/index']],
                //['label' => 'Pemesanan', 'url' => ['/pemesanan/index']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = '<li>'
                        . Html::beginForm(['/pemesanan/index'], 'post')
                        . Html::submitButton(
                                'Detail Penyewaan', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                $menuItems[] = '<li>'
                        . Html::beginForm(['/komentar/index'], 'post')
                        . Html::submitButton(
                                'Komentar', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                                'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                

                

            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
            <div class="lelang-index" style="background-color: rgba(255,255,255,0.7); padding: 30px;border-radius: 4px">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div></div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left" style="color: white">Copyright &copy; 2017 SewaLapak.com - Created by Kelompok Tak Terlampaui <!-- <?= date('Y') ?> --></p>

                <p class="pull-right"><?= Yii::powered() ?></p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
