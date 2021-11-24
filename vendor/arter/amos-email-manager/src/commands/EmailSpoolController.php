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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager\commands;

use Exception;
use Yii;
use yii\console\Controller;
use yii\log\Logger;

class EmailSpoolController extends Controller
{

    /**
     * Sends emails
     */
    public function actionIndex($spoolLimit = 10)
    {
        try {
            $emailManager = Yii::$app->getModule('email');
            if ($emailManager) {
                $emailManager->spool($spoolLimit);
            }
        } catch (Exception $bex) {
            Yii::getLogger()->log($bex->getMessage(), Logger::LEVEL_ERROR);
        }
    }

    /**
     * Sends emails in a continuous loop
     */
    public function actionLoop($loopLimit = 1000, $spoolLimit = 10)
    {
        try {
            $emailManager = Yii::$app->getModule('email');
            if ($emailManager) {
                for ($i = 0; $i < $loopLimit; $i++) {
                    $done = $emailManager->spool($spoolLimit);
                    if ($done) {
                        for ($i = 0; $i < $done; $i++) {
                            echo '.';
                        }
                    } else {
                        break;
                    }
                }
            }
        } catch (Exception $bex) {
            Yii::getLogger()->log($bex->getMessage(), Logger::LEVEL_ERROR);
        }
    }

}
