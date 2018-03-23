<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ref_role".
 *
 * @property string $role_name
 *
 * @property UserRole[] $userRoles
 */
class RefRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ref_role';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role_name'], 'required'],
            [['role_name'], 'string', 'max' => 255],
            [['role_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'role_name' => Yii::t('app', 'Role Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRoles()
    {
        return $this->hasMany(UserRole::className(), ['role_name' => 'role_name']);
    }

    /**
     * @inheritdoc
     * @return \app\models\RefRoleQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\RefRoleQuery(get_called_class());
    }
}
