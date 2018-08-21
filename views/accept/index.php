<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Приемки товаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accept-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <p>
        <?= Html::a('Принять товары', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'dt',

            [
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{view}'
			],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
