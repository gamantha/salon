<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "sales".
 *
 * @property int $id
 * @property int $transaction_id
 * @property int $product_id
 * @property int $price_charged
 * @property int $dependent
 * @property int $created_at
 * @property int $updated_at
 * @property int $promo_amount 
 *
 * @property Product $product
 * @property Sales $dependent0
 * @property Sales[] $sales
 * @property Transaction $transaction
 * @property Work[] $works
 */
class Sales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'product_id'], 'required'],
            [['transaction_id', 'product_id', 'price_charged', 'dependent', 'created_at', 'updated_at', 'promo_amount'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['dependent'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['dependent' => 'id']],
            [['transaction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Transaction::className(), 'targetAttribute' => ['transaction_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'price_charged' => Yii::t('app', 'Price Charged'),
            'dependent' => Yii::t('app', 'Dependent'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'promo_amount' => Yii::t('app', 'Promo Amount'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependent0()
    {
        return $this->hasOne(Sales::className(), ['id' => 'dependent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['dependent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransaction()
    {
        return $this->hasOne(Transaction::className(), ['id' => 'transaction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Work::className(), ['sales_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return SalesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalesQuery(get_called_class());
    }
}
