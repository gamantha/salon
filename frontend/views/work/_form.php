<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Employee;
use common\models\RefEmployeeRole;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sales_id')->textInput(['readonly' => 'true']) ?>


<?php


if (Yii::$app->user->identity->username == 'admin') {
    $readonly = false;
} else {
    $readonly = true;
}



$employee_roles=Employee::find()->all();
$listData=ArrayHelper::map($employee_roles,'id', 'name');


echo $form->field($model, 'employee_id')->widget(Select2::classname(), [
    'data' => $listData,
    'options' => ['placeholder' => 'Select employee ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);




$roles=RefEmployeeRole::find()->all();
$listRoles=ArrayHelper::map($roles,'employee_role', 'employee_role');
$commission_types = ['fixed' => 'fixed', 'percentage' => 'percentage'];

echo $form->field($model, 'role')->widget(Select2::classname(), [
    'data' => $listRoles,
    'options' => ['placeholder' => 'Select role ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);



echo $form->field($model, 'commission_type')->dropDownList(
        $commission_types,
        ['prompt'=>'Select...',
        'readonly' => $readonly
        ]
);

echo $form->field($model, 'commission')->textInput([
    'readonly' => $readonly

]);
echo $form->field($model, 'note')->textarea(['rows' => 6]);

?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
