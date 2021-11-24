<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_admin\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_admin\assets;

use yii\web\AssetBundle;

/**
 * Class AsterAdminAsset
 * @package arter\amos\admin\assets
 */
class AsterAdminAsset extends AssetBundle
{
    public $sourcePath = '@backend/modules/aster_admin/assets/web';

    public $css = [
        'less/aster-admin.less',
    ];
    
    public $js = [
        'js/aster-admin.js',
        'js/userprofile.js',
    ];
    public $depends = [
    ];

}
