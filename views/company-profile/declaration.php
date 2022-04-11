<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Terms and Conditions';

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

    <!--THE STEPS THING--->
    <div class="row">
        <div class="col-md-12">
            <?= $this->render('.\_steps', ['model'=>$model]) ?>
        </div>
    </div>



        <div class="col-md-12">

             <div class="card-body">
                <?php $form = ActiveForm::begin(['id' => 'confrimation-form']); ?>

                   <p>I hereby declare that the information provided in this form is true to the best of my knowledge, and I understand that any false information given could render me liable to immediate disqualification.

                    </p>
                    <p>
                        <ol>

                        <li> <b> ACCURACY OF CONTENT:</b> The content of this application 
                                is accurate and contains no false information.
                        </li>

                        <li> <b>Directors Information: </b> you give your full consent and authorize Mhasibu Sacco to contact each of your kins  
                                listed in this application for the purpose of conducting required reference checks. Any information received will be treated with due regard to confidentiality
                        </li>

                        <li> <b> Contact Information: </b>  Finally you understand that submission of false information or misrepresentation
                                and/or submission of falsified documentation constitutes serious misconduct for which sever disciplinary
                            sanctions can be imposed I consent to all of 
                            the foregoing as part of the process of evaluation of my application
                        </li>

                        </ol>
                    </p>

                    <div class="row">
                        <div class="row col-md-12">
                        <?= $form->field($model, 'Key')->hiddenInput()->label(false); ?>

                        <hr>
                            <div class="col-lg-5">
                                <?= $form->field($model, 'HasAcceptedTermsAndConditions')->checkBox([]) ?>
                            </div>
                        
                            
                    
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                                     <?= Html::submitButton('Submit Profile', ['class' => 'btn btn-success form-control', 'name' => 'login-button']) ?>
                            </div>
                        </div>
                    </div>

                   


                <?php ActiveForm::end(); ?>

            </div>
        </div>
    

           