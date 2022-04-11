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
    echo Yii::$app->session->getFlash('error');
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

                            <?= $form->field($model, 'Address')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Address_2')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Post_Code')->dropDownList($towns,['prompt' => 'Select ...','readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'City')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Country_Region_Code')->dropDownList($countries,['prompt' => 'Select ... ','readonly' => true,'diasbled' => true]) ?>


                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'Phone_No')->textInput(['maxlength'=> '15','readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'E_Mail')->textInput(['type' => 'email','readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Home_Page')->textInput(['maxlength'=> '100','readonly' => true,'diasbled' => true]) ?>
                        
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
                            <?= $form->field($model, 'Supplier_Type')->dropDownList($scategories,['prompt' => 'Select ...','readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Application_Date')->textInput(['readonly' => true, 'disabled'=> 'true', 'readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'AGPO_Certificate')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Trade_Licennse_No')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Registration_No')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Registration_Date')->textInput(['type' => 'date', 'readonly' => true,'diasbled' => true]) ?>
                            



                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'Tax_Compliance_Certificate_No')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'Tax_Compliance_Expiry_Date')->textInput(['type' => 'date','readonly' => true,'diasbled' => true ]) ?>
                            <?= $form->field($model, 'VAT_Certificate_No')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'PIN_No')->textInput(['readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'No_of_Businesses_at_one_time')->textInput(['readonly' => true,'diasbled' => true]) ?>
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
                            <?= $form->field($model, 'Payment_Terms_Code')->dropDownList($paymentTerms,['prompt' => 'Select ...','readonly' => true,'diasbled' => true]) ?>
                           
                        </div>
                        <div class="col-md-6">
                             <?= $form->field($model, 'Payment_Method_Code')->dropDownList($paymentMethods,['prompt' => 'select ...','readonly' => true,'diasbled' => true]) ?>
                            <?= $form->field($model, 'HasAcceptedTermsAndConditions')->dropDownList([true => 'Yes',false => 'No'],['prompt' => 'Select ...','readonly' => true,'diasbled' => true]) ?>
                            

                        </div>
                    </div>
                </div>

            </div>
        </div>

	<!-- Supplier Uploads -->
		

        <div class="form-group">
                    <?= Html::Button('Ok', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
