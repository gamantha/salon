<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\common\models\UserRole]].
 *
 * @see \common\models\UserRole
 */
class UserRoleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\UserRole[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\UserRole|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
