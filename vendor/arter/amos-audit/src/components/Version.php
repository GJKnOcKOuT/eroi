<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\audit\components;

use arter\amos\audit\models\AuditTrail;
use yii\base\Component;
use yii\db\ActiveRecord;

/**
 * Version
 * @package arter\amos\audit
 */
class Version extends Component
{

    /**
     * Get all versions of the model.
     *
     * @param $class
     * @param $id
     * @return array
     */
    public static function versions($class, $id)
    {
        /** @var AuditTrail[] $trails */
        $trails = AuditTrail::find()
            ->andWhere(['model' => $class, 'model_id' => $id])
            ->orderBy(['entry_id' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
        $versions = [];
        foreach ($trails as $trail) {
            if ($trail->action == 'DELETE') {
                $versions[$trail->entry_id][$trail->action] = $trail->action;
            } else {
                $versions[$trail->entry_id][$trail->field] = $trail->new_value;
            }
        }
        return $versions;
    }

    /**
     * Get the last version of the model.
     *
     * @param $class
     * @param $id
     * @return mixed
     */
    public static function lastVersion($class, $id)
    {
        $versions = self::versions($class, $id);
        return key(array_slice($versions, -2, 1, true));
    }

    /**
     * Find a model from a version.
     *
     * @param $class
     * @param $id
     * @param $version
     * @return ActiveRecord
     */
    public static function find($class, $id, $version = null)
    {
        if (!$version) {
            $version = self::lastVersion($class, $id);
        }
        /** @var ActiveRecord $model */
        $model = call_user_func_array([$class, 'findOne'], [$id]);
        if (!$model) {
            // if it has been deleted, load a new one
            $model = new $class;
        }
        foreach ($model->attributes() as $attribute) {
            $model->setAttribute($attribute, self::findAttribute($class, $id, $attribute, $version));
        }
        return $model;
    }

    /**
     * Find an attribute from a version.
     *
     * @param $class
     * @param $id
     * @param $attribute
     * @param $version
     * @return null|integer|float|string
     */
    public static function findAttribute($class, $id, $attribute, $version)
    {
        /** @var AuditTrail $trail */
        $trail = AuditTrail::find()
            ->andWhere(['model' => $class, 'model_id' => $id, 'field' => $attribute])
            ->andWhere(['<=', 'entry_id', $version])
            ->orderBy(['id' => SORT_DESC])
            ->one();
        return $trail ? $trail->new_value : null;
    }

}