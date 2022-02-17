<?php

namespace backend\modules\supercraft\models;

/**
 * This is the ActiveQuery class for [[ModuloEroi]].
 *
 * @see ModuloEroi
 */
class ModuloEroiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ModuloEroi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ModuloEroi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
