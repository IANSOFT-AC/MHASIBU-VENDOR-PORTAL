<?php
/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 2/26/2020
 * Time: 5:41 AM
 */




use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
//$this->title = Yii::$app->params['generalTitle'].' - Supplier Details'
$absoluteUrl = \yii\helpers\Url::home(true);
?>
<h2 class="title">Supplier : <?= $model->No ?></h2>

<?php


if(Yii::$app->session->hasFlash('success')){
    print ' <div class="alert alert-success alert-dismissable">
                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                                 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
}else if(Yii::$app->session->hasFlash('error')){
    print ' <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <h5><i class="icon fas fa-check"></i> Error!</h5>
                                 ';
    echo Yii::$app->session->getFlash('success');
    print '</div>';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?= $this->render('_steps',['model' => $model]); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <?php $form = ActiveForm::begin([ 
                'id' => 'form-signup',
                'layout' => 'horizontal',
                'enableClientValidation' => true,
                'encodeErrorSummary' => false
            ]); ?>
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">General Details - Vendor <?= $model->No ?></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class=" row col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($model, 'Name')->textInput(['required' =>  true]) ?>
                            <?= $form->field($model, 'Key')->hiddenInput(['readonly' =>  true])->label(false) ?>
                            
                            

                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'Generated_Vendor_No')->textInput(['readonly' =>  true, 'diasbled' => true]) ?>
                            <?= $form->field($model, 'Status')->textInput(['readonly' =>  true, 'diasbled' => true]) ?>
                           
                        </div>
                    </div>
                </div>







            </div>
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Address</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class=" row col-md-12">
                        <div class="col-md-6">

                            <?= $form->field($model, 'Address')->textInput([]) ?>
                            <?= $form->field($model, 'Address_2')->textInput([]) ?>
                            <?= $form->field($model, 'Post_Code')->dropDownList($towns,['prompt' => 'Select ...']) ?>
                            <?= $form->field($model, 'City')->textInput(['readonly' =>  true]) ?>

                            <?= $form->field($model, 'Country_Region_Code')->dropDownList($countries,['prompt' => 'Select ... ']) ?>


                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'Phone_No')->textInput(['maxlength'=> '15']) ?>
                            <?= $form->field($model, 'E_Mail')->textInput(['type' => 'email']) ?>
                            <?= $form->field($model, 'Home_Page')->textInput(['maxlength'=> '100']) ?>
                           



                        </div>
                    </div>
                </div>







            </div>
        </div>

        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title">Procurement Details</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>

            </div>
            <div class="card-body">

                <div class="row">
                    <div class=" row col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($model, 'Supplier_Type')->dropDownList($scategories,['prompt' => 'Select ...']) ?>
                            <?= $form->field($model, 'Application_Date')->textInput(['readonly' => true, 'disabled'=> 'true']) ?>
                            <?= $form->field($model, 'AGPO_Certificate')->textInput([]) ?>
                            <?= $form->field($model, 'Trade_Licennse_No')->textInput([]) ?>
                            <?= $form->field($model, 'Registration_No')->textInput([]) ?>
                            <?= $form->field($model, 'Registration_Date')->textInput(['type' => 'date']) ?>
                            



                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'Tax_Compliance_Certificate_No')->textInput([]) ?>
                            <?= $form->field($model, 'Tax_Compliance_Expiry_Date')->textInput(['type' => 'date' ]) ?>
                            <?= $form->field($model, 'VAT_Certificate_No')->textInput([]) ?>
                            <?= $form->field($model, 'PIN_No')->textInput([]) ?>
                            <?= $form->field($model, 'No_of_Businesses_at_one_time')->textInput([]) ?>
                            <?= $form->field($model, 'Registration_Status')->textInput(['readonly' => true, 'disabled'=> 'true']) ?>


                        </div>
                    </div>
                </div>







            </div>
        </div>

       



       

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Payments</h3>


                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>


            </div>
            <div class="card-body">

                <div class="row">
                    <div class=" row col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($model, 'Payment_Terms_Code')->dropDownList($paymentTerms,['prompt' => 'Select ...']) ?>
                           
                            

                        </div>
                        <div class="col-md-6">
                             <?= $form->field($model, 'Payment_Method_Code')->dropDownList($paymentMethods,['prompt' => 'select ...']) ?>
                            <?= $form->field($model, 'HasAcceptedTermsAndConditions')->dropDownList([true => 'Yes',false => 'No'],['prompt' => 'Select ...']) ?>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>

	<!-- Supplier Uploads -->
		

        <div class="form-group">
                    <?php Html::Button('Save Profile', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<input type="hidden" name="absolute" value="<?= $absoluteUrl ?>">
<?php
$script = <<<JS

$(function() {

    $('#vendorcard-name').on('change',(e) => {
        globalFieldUpdate("VendorCard",'company-profile' ,"Name", e);
    });

    $('#vendorcard-address').on('change',(e) => {
        globalFieldUpdate("VendorCard",'company-profile' ,"Address", e);
    });

    $('#vendorcard-post_code').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Post_Code", e,['City']);
    });

    $('#vendorcard-address_2').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Address_2", e);
    });

    $('#vendorcard-city').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"City", e);
    });

    $('#vendorcard-country_region_code').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Country_Region_Code", e);
    });

    $('#vendorcard-phone_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Phone_No", e);
    });

    $('#vendorcard-e_mail').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"E_Mail", e);
    });
    $('#vendorcard-home_page').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Home_Page", e);
    });
    $('#vendorcard-supplier_type').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Supplier_Type", e);
    });
    $('#vendorcard-agpo_certificate').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"AGPO_Certificate", e);
    });
    $('#vendorcard-trade_licennse_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Trade_Licennse_No", e);
    });
    $('#vendorcard-registration_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Registration_No", e);
    });
    $('#vendorcard-registration_date').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Registration_Date", e);
    });
    $('#vendorcard-tax_compliance_certificate_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Tax_Compliance_Certificate_No", e);
    });
    $('#vendorcard-tax_compliance_expiry_date').on('blur',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Tax_Compliance_Expiry_Date", e);
    });
    $('#vendorcard-vat_certificate_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"VAT_Certificate_No", e);
    });
    $('#vendorcard-pin_no').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"PIN_No", e);
    });
    $('#vendorcard-no_of_businesses_at_one_time').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"No_of_Businesses_at_one_time", e);
    });
    $('#vendorcard-payment_terms_code').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Payment_Terms_Code", e);
    });
    $('#vendorcard-payment_method_code').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"Payment_Method_Code", e);
    });

    $('#vendorcard-hasacceptedtermsandconditions').on('change',(e) => {
        globalFieldUpdate("VendorCard", 'company-profile',"HasAcceptedTermsAndConditions", e);
    });
    

    
});


JS;

$this->registerJS($script);

