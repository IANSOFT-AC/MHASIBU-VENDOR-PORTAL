<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
$absoluteUrl = \yii\helpers\Url::home(true);
?>
        
        <div class="card card-primary">

            <div class="card-header card-primary">
                <h3 class="card-title">Signatory Details</h3>
            </div>
                    
              
              <div class="card-body">
                  <?php $form = ActiveForm::begin([
                       'id' => 'form-directors',
                      // 'layout' => 'horizontal',
                       'enableClientValidation' => true,
                       'encodeErrorSummary' => false,
                      'options' => ['enctype' => 'multipart/form-data']]); ?>
                  

                  <div class="row">
                      <div class=" row col-md-12">

                          <div class="col-md-6">
                              <?= $form->field($model, 'Partner_Name')->textInput(['required' =>  true]) ?>
                              <?= $form->field($model, 'Partner_ID_No')->textInput(['maxlength' => 9]) ?>
                              <?= $form->field($model, 'Partner_Occupation')->textInput() ?>
                              <?= $form->field($model, 'Mobile_No__x002B_254')->widget(PhoneInput::className(), [
                              'jsOptions' => [
                                  'preferredCountries' => ['ke'],
                              ]]) ?>
                          
                          </div>

                          <div class="col-md-6">

                              <?= $form->field($model, 'Gender')->dropDownList([
                                  'Female' => 'Female',
                                  'Male' => 'Male',
                              ],['prompt' => 'Select Gender']) ?>

                              <?= $form->field($model, 'Shares')->textInput(['type' => 'number']) ?>
                             
                             <?= $form->field($model, 'PIN')->textInput() ?>

                             <?= $form->field($model, 'Nationality')->dropDownList(ArrayHelper::map($Countries, 'Code', 'Name'),['prompt' => '-- Select Option ---']) ?>


                             <?= $form->field($model,'Key')->hiddenInput(['readonly' => true])->label(false) ?>
                          </div>



                      </div>
                  </div>
                 
              </div>
        </div>
                    
                    
             </div>
            
        <?php ActiveForm::end(); ?>
    </div>
</div>

<input type="hidden" name="absolute" value="<?= $absoluteUrl ?>">

<?php
$script = <<<JS

$(function() {
    $('#supplierpartnerdetails-partner_name').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Partner_Name", e);
    });

    $('#supplierpartnerdetails-partner_id_no').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Partner_ID_No", e);
    });

    $('#supplierpartnerdetails-partner_occupation').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Partner_Occupation", e);
    });

    $('#supplierpartnerdetails-mobile_no__x002b_254').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Mobile_No__x002B_254", e);
    });

    $('#supplierpartnerdetails-gender').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Gender", e);
    });

    $('#supplierpartnerdetails-shares').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Shares", e);
    });

    $('#supplierpartnerdetails-pin').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"PIN", e);
    });

    $('#supplierpartnerdetails-nationality').on('change',(e) => {
        globalFieldUpdate("SupplierPartnerDetails",'directors',"Nationality", e);
    });





    
});



JS;

$this->registerJS($script);

