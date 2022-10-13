<?php

/**
 * Created by PhpStorm.
 * User: HP ELITEBOOK 840 G5
 * Date: 3/10/2020
 * Time: 2:08 PM
 */

use app\models\Supplier;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap\Html as BootstrapHtml;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */

$this->title = 'Supplier Additional Addresses';
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
                <?php $form = ActiveForm::begin(['id' => 'supplier_attachment'], ['options' => ['enctype' => 'multipart/form-data']]); ?>
                <?= $form->field($model, 'type')->dropDownList(ArrayHelper::map($types, 'Name', 'Description'), ['prompt' => 'Select File Type ...']) ?>
                <?= $form->field($model, 'attachment')->fileInput(['accept' => 'application/pdf', 'data-name' => '']) ?>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>

<?php endif; ?>



<div class="card-body">
    <?php
    if (is_array($data)) { //show Lines 
        //Yii::$app->recruitment->printrr($data);
    ?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td class="text text-info text-bold">Name</b></td>
                        <td class="text text-info text-bold">Path</td>
                        <td class="text text-info text-bold">Action</td>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data as $obj) :
                        if (!property_exists($obj, 'Key')) {
                            continue;
                        }
                        $deleteLink = Html::a('<i class="fa fa-trash"></i>', ['delete-line', 'Key' => $obj->Key], [
                            'class' => 'delete btn btn-outline-danger btn-xs',
                            'data-key' => $obj->Key,
                            'data-service' => 'SupplierAttachments'
                        ]);
                    ?>
                        <tr>
                            <td><?= !empty($obj->Name) ? $obj->Name : '' ?></td>
                            <td><?= BootstrapHtml::a('<i class="fas fa-file-pdf mx-1"></i>', ['read', 'path' => $obj->File_path ?? ''], ['class' => 'btn btn-primary', 'target' => '_blank']); ?></td>
                            <td><?= $deleteLink ?></td>
                        <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    <?php } ?>

</div>

<input type="hidden" name="absolute" value="<?= Yii::$app->recruitment->absoluteUrl() ?>">






<!--My Bs Modal template  --->

<div class="modal fade bs-example-modal-lg bs-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel" style="position: absolute">Supplier Profile</h4>
            </div>
            <div class="modal-body">
                <div class="spinner-border" role="status">
                    <span class="sr-only">Loading</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>

        </div>
    </div>
</div>

<?php

$script = <<<JS

$(function(){
    $('#attachment-type').change(function(){
        let attachmentType = $(this).val();
        console.log(attachmentType); 
        $('#attachment-attachment').attr('data-name', attachmentType);
    });

    $('#attachment-attachment').on('change', function(){
        console.log( $('#attachment-attachment').data('name'));
        globalUpload('SupplierAttachments','attachment','attachment','SupplierAttachments');
    });
});

       
JS;

$this->registerJs($script);
