<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Customer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>


<?php

echo $form->field($model, 'birthdate')->widget(\yii\jui\DatePicker::class, [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    'containerOptions' => [
        'class' => 'form-group field-customer-birthdate',
    ],
    'options' => [
        'class' => 'form-control',
    ],
]);


echo $form->field($model, 'gender')->dropDownList(
    ['male' => 'Male', 'female' => 'Female']
); 


?>


    <?= $form->field($model, 'address')->textArea(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
