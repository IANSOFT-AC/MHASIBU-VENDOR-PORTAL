<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
$absoluteUrl = \yii\helpers\Url::home(true);
?>
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Supplier Bank Accounts</h3>
            </div>
            <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            'id' => 'form-banks',
                            // 'layout' => 'horizontal',
                            'enableClientValidation' => true,
                            'encodeErrorSummary' => false,
                            'options' => ['enctype' => 'multipart/form-data']]); ?>
                        
            
                        <div class="row">
                            <div class=" row col-md-12">
            
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Bank_Account_No')->textInput(['required' =>  true,'autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'Code')->dropdownList($banks, ['prompt' => 'Select ...']) ?>
                                    
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Name')->textInput(['required' =>  true]) ?>
                                    <?= $form->field($model, 'SWIFT_Code')->textInput(['required' =>  true]) ?>
                                    
                                    
                                    
                                    <?= $form->field($model,'Key')->hiddenInput(['readonly' => true])->label(false) ?>
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
    $('#bankaccount-bank_account_no').on('change',(e) => {
        globalFieldUpdate("BankAccount",'bank-account',"Bank_Account_No", e);
    });

    $('#bankaccount-code').on('change',(e) => {
        globalFieldUpdate("BankAccount",'bank-account',"Code", e);
    });

    $('#bankaccount-name').on('change',(e) => {
        globalFieldUpdate("BankAccount",'bank-account',"Name", e);
    });

    $('#bankaccount-swift_code').on('change',(e) => {
        globalFieldUpdate("BankAccount",'bank-account',"SWIFT_Code", e);
    });

   





    
});



JS;

$this->registerJS($script);

