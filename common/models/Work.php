<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "work".
 *
 * @property int $id
 * @property int $sales_id
 * @property int $employee_id
 * @property string $role
 * @property int $commission
 * @property string $commission_type
 * @property string $note
 *
 * @property Employee $employee
 * @property Sales $sales
 */
class Work extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sales_id', 'employee_id', 'commission'], 'integer'],
            [['sales_id', 'employee_id', 'role'], 'required'],
            [['note'], 'string'],
            [['role', 'commission_type'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sales::className(), 'targetAttribute' => ['sales_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sales_id' => Yii::t('app', 'Sales ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'role' => Yii::t('app', 'Role'),
            'commission' => Yii::t('app', 'Commission'),
            'commission_type' => Yii::t('app', 'Commission Type'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee()
    {
        return $this->hasOne(Employee::className(), ['id' => 'employee_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(Sales::className(), ['id' => 'sales_id']);
    }

    /**
     * @inheritdoc
     * @return WorkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkQuery(get_called_class());
    }
}
