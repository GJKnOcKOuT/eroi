<?php

namespace backend\modules\supercraft\models;

/**
 * This is the ActiveQuery class for [[AttivitaReale]].
 *
 * @see AttivitaReale
 */
class AttivitaRealeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return AttivitaReale[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return AttivitaReale|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
