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

use Yii;

/**
 * Class SleepingUserMailBuilder
 * @package arter\amos\notificationmanager\base\builder
 */
class ContactAcceptedMailBuilder extends ContentMailBuilder
{
    //protected $results;
    protected $section;
    protected $section_title;

    /**
     * @return string
     */
    public function getSubject(array $resultset)
    {
        return Yii::t('amosnotify', "#Contact_accepted_Subject");
    }

    
    /**
     * @param $resultSetNormal
     * @param $user
     * @return string
     */
    protected function renderEmailUserNotify($resultSetNormal, $user){
        $mail = '';
        //$this->results = $resultSetNormal;
//        try {
            if (isset($resultSetNormal['created_by']) && count($resultSetNormal['created_by'])) {
                // ------------ NOTIFICATION SECTION CREATED BY  -------------
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#Contact_accepted_Created_by_title"), Yii::t('amosnotify', "#Contact_accepted_Created_by_desc"));        

                $mail .= $this->renderSectionWithClasses($resultSetNormal['created_by'], $user);
            }
            
            if (isset($resultSetNormal['commented_by']) && count($resultSetNormal['commented_by'])) {
                // ------------ NOTIFICATION SECTION CREATED BY  -------------
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#Contact_accepted_Commented_by_title"), Yii::t('amosnotify', "#Contact_accepted_Commented_by_desc"));        

                $mail .= $this->renderSectionWithClasses($resultSetNormal['commented_by'], $user);
            }
            
            if (isset($resultSetNormal['liked_by']) && count($resultSetNormal['liked_by'])) {
                // ------------ NOTIFICATION SECTION CREATED BY  -------------
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#Contact_accepted_Liked_by_title"), Yii::t('amosnotify', "#Contact_accepted_Liked_by_desc"));        

                $mail .= $this->renderSectionWithClasses($resultSetNormal['liked_by'], $user);
            }
            
            if (isset($resultSetNormal['connected_to']) && count($resultSetNormal['connected_to'])) {
                // ------------ NOTIFICATION SECTION CREATED BY  -------------
                $mail .= $this->renderSectionTitle(Yii::t('amosnotify', "#Contact_accepted_Connected_to_title"), Yii::t('amosnotify', "#Contact_accepted_Connected_to_desc"));        

                $mail .= $this->renderSectionWithClasses($resultSetNormal['connected_to'], $user);
            }
            

//        } catch (\Exception $ex) {
//            Yii::getLogger()->log($ex->getTraceAsString(), \yii\log\Logger::LEVEL_ERROR);
//        }

        return $mail;
    }

}