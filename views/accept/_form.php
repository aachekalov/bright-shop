<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Accept */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accept-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
