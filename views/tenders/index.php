<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/10/2020
 * Time: 2:08 PM
 */

use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = 'Advertised Tenders';
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
            ajax: url+'tenders/list',
            paging: true,
            columns: [
                { title: 'No' ,data: 'No'},
                { title: 'Title' ,data: 'Title'},
                { title: 'Status' ,data: 'Status'},
                { title: 'Current Budget' ,data: 'Current_Budget'},
                { title: 'Supplier Category' ,data: 'Supplier_Category'},
                { title: 'Tender_Opening_Date' ,data: 'Tender_Opening_Date'},
                { title: 'action' ,data: 'action'}               
            ] ,                              
           language: {
                "zeroRecords": "No Advertised Tenders to display"
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