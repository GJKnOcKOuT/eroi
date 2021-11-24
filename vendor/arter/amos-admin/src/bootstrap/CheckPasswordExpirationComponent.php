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
 * @package    arter\amos\admin\bootstrap
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\bootstrap;

use yii\base\Application;
use yii\base\BootstrapInterface;

/**
 * Description of CheckPasswordExpirationComponent
 *
 */
class CheckPasswordExpirationComponent implements BootstrapInterface{
    
    /**
     * 
     * @param type $app
     */
    public function bootstrap($app)
    {
        \Yii::$app->on(Application::EVENT_BEFORE_ACTION, [$this, 'onApplicationAction']);
    }

    /**
     * 
     * @param type $event
     */
    public function onApplicationAction($event) {
        $actionId = $event->action->uniqueId;


        $User = \arter\amos\core\utilities\CurrentUser::getUser();
        if (!$User->isGuest) {
            $UserId = $User->getIdentity()->getId();
            $ruoli = \Yii::$app->authManager->getRolesByUser($UserId);
            $verifica = (!(isset($ruoli['ADMIN'])) && (isset(\Yii::$app->params['active-expiration-password']) && \Yii::$app->params['active-expiration-password'] == true)) ? true : false;

            if($verifica){
                $dataScadenza = date('Y-m-d', strtotime((isset(\Yii::$app->params['days-expiration-password'])) ? '+' . \Yii::$app->params['days-expiration-password'] . ' days' : '+90 days', strtotime(date('Y-m-d', strtotime($User->getIdentity()->updated_at)))));
                $dataOdierna = date('Y-m-d');
                $profileId = \Yii::$app->user->identity->profile->id;
                if ($dataScadenza <= $dataOdierna && $actionId != 'admin/user-profile/password-expired' && $actionId != 'site/accettazione-privacy' && $actionId != 'admin/user-profile/cambia-password' && $actionId != 'site/inserisci-dati-autenticazione') {
                    \Yii::$app->controller->redirect('admin/user-profile/password-expired?id=' . $profileId);
                }
            }
        }
    }
}
