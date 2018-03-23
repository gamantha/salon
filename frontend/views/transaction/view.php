<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\data\ActiveDataProvider;
use common\models\Sales;
use common\models\Work;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Transaction */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Transactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transaction-view">

    <h1>Transaction ID : <?= Html::encode($this->title) ?></h1>

    <p>


        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            ['label' => 'customer name',
            'value' => function($data) {return $data->customer->name;}],
            'datetime',
         //   'created_at',
         //   'updated_at',
        ],
    ]) ?>

    <p><h1>Items</h1></p>
<?php

$query = Sales::find()->andWhere(['transaction_id' => $model->id]);

$provider = new ActiveDataProvider([
    'query' => $query,
    'pagination' => [
        'pageSize' => 10,
    ],
    'sort' => [
        'defaultOrder' => [

        ]
    ],
]);


?>
<p>
        <?= Html::a(Yii::t('app', 'Add Item'), ['sales/create', 'id' => $model->id, 'transaction' => $transaction], ['class' => 'btn btn-primary']) ?>
</p>
        <?= GridView::widget([
        'dataProvider' => $provider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'transaction_id',
            [
                'label' => 'Product',
                'value' => function($data) {
                    return $data->product->name;
                }
            ],
            'price_charged',
            [
                'label' => 'server',
                'value' => function($data) {
                    $server = Work::find()->andWhere(['sales_id' => $data->id])->One();
                    if (null !== $server) {
                        return $server->employee->name;
                    } else {
                        return null;
                    }
                    
                }
            ],
            [
                'label' => 'commission type',
                'value' => function($data) {
                    $server = Work::find()->andWhere(['sales_id' => $data->id])->One();
                    if (null !== $server) {
                        return $server->commission_type;
                    } else {
                        return null;
                    }
                    
                }
            ],
            [
                'label' => 'commission',
                'value' => function($data) {
                    $server = Work::find()->andWhere(['sales_id' => $data->id])->One();
                    if (null !== $server) {
                        return $server->commission;
                    } else {
                        return null;
                    }
                    
                }
            ],
            [
               'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete} {server}',
               'buttons' => [
                    'update' => function ($url, $model) use ($transaction){ 
                                return Html::a('Update', Url::to(['sales/update','id' => $model->id, 'transaction' => $transaction]), [
                    'title' => Yii::t('yii', 'Update'),
                ]); 
                            },
                    'delete' => function ($url, $model) use ($transaction){  
                                return Html::a('Delete', Url::to(['sales/delete','id' => $model->id, 'transaction' => $transaction]), [
                    'title' => Yii::t('yii', 'Delete'),
                            'data-confirm' => Yii::t('yii', 'Are you sure you want to delete?'),
                            'data-method' => 'post', 'data-pjax' => '0'
                ]); 

                            },
                    'server' => function ($url, $model) use ($transaction){ 
                                $isexists = Work::find()->andWhere(['sales_id' => $model->id])->One();
                                if (null !== $isexists) {
                                return Html::a('Server', Url::to(['work/update','id' => $isexists->id, 'transaction' => $transaction]), [
                                        'title' => Yii::t('yii', 'Server'),
                                  ]); 
                                } else {
                                return Html::a('Server', Url::to(['work/create','id' => $model->id, 'transaction' => $transaction]), [
                                        'title' => Yii::t('yii', 'Server'),
                                  ]); 
                            }
                            }
               ]
            ],
        ],
    ]); ?>


</div>
