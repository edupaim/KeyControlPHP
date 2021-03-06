<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperationHistorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Operation Histories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operation-history-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'userName',
                'value' => 'user.name'
            ],
            [
                'attribute' => 'customerName',
                'value' => 'customer.name'
            ],
            'date',
            [
                'attribute' => 'keyRoom',
                'value' => 'key.room'
            ],
            [
                'attribute' => 'type',
                'value' => 'type0.name',
                'filter' => [1 => 'Empréstimo', 2 => 'Devolução']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}'
            ],
        ],
    ]); ?>
</div>
