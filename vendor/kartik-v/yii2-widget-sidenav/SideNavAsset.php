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
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2021
 * @package yii2-widgets
 * @subpackage yii2-widget-sidenav
 * @version 1.0.1
 */

namespace kartik\sidenav;

/**
 * Asset bundle for SideNav Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class SideNavAsset extends \kartik\base\AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/sidenav']);
        $this->setupAssets('js', ['js/sidenav']);
        parent::init();
    }
}
