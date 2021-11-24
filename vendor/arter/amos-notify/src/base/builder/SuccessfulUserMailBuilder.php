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
 * @package    arter\amos\notificationmanager\base\builder
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\base\builder;

use arter\amos\notificationmanager\AmosNotify;
use Yii;

/**
 * Class SleepingUserMailBuilder
 * @package arter\amos\notificationmanager\base\builder
 */
class SuccessfulUserMailBuilder extends SuccessfulContentMailBuilder
{
    /**
     * @return string
     */
    public function getSubject(array $resultset)
    {
        return Yii::t('amosnotify', "#Successful_User_Subject");
    }
    
    /**
     * @param $resultSetNormal
     * @param $user
     * @return string
     */
    protected function renderEmailUserNotify($resultSetNormal, $user){
        $mail = '';
//        try {
            if (isset($resultSetNormal['view_profile']) && count($resultSetNormal['view_profile'])) {
                
                $frequencyMsg = AmosNotify::t('amosnotify', $this->getFrequencyMessage());
                $viewMsg =  AmosNotify::t('amosnotify', '#Visto da ##n## persone', [$resultSetNormal['view_profile_howmany']]);
                $howManyMsg =  AmosNotify::t('amosnotify', '#Profilo ##visto## ##frequenza##', [$viewMsg, $frequencyMsg]);
                
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#SuggestedLink_view_profile_quanti_title"), $howManyMsg);
                
                // ------------ HANNO VISTO IL SUO PROFILO  -------------
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#SuggestedLink_view_profile_title"), Yii::t('amosnotify', "#SuggestedLink_view_profile_desc"));        

                $mail .= $this->renderSectionWithClasses($resultSetNormal['view_profile'], $user);
            }
                        

//        } catch (\Exception $ex) {
//            Yii::getLogger()->log($ex->getTraceAsString(), \yii\log\Logger::LEVEL_ERROR);
//        }

        return $mail;
    }
        
}