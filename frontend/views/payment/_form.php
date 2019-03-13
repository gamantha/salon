<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Payment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'transaction_id')->textInput([
        'value' => $_GET['id'],
        'readonly' => true
    ]
    ) ?>

    <?php
    
    $options = ['cash' => 'cash', 'cc' => 'credit card'];

        echo $form->field($model, 'payment_type')->dropDownList(
        $options,
        ['prompt'=>'Select...']
        );

    ?>

    <?= $form->field($model, 'payment_amount')->textInput([


    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
