<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_partnership_profiles\assets;

use yii\web\AssetBundle;

/**
 * Class PartnershipProfilesAsset
 * @package aster\amos\partnershipprofiles\assets
 */
class PartnershipProfilesAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@backend/modules/aster_partnership_profiles/assets/web/';
    
    /**
     * @inheritdoc
     */
    public $js = [
        'js/aster-partnership-profiles.js',
    ];
    
    /**
     * @inheritdoc
     */
    public $css = [
        'less/aster-partnership-profiles.less',
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];
}
