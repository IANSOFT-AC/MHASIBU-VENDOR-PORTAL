<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
$webroot = Yii::getAlias(@$webroot);
$absoluteUrl = \yii\helpers\Url::home(true);
$profileAction = '';//(Yii::$app->user->identity->profileID)?'applicantprofile/update?No='.Yii::$app->user->identity->profileID:'applicantprofile/view-profile';
$CompanyColor = 'indigo';
$SecondaryColorHeaderColor = 'wheat';
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
        <head>
            <meta charset="<?= Yii::$app->charset ?>">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <?php $this->registerCsrfMetaTags() ?>
            <title><?= Html::encode($this->title) ?></title>
            <?php $this->head() ?>
        </head>

        <body class="hold-transition login-page">
            <?php $this->beginBody() ?>

            <div class="login-box">
                <div class="card">
                    <div class="card-body login-card-body">
                    <?php
                    if(Yii::$app->session->hasFlash('success')){
                        print ' <div class="alert alert-success alert-dismissable">
                                 ';
                                    echo Yii::$app->session->getFlash('success');
                        print '</div>';
                    }else if(Yii::$app->session->hasFlash('error')){
                        print ' <div class="alert alert-danger alert-dismissable">
                                 ';
                        echo Yii::$app->session->getFlash('success');
                        print '</div>';
                    }
                ?>
                        <p class="login-box-msg">Sign in to start your session</p>
                        <?= $content ?>
                    </div>
                </div>
            </div>

            <?php $this->endBody() ?>
        </body>

        
        <script>

        $(document).ready(function () {
            $.blockUI({ message: '<h5><img src="<?=$absoluteUrl ?>dist/img/spinner.gif" /> Loading...</h5>' });

            setTimeout(() => {
                $.unblockUI();
            }, 900);
            $('.page-content').toggle();
        });
        
                 </script>
    </html>
<?php $this->endPage() ?>
