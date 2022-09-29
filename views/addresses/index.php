<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/10/2020
 * Time: 2:08 PM
 */

use yii\bootstrap4\Html;

/* @var $this yii\web\View */

$this->title = 'Supplier Additional Addresses';
?>


<!--THE STEPS THING--->

<div class="row">
    <div class="col-md-12">
        <?= $this->render('..\company-profile\_steps') ?>
    </div>
</div>

<!--END THE STEPS THING--->



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= Html::a('Add Address', ['add-line'], [
                    'class' => 'add btn btn-primary btn-md mr-2 ',
                    'data-no' => Yii::$app->user->identity->VendorId,
                    'data-service' => 'SupplierAdditionalAddress'
                ]) ?>
            </div>
        </div>
    </div>
</div>



<div class="card-body">
    <?php
    if (is_array($data)) { //show Lines 
    ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>

                        <td class="text text-info text-bold">Address</b></td>
                        <td class="text text-info text-bold">Post_Code</td>
                        <td class="text text-info text-bold">City</td>
                        <td class="text text-info text-bold">Country_Code</td>
                        <td class="text text-info text-bold">Physical_Location</td>
                        <td class="text text-info text-bold">Telephone_No</td>
                        <td class="text text-info text-bold">E_mail</td>
                        <td class="text text-info text-bold">Action</td>

                    </tr>
                </thead>
                <tbody>
                    <?php


                    foreach ($data as $obj) :
                        $deleteLink = Html::a('<i class="fa fa-trash"></i>', ['delete', 'Key' => $obj->Key], [
                            'class' => 'delete btn btn-outline-danger btn-xs',
                            'data-key' => $obj->Key,
                            'data-service' => 'SupplierAdditionalAddress'
                        ]);
                    ?>
                        <tr>
                            <td data-key="<?= $obj->Key ?>" data-name="Address" data-service="SupplierAdditionalAddress" ondblclick="addInput(this)"><?= !empty($obj->Address) ? $obj->Address : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Post_Code" data-service="SupplierAdditionalAddress" ondblclick="addDropDown(this, 'postalcodes')"><?= !empty($obj->Post_Code) ? $obj->Post_Code : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="City" data-service="SupplierAdditionalAddress" ondblclick="addInput(this)"><?= !empty($obj->City) ? $obj->City : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Country_Code" data-service="SupplierAdditionalAddress" ondblclick="addDropDown(this,'countries')"><?= !empty($obj->Country_Code) ? $obj->Country_Code : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Physical_Location" data-service="SupplierAdditionalAddress" ondblclick="addTextarea(this)"><?= !empty($obj->Physical_Location) ? $obj->Physical_Location : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Telephone_No" data-service="SupplierAdditionalAddress" ondblclick="addInput(this, 'tel')"><?= !empty($obj->Telephone_No) ? $obj->Telephone_No : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="E_mail" data-service="SupplierAdditionalAddress" ondblclick="addInput(this,'email')"><?= !empty($obj->E_mail) ? $obj->E_mail : '' ?></td>

                            <td><?= $deleteLink ?></td>
                        <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    <?php } ?>

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

<?php

$script = <<<JS
        
JS;

$this->registerJs($script);
