<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RefRole */

$this->title = Yii::t('app', 'Create Ref Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ref Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-role-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
