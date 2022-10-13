<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/10/2020
 * Time: 2:08 PM
 */

use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = 'Sent Quotations';
?>

 <?php
    if (Yii::$app->session->hasFlash('success') && is_string(Yii::$app->session->getFlash('success'))) {
        print ' <div class="alert alert-success alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
 ';
        echo Yii::$app->session->getFlash('success');
        print '</div>';
    } else if (Yii::$app->session->hasFlash('error') && is_string(Yii::$app->session->getFlash('error'))) {
        print ' <div class="alert alert-danger alert-dismissable">
                                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                                ';
        echo Yii::$app->session->getFlash('error');
        print '</div>';
    }
?>

<!--THE STEPS THING--->

<div class="row">
    <div class="col-md-12">
        <?php //$this->render('..\company-profile\_steps') ?>
    </div>
</div>

<!--END THE STEPS THING--->







<div class="card-body">
 
        <div class="table-responsive">
            <table id="table"  class="table table-bordered">
            </table>

        </div>
    
</div>

<input type="hidden" id="url" name="absolute" value="<?= Yii::$app->recruitment->absoluteUrl() ?>">

<?php

$script = <<<JS

    $(function(){
         /*Data Tables*/
         
         // $.fn.dataTable.ext.errMode = 'throw';
        const url = $('#url').val();
    
          $('#table').DataTable({
           
            //serverSide: true,  
            ajax: url+'quotations/list',
            paging: true,
            columns: [
                { title: 'No' ,data: 'No'},
                { title: 'Title' ,data: 'Title'},
                { title: 'Status' ,data: 'Status'},
                { title: 'action' ,data: 'action'}               
            ] ,                              
           language: {
                "zeroRecords": "No Request for Quotations to display"
            },
            
            order : [[ 0, "desc" ]]
            
           
       });
        
       //Hidding some 
       var table = $('#table').DataTable();
      // table.columns([0,6]).visible(false);
    
    /*End Data tables*/
        $('#table').on('click','tr', function(){
            
        });
    });
        
JS;

$this->registerJs($script);