<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\components;

use arter\amos\admin\models\UserProfile;
use yii\base\BootstrapInterface;
use yii\web\Application;
use Yii;

/**
 * Class LoginRequestInfoWizard
 */
class LoginRequestInfoWizard implements BootstrapInterface {

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param Application $app the application currently running
     */
    public function bootstrap($app) {
        Yii::$app->on(Application::EVENT_BEFORE_ACTION, [$this, 'startInfoRequest']);
    }

    /**
     * 
     */
    public function startInfoRequest() {

        /** @var \arter\amos\core\user\User $loggedUser */
        $loggedUser = Yii::$app->getUser()->identity;
        if (!empty($loggedUser)) {
            /** @var \arter\amos\admin\models\UserProfile $loggedUserProfile */
            $loggedUserProfile = $loggedUser->getProfile();
            // control for infinite loop of redirect!
            if (Yii::$app->controller->action->id != 'required-informations') {

                if ($this->stopWithRequest($loggedUserProfile)) {
                    $destinationUrl = Yii::$app->request->url;
                    Yii::$app->controller->redirect(([
                        '/login-info-request/required-informations',
                        'id' => $loggedUserProfile->id,
                        'url' => $destinationUrl,
                    ]));
                    Yii::$app->response->send();
                }
            }
        }
    }

    /**
     * @param $userProfile UserProfile
     * @return bool
     */
    private function stopWithRequest($userProfile) {
        if (!$userProfile->privacy ) {
            return true;
        }
        return false;
    }

}
