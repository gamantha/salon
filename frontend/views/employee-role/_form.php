<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\RefEmployeeRole;	

/* @var $this yii\web\View */
/* @var $model common\models\EmployeeRole */
/* @var $form yii\widgets\ActiveForm */
?>


<?php



$employee_roles=RefEmployeeRole::find()->all();

//use yii\helpers\ArrayHelper;
$listData=ArrayHelper::map($employee_roles,'employee_role', 'employee_role');




?>
<div class="employee-role-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->textInput() ?>

<?php

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
