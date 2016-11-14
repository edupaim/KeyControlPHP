<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Key */
/* @var $form yii\widgets\ActiveForm */
/* @var array $keyList */
?>

<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($keyModel, 'id')->widget(Select2::className(), [
        'data' => $keyList,
        'options' => [
            'placeholder' => 'Select a user ...',
            'options' => [
//                CUSTOMER_ID => ['disabled' => true],
            ]
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Return'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
