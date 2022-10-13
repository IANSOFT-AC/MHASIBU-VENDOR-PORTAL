<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/24/2020
 * Time: 6:09 PM
 */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap\Html as BootstrapHtml;

?>

<div class="row">
    <div class="card-body">
    <?= Html::a('<i class="fas fa-coins"></i> Quote Per Item', ['quote'], [
                'class' => 'btn btn-app bg-primary submitforapproval',
                'data' => [
                    'params' => [
                        'quoteNo' => $model->No
                    ],
                    'method' => 'get',
                ],
                'title' => 'Quote for Individual Items.'

            ]) ; ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-bold">RFQ : <?= $model->No ?></h3>
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
                           <?= $form->field($model, 'Global_Dimension_1_Code')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Quotation_Start_Date')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>


                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Quotation_Period')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Quotation_End_Date')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                   </div>
                   <div class=" row col-md-12">
                       <div class="col-md-6">
                           <?= $form->field($model, 'Procurement_Plan')->textInput(['readonly'=> true, 'disabled'=>true]) ?>
                       </div>
                       <div class="col-md-6">
                           <?= $form->field($model, 'Requires_Inspection')->checkbox(['readonly'=> true, 'disabled'=>true]) ?>
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

                <?php if (property_exists($document->Quotation_Lines_Line, 'Quotation_Lines_Line')) { //show Lines 
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
                                

                                foreach ($document->Quotation_Lines_Line->Quotation_Lines_Line   as $obj) :
                                   
                                ?>
                                    <tr>
                                        <td data-key="<?= $obj->Key ?>" data-name="Name" data-service="quotationLines"><?= !empty($obj->Name) ? $obj->Name : '' ?></td>
                                        <td class="Description"><?= !empty($obj->Description) ? $obj->Description : '' ?></td>
                                        <td class="Unit_of_Measure"><?= !empty($obj->Unit_of_Measure) ? $obj->Unit_of_Measure : '' ?></td>
                                        <td data-key="<?= $obj->Key ?>" data-name="Quantity" data-service="quotationLines"><?= !empty($obj->Quantity) ? $obj->Quantity : '' ?></td>
                                        <td data-validate="Total_Amount" data-key="<?= $obj->Key ?>" data-name="Unit_Price" data-service="quotationLines"  ><?= !empty($obj->Unit_Price) ? $obj->Unit_Price : '' ?></td>
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
