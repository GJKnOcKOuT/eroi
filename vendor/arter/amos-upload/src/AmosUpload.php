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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\upload;

use pendalf89\filemanager\Module;

class AmosUpload extends Module
{
    public $controllerNamespace = 'arter\amos\upload\controllers';

    public function init()
    {
        parent::init(
        // initialize the module with the configuration loaded from config.php
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php')));
    }
}
