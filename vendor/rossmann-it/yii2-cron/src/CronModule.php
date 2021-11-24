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
 * @copyright Copyright (c) 2013-2016 Voodoo Mobile Consulting Group LLC
 * @link      https://voodoo.rocks
 * @license   http://opensource.org/licenses/MIT The MIT License (MIT)
 */
namespace rossmann\cron;

use yii\base\Exception;

/**
 * Class CronModule
 */
class CronModule extends \yii\base\Module
{
    const DIALECT_MYSQL = 'MySQL';
    const DIALECT_OCI8 = 'Oracle';

    /**
     * @var string
     */
    public $controllerNamespace = 'rossmann\cron\controllers';

    /**
     * Which SQL dialect should be used to generate date expressions
     * Oracle uses the TO_DATE function
     * @var string
     */
    public $sqlDialect = 'MySQL';

    /**
     * in which path to look for controller classes containing task actions
     * @var string|array
     */
    public $tasksControllersFolder = [];

    /**
     * the namespace of the controller classes found in $tasksControllersFolder
     * @var string|array
     */
    public $tasksNamespace = [];

    /**
     * @throws Exception
     */
    public function init()
    {
        parent::init();
        if (!isset(\Yii::$app->i18n->translations['cron'])) {
            \Yii::$app->i18n->translations['cron'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => __DIR__ . '/messages'
            ];
        }
    }
}
