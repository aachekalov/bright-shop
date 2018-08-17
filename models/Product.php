<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $quantity
 *
 * @property AcceptProduct[] $acceptProducts
 * @property SaleProduct[] $saleProducts
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['quantity'], 'integer'],
            [['quantity'], 'default', 'value' => 0],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'quantity' => 'Остаток',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAcceptProducts()
    {
        return $this->hasMany(AcceptProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleProducts()
    {
        return $this->hasMany(SaleProduct::className(), ['product_id' => 'id']);
    }
}
