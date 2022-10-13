<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/24/2020
 * Time: 6:09 PM
 */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;


?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">




                <h3 class="card-title text-bold">Tender : <?= $model->No ?></h3>



                <?php
                    if(Yii::$app->session->hasFlash('success')){
                        print ' <div class="alert alert-success alert-dismissable">
                                 ';
                                    echo Yii::$app->session->getFlash('success');
                        print '</div>';
                    }else if(Yii::$app->session->hasFlash('error')){
                        print ' <div class="alert alert-danger alert-dismissable">
                                 ';
                        echo Yii::$app->session->getFlash('success');
                        print '</div>';
                    }
                ?>
            </div>
            <div class="card-body">


               <?php $form = ActiveForm::begin(['action'=> ['leave/create']]); ?>


               <div class="row">
                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'No')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Status')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>

                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Title')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Requisiton_No')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Current_Budget')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Supplier_Category')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Opening_Date')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Duration')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Closing_Date')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Extension_Period')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>
                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Extended_Closing_Date')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Global_Dimension_1_Code')->checkbox(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Requires_Inspection')->checkbox(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Security_Amount')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Max_Score')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Technical_Pass_Mark')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Technical_Score')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Financial_Score')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Technical_Total_Scores')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Technical_Evaluation_Period')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Financial_Evaluation_Period')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Procurement_Plan')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Tender_Type')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Vendor_No')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Minimum_No_of_Suppliers')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Date_of_Financial_Evaluation')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Date_of_Technical_Evaluation')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Date_of_Mandatory_Evaluation')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>

                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Date_Advertisement')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Date_Awarded')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>

               </div>



               <?php ActiveForm::end(); ?>



            </div>
        </div>

        <!-- Lines -->

        <div class="card">
            <div class="card-header">
                <div class="card-tools my-2 px-3">
                    <!-- <span class="text text-info border border-info p-2 rounded">To Update line values, double click on cells whose column headers are colored blue.</span> -->
                </div>
            </div>

            <div class="card-body">

                <?php if (property_exists($document->Tender_Lines_Line, 'Tender_Lines_Line')) { //show Lines 
                ?>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                   <td class="text-bold">Name</td>
                                   <td class="text-bold">Description</td>
                                   <td class="text-bold">Unit of Measure</td>
                                   <td class="text-bold">Quantity</td>
                                   <td class="text-bold ">Unit Price</td>
                                   <td class="text-bold">Total Amount</td>
                                   <td class="text-bold">Location</td>
                                   <td class="text-bold">Type</td>
                                   

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                

                                foreach ($document->Tender_Lines_Line->Tender_Lines_Line   as $obj) :
                                   
                                ?>
                                    <tr>
                                        <td data-key="<?= $obj->Key ?>" data-name="Name" data-service="quotationLines"><?= !empty($obj->Name) ? $obj->Name : '' ?></td>
                                        <td class="Description"><?= !empty($obj->Description) ? $obj->Description : '' ?></td>
                                        <td class="Unit_of_Measure"><?= !empty($obj->Unit_of_Measure) ? $obj->Unit_of_Measure : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Quantity" data-service="quotationLines"><?= !empty($obj->Quantity) ? $obj->Quantity : '' ?></td>
                                        <td data-validate="Total_Amount" data-key="<?= $obj->Key ?>" data-name="Unit_Price" data-service="quotationLines" ><?= !empty($obj->Unit_Price) ? $obj->Unit_Price : '' ?></td>
                                        <td class="Total_Amount"><?= !empty($obj->Total_Amount) ? $obj->Total_Amount : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Location" data-service="quotationLines" ><?= !empty($obj->Location) ? $obj->Location : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Type" data-service="quotationLines"><?= !empty($obj->Type) ? $obj->Type : '' ?></td>
                                       
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- / Lines -->
    </div>
</div>
