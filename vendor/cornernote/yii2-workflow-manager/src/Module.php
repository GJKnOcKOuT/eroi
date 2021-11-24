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


namespace cornernote\workflow\manager;

use Yii;

/**
 * Class Module
 * @package cornernote\workflow\manager
 */
class Module extends \yii\base\Module
{
    /**
     * @var string
     */
    public $controllerNamespace = 'cornernote\workflow\manager\controllers';
    /**
     * @var string
     */
    public $layout = 'main';
    
    public function init()
    {
        parent::init();
        if (!isset(Yii::$app->i18n->translations['workflow'])) {
            Yii::$app->i18n->translations['workflow'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath' => '@cornernote/workflow/manager/messages'
            ];
        }
    }
}
