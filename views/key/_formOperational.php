<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $keyModel app\models\Key */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="key-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($keyModel, 'customer_id')->widget(Select2::className(), [
        'data' => $customerList,
        'options' => [
            'placeholder' => 'Select a user ...',
            'options' => [
//                ID => ['disabled' => true],
            ]
        ],
    ]); ?>

    <?= $form->field($keyModel, 'id')->widget(Select2::className(), [
        'data' => $keyList,
        'options' => [
            'placeholder' => 'Select a user ...',
            'options' => [
//                ID => ['disabled' => true],
            ]
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
