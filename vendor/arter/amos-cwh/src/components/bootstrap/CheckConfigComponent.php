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


namespace arter\amos\cwh\components\bootstrap;

use arter\amos\cwh\models\CwhConfig;
use arter\amos\cwh\models\CwhConfigContents;
use yii\base\ActionEvent;
use \Yii;

/**
 * Class CheckConfigComponent
 *
 * @package arter\amos\cwh\components\bootstrap
 */
class CheckConfigComponent extends \yii\base\Component
{
    public function checkConf(ActionEvent $event)
    {
        if (!(Yii::$app instanceof Yii\console\Application))
        {
            $actionId = $event->action->uniqueId;
            $controllerId = $event->action->controller->uniqueId;
            $configsNetwork = CwhConfig::getConfigs();
            $configsContents = CwhConfigContents::getConfigs();

            if (!count($configsNetwork) || !count($configsContents)) {
                if ($controllerId != 'cwh/configuration' && $actionId != \Yii::$app->getUser()->loginUrl[0]) {
                    return \Yii::$app->getResponse()->redirect('/cwh/configuration/wizard');
                }
            }
        }
    }

}