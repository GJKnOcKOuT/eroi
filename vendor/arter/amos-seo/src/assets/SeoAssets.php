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
 * @package    arter\amos\moodle\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo\assets;

use yii\web\AssetBundle;

/**
 * Class SeoAsset
 * @package arter\amos\seo\assets
 */
class SeoAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-seo/src/assets/web';
    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];

    /**
     * @inheritdoc
     */
    public $css = [
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        //'js/seo.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init() {        
        $this->js = [
            'js/seo.js'
        ];
        parent::init();
    }

}
