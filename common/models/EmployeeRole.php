<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee_role".
 *
 * @property int $id
 * @property int $employee_id
 * @property string $employee_role
 *
 * @property Employee $employee
 * @property RefEmployeeRole $employeeRole
 */
class EmployeeRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_id'], 'integer'],
             [['employee_id','employee_role'], 'required'],
            [['employee_role'], 'string', 'max' => 255],
            [['employee_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employee_id' => 'id']],
            [['employee_role'], 'exist', 'skipOnError' => true, 'targetClass' => RefEmployeeRole::className(), 'targetAttribute' => ['employee_role' => 'employee_role']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'employee_id' => Yii::t('app', 'Employee ID'),
            'employee_role' => Yii::t('app', 'Employee Role'),
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
    public function getEmployeeRole()
    {
        return $this->hasOne(RefEmployeeRole::className(), ['employee_role' => 'employee_role']);
    }

    /**
     * @inheritdoc
     * @return EmployeeRoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EmployeeRoleQuery(get_called_class());
    }
}
