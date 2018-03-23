<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\common\models\Sales]].
 *
 * @see \common\models\Sales
 */
class SalesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Sales[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Sales|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
