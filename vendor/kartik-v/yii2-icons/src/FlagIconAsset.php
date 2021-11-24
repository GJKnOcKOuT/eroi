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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @package yii2-icons
 * @version 1.4.7
 */

namespace kartik\icons;
use kartik\base\BaseAssetBundle;

/**
 * Asset bundle for FlagIcon icon set. Uses client assets (CSS, images, and fonts) from flag icons repository.
 * 
 * @see http://lipis.github.io/flag-icon-css/
 *
 * @author Davidson Alencar <davidson.t.i@gmail.com>
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.4
 */
class FlagIconAsset extends BaseAssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/components/flag-icon-css';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setupAssets('css', ['css/flag-icon']);
        parent::init();
    }
}