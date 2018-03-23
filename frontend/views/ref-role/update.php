<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\RefRole */

$this->title = Yii::t('app', 'Update Ref Role: {nameAttribute}', [
    'nameAttribute' => $model->role_name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->role_name, 'url' => ['view', 'id' => $model->role_name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ref-role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
