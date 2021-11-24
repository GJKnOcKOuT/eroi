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
 */
namespace schmunk42\giiant\generators\crud\callbacks\yii;

class Image
{
    public static function attribute()
    {
        // render image tag
        return function ($attribute) {
            return <<<FORMAT
[
    'format' => 'html',
    'attribute' => '{$attribute}',
    'value'=> function(\$model){
        return yii\helpers\Html::img(\Yii::getAlias("@web") . "/" . \$model->{$attribute});
    }
]
FORMAT;
        };
    }
}
