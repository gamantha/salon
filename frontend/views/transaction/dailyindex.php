<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TransactionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Transactions for ') . date("l, Y-m-d");
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Transaction'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    
    if (Yii::$app->user->identity->username == 'admin') {
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'hover' => true,
        'rowOptions'   => function ($model, $key, $index, $grid) {
            return ['data-id' => $model->id];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [

                'label' => 'Transaction ID',
                'value' => function($data) {
                    return $data->id;
                }
            ],
            [
                'label' => 'Customer',
                'value' => function($data) {
                    return $data->customer->name;
                }
            ],
            'datetime',
            'status',

           [
            'class' => 'yii\grid\ActionColumn',
             'template'=>'{delete}',

         ],
        ],
    ]);

    } else {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'hover' => true,
            'rowOptions'   => function ($model, $key, $index, $grid) {
                return ['data-id' => $model->id];
            },
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
    
                    'label' => 'Transaction ID',
                    'value' => function($data) {
                        return $data->id;
                    }
                ],
                [
                    'label' => 'Customer',
                    'value' => function($data) {
                        return $data->customer->name;
                    }
                ],
                'datetime',
                'status',
            ],
        ]);
    }
    ?>
    <?php Pjax::end(); ?>
</div>

<?php
$this->registerJs("

    $('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = '" . Url::to(['transaction/view']) . "?id=' + id;
    });

");
?>