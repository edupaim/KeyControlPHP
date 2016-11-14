<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
if(!Yii::$app->user->isGuest){
    if(Yii::$app->user->identity->type == \app\models\UserType::TYPE_ADMINISTRATOR){
        echo \yii\bootstrap\Html::a('Users',['user/index'],['class'=>['btn','btn-default','margin']]);
    }
}
echo \yii\bootstrap\Html::a('Keys',['key/index'],['class'=>['btn','btn-default','margin']]);
echo \yii\bootstrap\Html::a('Customers',['customer/index'],['class'=>['btn','btn-default','margin']]);
echo \yii\bootstrap\Html::a('Lend Keys',['key/borrow'],['class'=>['btn','btn-default','margin']]);
echo \yii\bootstrap\Html::a('Return Keys',['key/return'],['class'=>['btn','btn-default','margin']]);