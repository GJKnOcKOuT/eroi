<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\basic\template
 * @category   CategoryName
 */

namespace common\models;

/**
 * This is the ActiveQuery class for [[ItaliaRegioni]].
 *
 * @see ItaliaRegioni
 */
class ItaliaRegioniQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return ItaliaRegioni[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ItaliaRegioni|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}