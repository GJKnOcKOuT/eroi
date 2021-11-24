<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_community\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_community\assets;

use yii\web\AssetBundle;

/**
 * Class AsterCommunityAsset
 * @package aster\amos\community\assets
 */
class AsterCommunityAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@backend/modules/aster_community/assets/web/';

    /**
     * @inheritdoc
     */
    public $js = [
        'js/aster-community.js',
    ];

    /**
     * @inheritdoc
     */
    public $css = [
        'less/aster-community.less',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];
}
