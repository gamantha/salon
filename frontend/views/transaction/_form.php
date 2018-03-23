<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Customer;

use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>

       <?= Html::a(Yii::t('app', 'Create Customer'), ['customer/createforsales'], ['class' => 'btn btn-success']) ?>

<?php

$employee_roles=Customer::find()->all();
$listData=ArrayHelper::map($employee_roles,'id', 'name');


?>
        <?= $form->field($model, 'customer_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
            ) ?>


<?php

echo '<label class="control-label">Startup Time</label>';
echo DateTimePicker::widget([
	//'name' => 'startup_time',
	'model' => $model,
	'attribute' => 'datetime',
	//'value' => '02/01/2001 05:10:20',
    'readonly' => true,
	'pluginOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss'
	]
]);

?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
