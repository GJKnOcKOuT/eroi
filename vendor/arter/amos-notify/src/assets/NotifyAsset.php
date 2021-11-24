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
 * @package    arter\amos\notificationmanager\base\builder
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\assets;

use yii\web\AssetBundle;

/**
 * Class NotifyAsset
 * @package arter\amos\notificationmanager\assets
 */
class NotifyAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-notify/src/assets/web';

    /**
     * @inheritdoc
     */
    public $css = [
        'less/notify.less',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/notify.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if (!is_null($moduleL)) {
            $this->depends [] = 'arter\amos\layout\assets\BaseAsset';
        } else {
            $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }
}
