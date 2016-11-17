<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
if (!Yii::$app->user->isGuest) {
    echo '<p>';
    echo \yii\bootstrap\Html::a('Users', ['user/index'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo \yii\bootstrap\Html::a('Keys', ['key/index'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo \yii\bootstrap\Html::a('Customers', ['customer/index'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo '</p><p>';
    echo \yii\bootstrap\Html::a('Borrow Keys', ['key/borrow'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo \yii\bootstrap\Html::a('Return Keys', ['key/return'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo \yii\bootstrap\Html::a('History', ['operation-history/index'], ['class' => ['btn', 'btn-default', 'margin']]);
    echo '</p>';
} else {
    echo \yii\bootstrap\Html::a('Login', ['site/login'], ['class' => ['btn', 'btn-default', 'margin']]);
}
