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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\translation\assets;

use yii\web\AssetBundle;

/**
 * Class AmosChatAsset
 * @package arter\amos\chat\assets
 */
class AmosTranslationAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@vendor/arter/amos-translation/src/assets/web';

    /**
     * @var array
     */
    public $css = [
        'css/style.css',
    ];

    /**
     * @var array
     */
    public $js = [];

    /**
     * @var array
     */
    public $depends = [
        'arter\amos\core\views\assets\AmosCoreAsset',
    ];
}