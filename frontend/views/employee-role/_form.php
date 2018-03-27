<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefEmployeeRole;	
use common\models\Employee;

/* @var $this yii\web\View */
/* @var $model common\models\EmployeeRole */
/* @var $form yii\widgets\ActiveForm */
?>


<?php



$employee_roles=RefEmployeeRole::find()->all();

//use yii\helpers\ArrayHelper;
$listData=ArrayHelper::map($employee_roles,'employee_role', 'employee_role');


$employees=Employee::find()->all();
$listData2=ArrayHelper::map($employees,'id', 'name');


?>
<div class="employee-role-form">

    <?php $form = ActiveForm::begin(); ?>



<?php
echo $form->field($model, 'employee_id')->dropDownList(
        $listData2,
        ['prompt'=>'Select...']
        );

echo $form->field($model, 'employee_role')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
        );
?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
