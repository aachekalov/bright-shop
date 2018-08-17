<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accept".
 *
 * @property int $id
 * @property string $dt
 *
 * @property AcceptProduct[] $acceptProducts
 */
class Accept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accept';
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
    public function getAcceptProducts()
    {
        return $this->hasMany(AcceptProduct::className(), ['accept_id' => 'id']);
    }
}
