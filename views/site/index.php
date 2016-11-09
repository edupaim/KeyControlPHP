<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';

echo \yii\bootstrap\Html::a('Users',['user/index'],['class'=>['btn','btn-default','margin']]);
echo \yii\bootstrap\Html::a('Keys',['key/index'],['class'=>['btn','btn-default','margin']]);
echo \yii\bootstrap\Html::a('Customers',['customer/index'],['class'=>['btn','btn-default','margin']]);