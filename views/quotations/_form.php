<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
$absoluteUrl = \yii\helpers\Url::home(true);
?>
        
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><?= $this->title ?></h3>
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
                                    <?= $form->field($model, 'Address')->textInput(['required' =>  true,'autocomplete' => 'off']) ?>
                                    <?= $form->field($model, 'City')->textInput(['maxlength' => 20,'readonly' => true]) ?>
                                    <?= $form->field($model, 'Physical_Location')->textInput(['maxlength' => 150]) ?>
                                    <?= $form->field($model, 'E_mail')->textInput(['type' => 'email','autocomplete' => 'off']) ?>
                                    
                                    
                                </div>
                                
                                <div class="col-md-6">
                                    <?= $form->field($model, 'Post_Code')->dropdownList($postalCodes, ['prompt' => 'Select ...']) ?>
                                    <?= $form->field($model, 'Country_Code')->textInput(['readonly' => true]) ?>
                                    <?= $form->field($model, 'Telephone_No')->textInput(['type' => 'tel','autocomplete' => 'off']) ?>
                                    
                                    
                                    
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
    $('#addresses-address').on('change',(e) => {
        globalFieldUpdate("Addresses", false ,"Address", e);
    });

    $('#addresses-post_code').on('change',(e) => {
        globalFieldUpdate("Addresses", false,"Post_Code", e,['City','Country_Code']);
    });

    $('#addresses-city').on('change',(e) => {
        globalFieldUpdate("Addresses", false,"City", e);
    });

    $('#addresses-physical_location').on('change',(e) => {
        globalFieldUpdate("Addresses", false,"Physical_Location", e);
    });

    $('#addresses-telephone_no').on('change',(e) => {
        globalFieldUpdate("Addresses", false,"Telephone_No", e);
    });

    $('#addresses-e_mail').on('change',(e) => {
        globalFieldUpdate("Addresses", false,"E_mail", e);
    });
     
});

JS;
$this->registerJS($script);

