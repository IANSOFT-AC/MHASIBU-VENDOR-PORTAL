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

$this->title = 'Supplier Bank Accounts';
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
                <?= Html::a('Add Bank A/c', ['add-line'], [
                    'class' => 'add btn btn-primary btn-md mr-2 ',
                    'data-no' => Yii::$app->user->identity->VendorId,
                    'data-service' => 'SupplierBankAccounts'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>



<div class="card-body">
    <?php if (is_array($data)) { //show Lines     
    ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text text-info text-bold">Account Name</td>
                        <td class="text text-info text-bold">Address</td>
                        <td class="text text-info text-bold">City</b></td>
                        <!-- <td class="text text-info text-bold">Post Code</td> -->
                        <td class="text text-info text-bold">Contact</td>
                        <td class="text text-info text-bold">Bank Code</td>
                        <td class="text text-info text-bold">Bank_Branch_No</td>
                        <td class="text text-info text-bold">Bank_Account_No</td>
                        <!-- <td class="text text-info text-bold">E_Mail</td> -->
                        <td class="text text-info text-bold">SWIFT_Code</td>
                        <td class="text text-info text-bold">Action</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $obj) :
                        $deleteLink = Html::a('<i class="fa fa-trash"></i>', ['delete', 'Key' => $obj->Key], [
                            'class' => 'delete btn btn-outline-danger btn-xs',
                            'data-key' => $obj->Key,
                            'data-service' => 'SupplierBankAccounts'
                        ]);
                    ?>
                        <tr>
                            <td data-key="<?= $obj->Key ?>" data-name="Name" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->Name) ? $obj->Name : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Address" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->Address) ? $obj->Address : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="City" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->City) ? $obj->City : '' ?></td>
                            <!-- <td data-key="<?= $obj->Key ?>" data-name="Post_Code" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->Post_Code) ? $obj->Post_Code : '' ?></td> -->
                            <td data-key="<?= $obj->Key ?>" data-name="Contact" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->Contact) ? $obj->Contact : '' ?></td>
                            <td class="Code" data-key="<?= $obj->Key ?>" data-name="Code" data-service="SupplierBankAccounts" ondblclick="addDropDown(this,'banks')"><?= !empty($obj->Code) ? $obj->Code : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Bank_Branch_No" data-service="SupplierBankAccounts" ondblclick="addDropDown(this,'bank-branch',{'Bank_Code': 'Code'})"><?= !empty($obj->Bank_Branch_No) ? $obj->Bank_Branch_No : '' ?></td>
                            <td data-key="<?= $obj->Key ?>" data-name="Bank_Account_No" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->Bank_Account_No) ? $obj->Bank_Account_No : '' ?></td>
                            <!-- <td data-key="<?= $obj->Key ?>" data-name="E_Mail" data-service="SupplierBankAccounts" ondblclick="addInput(this, 'email')"><?= !empty($obj->E_Mail) ? $obj->E_Mail : '' ?></td> -->
                            <td data-key="<?= $obj->Key ?>" data-name="SWIFT_Code" data-service="SupplierBankAccounts" ondblclick="addInput(this)"><?= !empty($obj->SWIFT_Code) ? $obj->SWIFT_Code : '' ?></td>

                            <td><?= $deleteLink ?></td>
                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php } ?>
</div>