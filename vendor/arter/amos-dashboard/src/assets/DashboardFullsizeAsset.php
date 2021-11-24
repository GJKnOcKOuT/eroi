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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\assets;

use yii\web\AssetBundle;

class DashboardFullsizeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/arter/amos-dashboard/src/assets/web';
    public $css        = [
        'less/dashboardFullsize.less'
    ];
    public $js         = [
        'js/dashboard_fullsize.js',
        'js/modal-dashboard.js'
    ];
    public $depends = [
    ];
}