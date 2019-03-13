<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "promotion".
 *
 * @property string $id
 * @property string $product_id
 * @property string $promotion_name
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property int $hour_start
 * @property int $hour_end
 * @property string $discount_type
 * @property int $discount_amount
 * @property string $get_promotion_id
 * @property string $status
 *
 * @property MapSalesPromo[] $mapSalesPromos
 */
class Promotion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promotion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'hour_start', 'hour_end', 'discount_amount', 'get_promotion_id'], 'integer'],
            [['description'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['promotion_name', 'discount_type', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'promotion_name' => Yii::t('app', 'Promotion Name'),
            'description' => Yii::t('app', 'Description'),
            'date_start' => Yii::t('app', 'Date Start'),
            'date_end' => Yii::t('app', 'Date End'),
            'hour_start' => Yii::t('app', 'Hour Start'),
            'hour_end' => Yii::t('app', 'Hour End'),
            'discount_type' => Yii::t('app', 'Discount Type'),
            'discount_amount' => Yii::t('app', 'Discount Amount'),
            'get_promotion_id' => Yii::t('app', 'Get Promotion ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMapSalesPromos()
    {
        return $this->hasMany(MapSalesPromo::className(), ['promotion_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PromotionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PromotionQuery(get_called_class());
    }
}
