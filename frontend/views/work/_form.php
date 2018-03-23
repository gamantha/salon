<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Employee;
use common\models\RefEmployeeRole;

/* @var $this yii\web\View */
/* @var $model common\models\Work */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="work-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sales_id')->textInput(['readonly' => 'true']) ?>


<?php

$employee_roles=Employee::find()->all();
$listData=ArrayHelper::map($employee_roles,'id', 'name');


?>
        <?= $form->field($model, 'employee_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
            ) ?>

<?php

$roles=RefEmployeeRole::find()->all();
$listRoles=ArrayHelper::map($roles,'employee_role', 'employee_role');
$commission_types = ['fixed' => 'fixed', 'percentage' => 'percentage'];


?>

    
        <?= $form->field($model, 'role')->dropDownList(
        $listRoles,
        ['prompt'=>'Select...']
            ) ?>

        <?= $form->field($model, 'commission_type')->dropDownList(
        $commission_types,
        ['prompt'=>'Select...']
            ) ?>

        <?= $form->field($model, 'commission')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
