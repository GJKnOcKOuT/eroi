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


namespace arter\amos\audit;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Bootstrap
 * @package arter\amos\audit
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        // Make sure to register the base folder as alias as well or things like assets won't work anymore
        \Yii::setAlias('@arter/amos/audit', __DIR__);

        if ($app instanceof \yii\console\Application) {
            $app->controllerMap['audit'] = 'arter\amos\audit\commands\AuditController';
        }
        
        $moduleName = Audit::findModuleIdentifier();
        
        if ($moduleName) {
            // The module was added in the configuration, make sure to add it to the application bootstrap so it gets loaded
            $app->bootstrap[] = $moduleName;
            $app->bootstrap = array_unique($app->bootstrap, SORT_REGULAR);
        }
        
        if ($app->has('i18n')) {
            $app->i18n->translations['audit'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath'       => '@arter/amos/audit/messages',
            ];
        }
        
    }
}
