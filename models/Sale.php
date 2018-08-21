<?php

namespace app\models;

use Yii;
use yii\validators\NumberValidator;

/**
 * This is the model class for table "sale".
 *
 * @property int $id
 * @property string $dt
 *
 * @property SaleProduct[] $saleProducts
 */
class Sale extends \yii\db\ActiveRecord
{
	public $products;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sale';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dt'], 'safe'],
			['products', 'validateProducts'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt' => 'Дата продажи',
			'products' => 'Товары',
        ];
    }

	/**
     * Product validation.
     *
     * @param $attribute
     */
    public function validateProducts($attribute)
    {
        $validator = new NumberValidator();
        foreach($this->$attribute as $index => $row) {
            $error = null;
            foreach (['product_id', 'quantity'] as $name) {
                $error = null;
                $value = isset($row[$name]) ? $row[$name] : null;
                $validator->validate($value, $error);
                if (!empty($error)) {
                    $key = $attribute . '[' . $index . '][' . $name . ']';
                    $this->addError($key, $error);
                }
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleProducts()
    {
        return $this->hasMany(SaleProduct::className(), ['sale_id' => 'id']);
    }
}
