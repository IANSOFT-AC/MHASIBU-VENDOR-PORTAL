<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/10/2020
 * Time: 2:08 PM
 */

use app\models\Supplier;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = 'Company Directors';

if (Yii::$app->session->hasFlash('success')) {
    print ' <div class="alert alert-success alert-dismissable">
                             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
} else if (Yii::$app->session->hasFlash('error')) {
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
        <?= $this->render('..\company-profile\_steps') ?>
    </div>
</div>

<!--END THE STEPS THING--->


<?php if((property_exists(Supplier::Vendor(),'Registration_Status') &&  Supplier::Vendor()->Registration_Status == 'New')): ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?=  Html::a('Add Director', ['add-line'], [
                    'class' => 'add btn btn-primary btn-md mr-2 ',
                    'data-no' => Yii::$app->user->identity->VendorId,
                    'data-service' => 'SupplierPartnerDetails'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>



<div class="card-body">
    <table class="table table-bordered dt-responsive table-hover">
        <div class="card-header">

        </div>
        <div class="card-body">
            <?php
            if (is_array($data)) { //show Lines 
            ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text text-info text-bold">Name</td>
                                <td class="text text-info text-bold">National ID. No.</td>
                                <td class="text text-info text-bold">Address</b></td>
                                <td class="text text-info text-bold">Occupation</td>
                                <td class="text text-info text-bold">KRA PIN</td>
                                <td class="text text-info text-bold">Mobile No.</td>
                                <td class="text text-info text-bold">Gender</td>
                                <td class="text text-info text-bold">Shares</td>
                                <td class="text text-info text-bold">Nationality</td>
                                <td class="text text-info text-bold">Passport_No</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            foreach ($data as $obj) :
                                $deleteLink = Html::a('<i class="fa fa-trash"></i>', ['directors/delete', 'Key' => $obj->Key], [
                                    'class' => 'delete btn btn-outline-danger btn-xs',
                                    'data-key' => $obj->Key,
                                    'data-service' => 'SupplierPartnerDetails'
                                ]);
                            ?>
                                <tr>
                                    <td data-key="<?= $obj->Key ?>" data-name="Partner_Name" data-service="SupplierPartnerDetails" ondblclick="addInput(this)"><?= !empty($obj->Partner_Name) ? $obj->Partner_Name : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Partner_ID_No" data-service="SupplierPartnerDetails" ondblclick="addInput(this, 'number')"><?= !empty($obj->Partner_ID_No) ? $obj->Partner_ID_No : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Patrner_Address" data-service="SupplierPartnerDetails" ondblclick="addInput(this)"><?= !empty($obj->Patrner_Address) ? $obj->Patrner_Address : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Partner_Occupation" data-service="SupplierPartnerDetails" ondblclick="addInput(this)"><?= !empty($obj->Partner_Occupation) ? $obj->Partner_Occupation : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="PIN" data-service="SupplierPartnerDetails" ondblclick="addInput(this)"><?= !empty($obj->PIN) ? $obj->PIN : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Mobile_No__x002B_254" data-service="SupplierPartnerDetails" ondblclick="addInput(this, 'tel')"><?= !empty($obj->Mobile_No__x002B_254) ? $obj->Mobile_No__x002B_254 : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Gender" data-service="SupplierPartnerDetails" ondblclick="addDropDown(this,'gender')"><?= !empty($obj->Gender) ? $obj->Gender : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Shares" data-service="SupplierPartnerDetails" ondblclick="addInput(this, 'number')"><?= !empty($obj->Shares) ? $obj->Shares : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Nationality" data-service="SupplierPartnerDetails" ondblclick="addDropDown(this,'countries')"><?= !empty($obj->Nationality) ? $obj->Nationality : '' ?></td>
                                    <td data-key="<?= $obj->Key ?>" data-name="Passport_No" data-service="SupplierPartnerDetails" ondblclick="addInput(this)"><?= !empty($obj->Passport_No) ? $obj->Passport_No : '' ?></td>
                                    <td><?= $deleteLink ?></td>
                                <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            <?php } ?>
        </div>
    </table>
</div>

<input type="hidden" name="absolute" value="<?= Yii::$app->recruitment->absoluteUrl() ?>">






<!--My Bs Modal template  --->

<div class="modal fade bs-example-modal-lg bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="position: absolute">Supplier Profile</h4>
            </div>
            <div class="modal-body">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>

        </div>
    </div>
</div>
<input type="hidden" name="DocNum" value="<?= Yii::$app->user->identity->VendorId ?>" id="" />
<?php

$script = <<<JS

    $(function(){
        
        var absolute = $('input[name=absolute]').val();
        var Docnum = $('input[name=DocNum]').val();

         /*Data Tables*/
         
        // $.fn.dataTable.ext.errMode = 'throw';

          $('#leaves').DataTable({
           
            //serverSide: true,  
            ajax: absolute+'directors/getsignatories?AppNo='+Docnum,
            paging: true,
            responsive:true,
            columns: [
                { title: '#', data: 'index'},
                { title: 'Name' ,data: 'Partner_Name'},
                { title: 'ID No' ,data: 'Partner_ID_No'},
                // { title: 'Occupation' ,data: 'Partner_Occupation'},
                { title: 'PIN' ,data: 'PIN'},
                // { title: 'Should Be Present' ,data: 'Must_Be_Present'}, 
                { title: 'Phone No' ,data: 'Mobile_No__x002B_254'},   
                { title: 'Action' ,data: 'action'},   
               
                
            ] ,                              
           language: {
                "zeroRecords": "No Directors to Show.."
            },
            
            order : [[ 0, "asc" ]]
            
           
       });
        
       //Hidding some 
       var table = $('#leaves').DataTable();
    //   table.columns([0]).visible(false);
    
    /*End Data tables*/
            $('#leaves').on('click','.update', function(e){
                 e.preventDefault();
                var url = $(this).attr('href');
                console.log('clicking...');
                $('.modal').modal('show')
                                .find('.modal-body')
                                .load(url); 
    
            });
            
            
           //Add a record
        
        //  $('.add').on('click',function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('href');
        //     console.log('clicking...');
        //     $('.modal').modal('show')
        //                     .find('.modal-body')
        //                     .load(url); 
    
        //  });
        
        /*Handle dismissal eveent of modal */
        $('.modal').on('hidden.bs.modal',function(){
            var reld = location.reload(true);
            setTimeout(reld,1000);
        });
    });
        
JS;

$this->registerJs($script);
