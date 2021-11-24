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

/**
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2014 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\db\behaviors;

use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\db\Exception;


/**
 * Class CouchDocument
 * @package common\models
 * @author Tobias Munk <tobias@diemeisterei.de>
 */
class HydratedAttributes extends Behavior
{
    /**
     * @var column to use for array keys; has to be unique
     */
    public $keyAttribute;

    private $_m;
    private $_d;

    public function getHydratedAttributes()
    {
        $attributes = $this->owner->attributes;
        $this->parseAttributesRecursive($this->owner, $attributes);
        return $attributes;
    }

    /**
     * @param $model The model which attributes should be parsed recursively
     * @param $attributes Variable which holds the attributes
     */
    private function parseAttributesRecursive($model, &$attributes)
    {
        foreach ($model->relatedRecords AS $name => $relation) {
            if (is_array($relation)) {
                // many_many relation
                $attributes[$name] = [];
                foreach ($relation AS $rModel) {
                    $d = $rModel->attributes;
                    $this->parseAttributesRecursive($rModel, $d);
                    // create index from column (Note: column has to be unique)
                    if ($rModel->getBehavior('hydratedAttributes') && $rModel->keyAttribute) {
                        if (isset($attributes[$name][$d[$rModel->keyAttribute]])) {
                            throw new Exception("Index '{$d[$rModel->keyAttribute]}' not unique");
                        } else {
                            $attributes[$name][$d[$rModel->keyAttribute]] = $d;
                        }
                    } else {
                        $attributes[$name][] = $d;
                    }
                }
            } else {
                if ($relation instanceof ActiveRecord) {
                    // non-multiple
                    $attributes[$name] = $relation->attributes;
                } else {
                    $attributes[$name] = null;
                }
            }
        }
    }
} 