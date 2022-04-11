<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$webroot = Yii::getAlias(@$webroot);

$this->title = Yii::$app->name ;
?>
<div class="site-index">

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
    

    <div class="body-content">

        <div class="row my-5">
            <div class="col-md-10 text-center offset-md-1">
                <div class="alert alert-primary" >You are not a registered supplier, click button on the right to complete and submit a supplier profile</div>
            </div>
        </div>

        <div class="row">
        <div class="col-md-10 text-center offset-md-1">
            <div class="showcase d-flex">
                    <div class="showcase-img">
                            <img src="<?= $webroot ?>/images/profile.svg" class="img-fluid" />
                    </div>

                    <div class="showcase-btn my-auto">

                            <?= Html::a('Update Supplier Profile', yii\helpers\Url::toRoute('./company-profile/update'),['class' => 'btn btn-lg btn-outline-primary']); ?>
                    </div>
            </div>
        </div>
           

           
           
        </div>

    </div>
</div>
