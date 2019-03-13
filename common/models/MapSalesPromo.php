<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "map_sales_promo".
 *
 * @property string $id
 * @property string $sales_id
 * @property string $promotion_id
 * @property string $note
 * @property string $status
 *
 * @property Promotion $promotion
 */
class MapSalesPromo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'map_sales_promo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'promotion_id'], 'integer'],
            [['note'], 'string'],
            [['status'], 'string', 'max' => 255],
            [['promotion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Promotion::className(), 'targetAttribute' => ['promotion_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sales_id' => Yii::t('app', 'Sales ID'),
            'promotion_id' => Yii::t('app', 'Promotion ID'),
            'note' => Yii::t('app', 'Note'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPromotion()
    {
        return $this->hasOne(Promotion::className(), ['id' => 'promotion_id']);
    }

    /**
     * {@inheritdoc}
     * @return MapSalesPromoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MapSalesPromoQuery(get_called_class());
    }
}
