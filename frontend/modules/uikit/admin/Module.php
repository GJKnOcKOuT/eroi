<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace  app\modules\uikit\admin;

use Yii;
use luya\base\CoreModuleInterface;


final class Module extends \luya\admin\base\Module implements CoreModuleInterface
{
    /**
     * @inheritdoc
     */
    public function getAdminAssets()
    {
        return  [
            'app\modules\uikit\assets\MainAsset',
        ];
    }
}
