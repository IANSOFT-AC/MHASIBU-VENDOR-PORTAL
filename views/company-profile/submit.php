<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/26/2020
 * Time: 5:41 AM
 */




use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//$this->title = Yii::$app->params['generalTitle'].' - Supplier Details'
$absoluteUrl = \yii\helpers\Url::home(true);
?>
<h2 class="title">Supplier : <?= $model->No ?></h2>

<?php


if(Yii::$app->session->hasFlash('success')){
    print ' <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
}else if(Yii::$app->session->hasFlash('error')){
    print ' <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                                 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= $this->render('_steps',['model' => $model]); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Submit Your Profile</h3>
        </div>
        <div class="card-body">
            

            <?= Html::a(' Submit Profile   <i class="mx-1 fa fa-check"></i>',
                                                        ['submit-profile'],
                                                        [
                                                            'class' => 'btn btn-primary',
                                                            'title' => 'Submitting your Supplier Profile',
                                                            'data' => [
                                                                'confirm' => Yii::t('app', 'Are you ready to submit your profile?'),
                                                                'method' => 'post',
                                                            ],
                                                        ]) ?>



        </div>
    </div>
    </div>
    
     
</div>




