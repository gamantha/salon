<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Transaction;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\Json;

use yii\widgets\Pjax;
use common\models\Product;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $model common\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>



<div class="sales-form">


<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ],
]); ?>

 <?= $form->field($model, 'transaction_id')->textInput(['readonly' => 'true']) ?>


<?php

$products=Product::find()->all();
$listData=ArrayHelper::map($products,'id', 'name');
$priceData=ArrayHelper::map($products,'id', 'price');

$re = json_encode($priceData);

echo $form->field($model, 'product_id')->widget(Select2::classname(), [
    'data' => $listData,
    'options' => ['placeholder' => 'Select product ...'],
    'pluginOptions' => [
        'allowClear' => true
    ],
    'pluginEvents' => [
        "change" => "function() { 
            var par = [];
            par[1] = '23';
            par[6] = 'yr';
            var data_row = ".$re.";
            $('#sales-price_charged').val(data_row[$(this).children(':selected').val()]);
        
        }"
     /*   "change" => "function() { log('change'); }",
        "select2:opening" => "function() { log('select2:opening'); }",
        "select2:open" => "function() { log('open'); }",
        "select2:closing" => "function() { log('close'); }",
        "select2:close" => "function() { log('close'); }",
        "select2:selecting" => "function() { log('selecting'); }",
        "select2:select" => "function() { log('select'); }",
        "select2:unselecting" => "function() { log('unselecting'); }",
        "select2:unselect" => "function() { log('unselect'); }"
        */
    ]
]);

if (Yii::$app->user->identity->username == 'admin') {
    $readonly = false;
} else {
    $readonly = true;
}



    echo $form->field($model, 'price_charged')->textInput([
        'readonly' => $readonly
    ]);
 //echo $form->field($model, 'dependent')->textInput();
?>

    <div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Add new') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
