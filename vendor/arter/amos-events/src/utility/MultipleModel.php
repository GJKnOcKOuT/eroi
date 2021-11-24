<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\events\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\utility;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * Class MultipleModel
 * @package arter\amos\events\utility
 */
class MultipleModel extends \yii\base\Model
{

    /**
     * Creates and populates a set of models.
     *
     * @param string $modelClass
     * @param array $multipleModels
     * @return array
     */
    public static function createMultiple($modelClass, $multipleModels = [], $forceSetAttributes = [])
    {
        $model    = new $modelClass;
        $formName = $model->formName();
        $post     = Yii::$app->request->post($formName);
        $models   = [];

        if (! empty($multipleModels)) {
            $keys = array_keys(ArrayHelper::map($multipleModels, 'id', 'id'));
            $multipleModels = array_combine($keys, $multipleModels);
        }

        if ($post && is_array($post)) {
            foreach ($post as $i => $item) {
                if (isset($item['id']) && !empty($item['id']) && isset($multipleModels[$item['id']])) {
                    $models[] = $multipleModels[$item['id']];
                } else {
                    $modelClass = new $modelClass;
                    foreach ($forceSetAttributes as $key => $value) {
                        $modelClass->$key = $value;
                    }
                    $models[] = $modelClass;
                }
            }
        }

        unset($model, $formName, $post);

        return $models;
    }

}
