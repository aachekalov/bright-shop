<?php

namespace app\models;

use Yii;

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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dt' => 'Dt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleProducts()
    {
        return $this->hasMany(SaleProduct::className(), ['sale_id' => 'id']);
    }
}
