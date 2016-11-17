<?php
/**
 * Created by PhpStorm.
 * User: eduardo
 * Date: 10/11/16
 * Time: 17:50
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KeySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var \app\models\Key $model */

$this->title = Yii::t('app', 'Borrow Key');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="key-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_formBorrow',
        [
            'keyModel' => $keyModel,
            'keyList' => $keyList,
            'customerList' => $customerList,
            'customerListDisabled' => $customerListDisabled,
            'keyListDisabled' => $keyListDisabled,
            'customerModel' => $customerModel
        ]
    ); ?>
</div>
