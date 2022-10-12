<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/26/2020
 * Time: 10:59 PM
 */



/* @var $this yii\web\View */

$this->title = 'Vendors - Document Reader';
$this->params['breadcrumbs'][] = ['label' => 'Attachments', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => 'printout', 'url' => ['print-imprest', 'DocNo' => $_GET['No']]];
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Supplier Document. </h3>

            </div>
            <div class="card-body">

                <!--<iframe src="data:application/pdf;base64,<?/*= $content; */ ?>" height="950px" width="100%"></iframe>-->
                <?php
                if (Yii::$app->session->hasFlash('error')) {
                    print '<p class="alert alert-info">' . Yii::$app->session->getFlash('error') . ' . </p>';
                }
                if ($report) { ?>

                    <iframe src="data:application/pdf;base64,<?= $content; ?>" height="950px" width="100%"></iframe>
                <?php } ?>



            </div>
        </div>
    </div>
</div>