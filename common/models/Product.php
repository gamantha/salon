<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property int $price
 * @property int $dependent
 *
 * @property Product $dependent0
 * @property Product[] $products
 * @property Sales[] $sales
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price', 'dependent'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['dependent'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['dependent' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'dependent' => Yii::t('app', 'Dependent'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDependent0()
    {
        return $this->hasOne(Product::className(), ['id' => 'dependent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['dependent' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasMany(Sales::className(), ['product_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }
}
