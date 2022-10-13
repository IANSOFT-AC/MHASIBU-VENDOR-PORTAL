<?php

use app\models\Supplier;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use borales\extensions\phoneInput\PhoneInput;
use yii\bootstrap4\Html as Bootstrap4Html;

$absoluteUrl = \yii\helpers\Url::home(true);
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => 'Advertised Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'My Quote Per Item', 'url' => ['quote', 'quoteNo' => $data[0]->Quote_No]];
?>
       
       <div class="row">
        <?= (!$data[0]->Submitted) ? Html::a('<i class="fas fa-check"></i> Submit Quote', ['submit'], [
                'class' => 'btn btn-app bg-success submitforapproval',
                'data' => [
                    'confirm' => 'Are you sure you want to submit this quote ?',
                    'params' => [
                        'quoteNo' => $data[0]->Quote_No,
                        'vendorNo' => Supplier::VendorNo()
                    ],
                    'method' => 'get',
                ],
                'title' => 'Submit Quote'

            ]) : '' ?>
       </div>
        
        <!-- Lines -->

        <div class="card">
            <div class="card-header">
                <h3 class="card-title text-bold"><?= $title ?> : <span class="text-primary">RFQ</span> <?= $data[0]->Quote_No?></h3>
                <div class="card-tools my-2 px-3">
                    <?php if(!$data[0]->Submitted): ?>
                        <span class="text text-info border border-info p-2 rounded">To Update line values, double click on cells whose column headers are colored blue.</span>
                    <?php endif; ?>
                    </div>
            </div>

            <div class="card-body">

                <?php if (is_array($data)) { //show Lines 
                ?>
                    <?php if($data[0]->Submitted){
                        echo $this->render('_quote_submitted', ['data' => $data]);
                    }else{
                        echo $this->render('_quote', ['data' => $data]);
                    }
                    
                    ?>
                    
                   
                <?php } ?>
            </div>
        </div>

        <!-- / Lines -->

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

