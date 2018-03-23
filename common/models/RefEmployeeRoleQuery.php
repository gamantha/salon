<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[RefEmployeeRole]].
 *
 * @see RefEmployeeRole
 */
class RefEmployeeRoleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RefEmployeeRole[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RefEmployeeRole|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
