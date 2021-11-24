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
class SleepingUserMailBuilder extends ContentMailBuilder
{
    /**
     * @return string
     */
    public function getSubject(array $resultset)
    {
        return Yii::t('amosnotify', "#Sleeping_User_Subject");
    }
    
    /**
     * @param $resultSetNormal
     * @param $user
     * @return string
     */
    public function renderSectionWithClasses($resultSetNormal, $user){

        $mail = '';
        
        $mail .= $this->renderSectionTitle('', Yii::t('amosnotify', "#Sleeping_User_Why_Mail")); 
        
        $mail .= parent::renderSectionWithClasses($resultSetNormal, $user);        
        
        return $mail;
        
    }    
}