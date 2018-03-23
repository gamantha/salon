<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_employee_role".
 *
 * @property string $employee_role
 *
 * @property EmployeeRole[] $employeeRoles
 */
class RefEmployeeRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_employee_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['employee_role'], 'required'],
            [['employee_role'], 'string', 'max' => 255],
            [['employee_role'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'employee_role' => Yii::t('app', 'Employee Role'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeeRoles()
    {
        return $this->hasMany(EmployeeRole::className(), ['employee_role' => 'employee_role']);
    }

    /**
     * @inheritdoc
     * @return RefEmployeeRoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RefEmployeeRoleQuery(get_called_class());
    }
}
