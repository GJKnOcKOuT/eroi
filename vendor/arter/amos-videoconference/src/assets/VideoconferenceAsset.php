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

namespace arter\amos\videoconference\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Class VideoconferenceAsset
 * @package arter\amos\videoconference\assets
 */
class VideoconferenceAsset extends AssetBundle {

    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-videoconference/src/assets/web';
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
        //"https://jitsi01.smart.it/libs/external_api.min.js",
        //'js/videoconference.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init() {
        $jitsiDomain = Yii::$app->getModule('videoconference')->jitsiDomain ?: null;
        
        $this->js = [
            "https://".$jitsiDomain."/libs/external_api.min.js",
            'js/videoconference.js'
        ];
        parent::init();
    }

}
