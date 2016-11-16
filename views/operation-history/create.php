<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OperationHistory */

$this->title = Yii::t('app', 'Create Operation History');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Operation Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
