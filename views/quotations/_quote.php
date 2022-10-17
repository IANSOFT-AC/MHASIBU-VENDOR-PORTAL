<?php
use yii\bootstrap4\Html as Bootstrap4Html;
?>
 <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                   <td class="text-bold">Vendor No</td>
                                   <td class="text-bold">Vendor Name</td>
                                   <td class="text-bold">Item No</td>
                                   <td class="text-bold">Item Name</td>
                                   <td class="text-bold text-primary">Description</td>
                                   <td class="text-bold text-primary">Quoted Amount per Item</td>
                                   <td class="text-bold text-primary">VAT_Inclusive</td>
                                   <td class="text-bold ">VAT_Amount</td>
                                   <td class="text-bold text-primary">Lead_Time</td>
                                   <td class="text-bold">Quantity</td>                                  
                                   <td class="text-bold">Total Amount</td>                                  
                                   <td class="text-bold">Submitted</td>                                  

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $obj) :                                   
                                ?>
                                    <tr>
                                        <td data-key="<?= $obj->Key ?>" data-name="Vendor_No" data-service="VendorQuotedAmount"><?= !empty($obj->Vendor_No) ? $obj->Vendor_No : '' ?></td>
                                        <td class="Vendor_Name"><?= !empty($obj->Vendor_Name) ? $obj->Vendor_Name : '' ?></td>
                                        <td class="Item_No"><?= !empty($obj->Item_No) ? $obj->Item_No : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Item_Name" data-service="VendorQuotedAmount"><?= !empty($obj->Item_Name) ? $obj->Item_Name : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Description" data-service="VendorQuotedAmount" ondblclick="addTextarea(this)" ><?= !empty($obj->Description) ? $obj->Description : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Quoted_Amount" data-service="VendorQuotedAmount" ondblclick="addInput(this,'number')" ><?= !empty($obj->Quoted_Amount) ? $obj->Quoted_Amount : '' ?></td>
                                        <td data-validate="VAT_Amount" data-key="<?= $obj->Key ?>" data-name="VAT_Inclusive" data-service="VendorQuotedAmount" ondblclick="addInput(this,'checkbox')" ><?= !empty($obj->VAT_Inclusive) ? $obj->VAT_Inclusive : '' ?></td>
                                        <td class="VAT_Amount" data-key="<?= $obj->Key ?>" data-name="VAT_Amount" data-service="VendorQuotedAmount"><?= !empty($obj->VAT_Amount) ? $obj->VAT_Amount : '' ?></td>
                                        <td data-validate="Total_Amount" data-key="<?= $obj->Key ?>" data-name="Lead_Time" data-service="VendorQuotedAmount" ondblclick="addInput(this, 'number')" ><?= !empty($obj->Lead_Time) ? $obj->Lead_Time : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Quantity" data-service="VendorQuotedAmount" ><?= !empty($obj->Quantity) ? $obj->Quantity : '' ?></td>
                                        <td class="Total_Amount"><?= !empty($obj->Total_Amount) ? $obj->Total_Amount : '' ?></td>
                                        <td><?= Bootstrap4Html::checkbox('Submitted', $obj->Submitted,['readonly' => true,'disabled' => true]) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>