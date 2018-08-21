<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accept_product".
 *
 * @property int $accept_id
 * @property int $product_id
 * @property string $quantity
 *
 * @property Accept $accept
 * @property Product $product
 */
class AcceptProduct extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accept_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['accept_id', 'product_id', 'quantity'], 'required'],
            [['accept_id', 'product_id', 'quantity'], 'integer'],
            [['accept_id'], 'exist', 'skipOnError' => true, 'targetClass' => Accept::className(), 'targetAttribute' => ['accept_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'accept_id' => 'Accept ID',
            'product_id' => 'Product ID',
            'quantity' => 'Количество',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccept()
    {
        return $this->hasOne(Accept::className(), ['id' => 'accept_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
