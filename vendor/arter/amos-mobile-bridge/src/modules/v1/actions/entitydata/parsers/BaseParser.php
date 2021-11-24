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

namespace arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers;

use arter\amos\core\models\ContentLikes;
use arter\amos\core\models\ModelsClassname;
use Yii;

class BaseParser
{

    /**
     * 
     * @param type $model
     */
    protected static function isLikeMe($model)
    {
        $likeme = false;

        $obj = $model;
        if ($obj) {
            $uid = Yii::$app->getUser()->id;
            $model_class_obj = ModelsClassname::find(['classname' => get_class($model)])->one();
            if (!is_null($model_class_obj)) {
                $likeme = ContentLikes::getLikeMe($uid, $model->id, $model_class_obj->id);
            }
        }
        return $likeme;
    }
    
    /**
     * 
     * @param type $model
     * @return type
     */
    protected static function getCountLike($model)
    {
        $countLike = 0;

        $obj = $model;
        if ($obj) {
            $uid = Yii::$app->getUser()->id;
            $model_class_obj = ModelsClassname::find(['classname' => get_class($model)])->one();
            if (!is_null($model_class_obj)) {
                $countLike = ContentLikes::getLikesToCounter(null, $model->id, $model_class_obj->id);
            }
        }
        return $countLike;
    }
}
