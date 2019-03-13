<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Customer;

use kartik\widgets\ActiveForm;
use kartik\widgets\DateTimePicker;

use kartik\typeahead\TypeaheadBasic;
use kartik\typeahead\Typeahead;
use yii\helpers\Url;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\Transaction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="transaction-form">

    <?php $form = ActiveForm::begin(); ?>
<?php
$employee_roles=Customer::find()->all();
$listData=ArrayHelper::map($employee_roles,'id', 'name');

echo Html::a(Yii::t('app', 'New Customer'), ['customer/createforsales'], ['class' => 'btn btn-success']);
echo $form->field($model, 'customer_id')->widget(Select2::classname(), [
    'data' => $listData,
    'options' => ['placeholder' => 'Select customer ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
]);








?>
        <?php
  /*      
        echo $form->field($model, 'customer_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...']
        );
*/

//echo '<br/>';
echo '<label class="control-label">Transaction Time</label>';
echo DateTimePicker::widget([
	//'name' => 'startup_time',
	'model' => $model,
	'attribute' => 'datetime',
	//'value' => '2018-01-13 05:10:20',
    'readonly' => true,
	'pluginOptions' => [
		'autoclose' => true,
		'format' => 'yyyy-mm-dd hh:ii:ss'
	]
]);




echo '<br/>';

?>


    <div class="form-group">
       
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create new transaction') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
