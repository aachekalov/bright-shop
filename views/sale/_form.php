<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use unclead\multipleinput\MultipleInput;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Sale */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'products')->widget(MultipleInput::className(), [
			'columns' => [
				[
					'name'  => 'product_id',
					'type'  => 'dropDownList',
					'title' => 'Товар',
					'items' => ArrayHelper::map(Product::find()->all(), 'id', 'name'),
				],
				[
					'name'  => 'quantity',
					'title' => 'Количество',
					'enableError' => true,
				]
			],
			'addButtonPosition' => MultipleInput::POS_FOOTER,
		])
	?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
