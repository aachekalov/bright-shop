<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Accept */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accepts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accept-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dt',
        ],
    ]) ?>

	<h3>Товары</h3>

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'product.name',
            'quantity',
        ],
    ]); ?>

</div>
