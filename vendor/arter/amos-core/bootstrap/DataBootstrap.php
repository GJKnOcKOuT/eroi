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


namespace arter\amos\core\bootstrap;

use yii\base\BootstrapInterface;

class DataBootstrap implements BootstrapInterface {

    public function bootstrap($app) {
        \yii\validators\Validator::$builtInValidators['string'] = [
            'class' => 'arter\amos\core\validators\StringHtmlValidator',
        ];

        
    }

}
