<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[\common\models\Work]].
 *
 * @see \common\models\Work
 */
class WorkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\Work[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\Work|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
