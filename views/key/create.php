<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Key */
/* @var array $typeList */

$this->title = Yii::t('app', 'Create Key');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Keys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'typeList' => $typeList
    ]) ?>

</div>
