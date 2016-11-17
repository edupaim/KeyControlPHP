<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $typeList */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel, 'typeList' => $typeList]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'user',
            [
                'attribute' => 'type',
                'value' => 'userType.name',
                'filter' => $typeList
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete} {updatePassword}',
                'buttons' => [
                    'updatePassword' => function ($url, $model, $key) {
                        return Html::a(\kartik\icons\Icon::show('Update', ['class' => 'glyphicon glyphicon-lock']), Url::to(['user/update-password', 'id' => $model->id]));
                    }
                ]
            ]
        ]
    ]); ?>
</div>
