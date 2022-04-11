<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/21/2020
 * Time: 2:39 PM
 */

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminlteAsset;
use common\widgets\Alert;

AdminlteAsset::register($this);

$webroot = Yii::getAlias(@$webroot);
$absoluteUrl = \yii\helpers\Url::home(true);
$vendor = '';// (!Yii::$app->user->isGuest && Yii::$app->user->identity->VendorId)?Yii::$app->user->identity->vendor:[];


 // Yii::$app->recruitment->printrr(Yii::$app->user->identity->vendor);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?= Html::csrfMetaTags() ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= $absoluteUrl ?>favicon.jfif" rel="shortcut icon" type="image/vnd.microsoft.icon" />

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

<?php $this->beginBody() ?>

<body class="hold-transition sidebar-mini accent-success layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark navbar-primary">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= $absoluteUrl ?>site" class="nav-link">Home</a>
                </li>
                <!--<li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>-->
            </ul>

            <!-- SEARCH FORM -->
            <!--<form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>-->

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <!--<li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start --
                            <div class="media">
                                <img src="<?= $webroot ?>/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End --
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start --
                            <div class="media">
                                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End --
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start --
                            <div class="media">
                                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End --
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>-->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-th-large"></i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!--<span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>-->






                        <div class="dropdown-divider"></div>

                        <?= (Yii::$app->user->isGuest)? Html::a('<i class="fas fa-sign-in-alt "></i> Signup','/site/signup/',['class'=> 'dropdown-item']): ''; ?>

                        <div class="dropdown-divider"></div>

                        <?= (Yii::$app->user->isGuest)? Html::a('<i class="fas fa-lock-open"></i> Login','/site/login/',['class'=> 'dropdown-item']): ''; ?>

                        <div class="dropdown-divider"></div>

                        <div class="dropdown-divider"></div>

                        <?= (!Yii::$app->user->isGuest)? Html::a('<i class="fas fa-sign-out-alt"></i> Logout','/site/logout/',[
                            'class'=> 'dropdown-item',
                            'data' => [
                                'method'=> 'POST'
                            ]
                        ]):''; ?>

                        <div class="dropdown-divider"></div>

                        <?= Html::a('<i class="fas fa-user"></i> Update Profile', $absoluteUrl.'site/update',['class'=> 'dropdown-item']); ?>

                        <div class="dropdown-divider"></div>

                         <?= Html::a('<i class="fas fa-file-pdf"></i> Supplier Documents', $absoluteUrl.'site/uploads',['class'=> 'dropdown-item']); ?>

                        <div class="dropdown-divider"></div>

                        <?php Html::a('<i class="fas fa-address-book"></i> Surveys', $absoluteUrl.'poll',['class'=> 'dropdown-item']); ?>

                    </div>
                </li>
               <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="false" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>-->
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4" >
            <!-- Brand Logo -->
            <a href="<?= $absoluteUrl ?>site" class="brand-link navbar-secondary">
                <img src="<?= $webroot ?>/images/logo.png" alt="MHASIBU Logo" height="70px" class="brand-image bg-light elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light text-light"><?= \Yii::$app->name ?></span>
            </a>

            <!-- Sidebar -->
            <?php if(!Yii::$app->user->isGuest &&   Yii::$app->user->identity->VendorId): ?>
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $webroot ?>/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?= $absoluteUrl ?>employee/" class="d-block"><?= (!Yii::$app->user->isGuest && isset($vendor->Name))? ucwords($vendor->Name): ''?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->



                        <!--Payroll reports -->
                                 <li class="nav-item has-treeview <?= currentCtrl(['quotations'])?'menu-open':'' ?>">
                                    <a href="#" class="nav-link <?= currentCtrl(['quotations'])?'active':'' ?>">
                                        <i class="nav-icon fa fa-file-invoice-dollar"></i>
                                        <p>
                                            Quotations
                                            <i class="fas fa-angle-left right"></i>
                                            <!--<span class="badge badge-info right">6</span>-->
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= $absoluteUrl ?>quotations" class="nav-link <?= currentaction('quotations','index')?'active':'' ?>">
                                                <i class="fa fa-check-square nav-icon"></i>
                                                <p>Requests for Quotations</p>
                                            </a>
                                        </li>  

                                    </ul>
                                </li>

                         <!--Payroll reports -->
                                 <li class="nav-item has-treeview <?= currentCtrl(['site'])?'menu-open':'' ?>">
                                    <a href="#" class="nav-link <?= currentCtrl(['site'])?'active':'' ?>">
                                        <i class="nav-icon fa fa-file-invoice-dollar"></i>
                                        <p>
                                            Tenders
                                            <i class="fas fa-angle-left right"></i>
                                            <!--<span class="badge badge-info right">6</span>-->
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= $absoluteUrl ?>site/tenders" class="nav-link <?= currentaction('site','tenders')?'active':'' ?>">
                                                <i class="fa fa-check-square nav-icon"></i>
                                                <p>Advertised Tenders</p>
                                            </a>
                                        </li>  

                                    </ul>
                                </li>





                            </ul>
                        </li>


                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <?php endif; ?>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <!--<li class="breadcrumb-item"><a href="site">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard v1</li>-->
                                <?=
                                Breadcrumbs::widget([
                                'itemTemplate' => "<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
                                'homeLink' => [
                                'label' => Yii::t('yii', 'Home'),
                                'url' => Yii::$app->homeUrl,
                                ],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ])
                                ?>
                            </ol>

                        </div><!-- /.col-6 bread ish -->

                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <?= $content ?>
                    <!-- /.row (main row) -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->


        <!-- /.content-wrapper -->
        <footer class="main-footer bg-secondary">
            <strong>Copyright &copy; MHASIBU SACCO -  <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>   .</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b><?= Yii::signature() ?></b>
            </div>
        </footer>


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->




    </div>

</body>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();

function currentCtrl($ctrl){
    $controller = Yii::$app->controller->id;

    if(is_array($ctrl)){
        if(in_array($controller,$ctrl)){
            return true;
        }
    }
    if($controller == $ctrl ){
        return true;
    }else{
        return false;
    }
}

function currentaction($ctrl,$actn){//modify it to accept an array of controllers as an argument--> later please
    $controller = Yii::$app->controller->id;
    $action = Yii::$app->controller->action->id;
    if($controller == $ctrl && $action == $actn){
        return true;
    }else{
        return false;
    }
}

?>
