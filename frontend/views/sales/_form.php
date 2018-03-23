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



/* @var $this yii\web\View */
/* @var $model common\models\Sales */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
 
$this->registerJs(
   '$("document").ready(function(){ 
        $("#new_country").on("pjax:end", function() {
            $.pjax.reload({container:"#countries"});  //Reload GridView
        });
    });'
);
?>


<div class="sales-form">

<?php yii\widgets\Pjax::begin(['id' => 'new_country']) ?>

<?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ],
]); ?>

 <?= $form->field($model, 'transaction_id')->textInput(['readonly' => 'true']) ?>


<?php

$products=Product::find()->all();
$listData=ArrayHelper::map($products,'id', 'name');


?>
        <?= $form->field($model, 'product_id')->dropDownList(
        $listData,
        ['prompt'=>'Select...', 
            'id' => 'product-id'
        ]
            ) ?>




    <?php
    echo $form->field($model, 'price_charged')->textInput();
     ?>

    <?= $form->field($model, 'dependent')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php yii\widgets\Pjax::end() ?>
</div>
