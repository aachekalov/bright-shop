<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Accept */

$this->title = 'Приемка товаров';
$this->params['breadcrumbs'][] = ['label' => 'Accepts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accept-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
