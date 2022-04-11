<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/21/2020
 * Time: 4:19 PM
 */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BsAsset;
use common\widgets\Alert;

BsAsset::register($this);
$this->title = Yii::$app->name;


$webroot = Yii::getAlias(@$webroot);
$absoluteUrl = \yii\helpers\Url::home(true);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- PWA SHIT -->

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#FEF207">
    <link rel="apple-touch-icon" href="/images/manifest/96.png"/>
    <meta name="apple-mobile-web-app-status-bar" content="#01A54F">
    
    <!-- / PWA SHIT -->
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-light">
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-md bg-primary navbar-dark fixed-top ">
    <div class="container">
        <a href="/" class="navbar-brand">
            <img src="<?= $webroot ?>/images/logo.png" alt="MHASIBU LOGO" class="image" height="70px">
            <h3 class="d-inline align-middle">Supplier Portal</h3>
        </a>
   
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <!-- <a href="#" class="nav-link active">Renders</a> -->
                    <?= Html::a('Tenders',['site/tenders'],['class' => 'nav-link active'])?>
                </li>
                 <!-- <li class="nav-item">
                    <a href="#" class="nav-link">Contracts</a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link">Invoices</a>
                </li>
                 <li class="nav-item">
                    <a href="#" class="nav-link">Documents</a>
                </li> -->
            </ul>
        </div>
    </div>
</nav>


<section class="signup bg-light my-5 p-5 text-center">
    <div class="container ">
    <?php
   
if(Yii::$app->session->hasFlash('success') && is_string(Yii::$app->session->getFlash('success'))){
    print ' <div class="alert alert-success alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
}else if(Yii::$app->session->hasFlash('error') && is_string(Yii::$app->session->getFlash('error'))){
    print ' <div class="alert alert-danger alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                                ';
    echo Yii::$app->session->getFlash('error');
    print '</div>';
}
?>

        <p class="display-4 py-3 lead"><?= Yii::$app->controller->action->id == 'reset-password'?'Fill out below form to Reset your Password':'Fill out below form to login.' ?></p>
         <div class="row">
            <div class="col-md-5 d-none d-md-block">      
                <img src="<?= $webroot ?>/images/login.svg" class="img-fluid" />
            </div>
             <div class="col-md-7 col-sm-12">
               
                <div class="card text-center card-form">
                    <div class="card-body">
                         <?= $content?>
                     </div>
                </div>
            </div>
         </div>   

    </div>
 
</section>



</body>
<footer class="text-center text-lg-start bg-light text-muted ">
	<section class="d-flex justify-content-center justify-content-lg-between p-5 border-top">
		<div class="me-5">
			<strong>Copyright &copy; MHASIBU SACCO <span style="color: #02A14E" title="<?= \Yii::$app->name ?>"><?= \Yii::$app->name ?> <?= date('Y') ?>.</strong>
		All rights reserved.
		</div>
		<div class="d-none d-lg-block">
			<b style="color: darkblue"><?= Yii::signature() ?></b>
		</div>
	</section>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage(); ?>


