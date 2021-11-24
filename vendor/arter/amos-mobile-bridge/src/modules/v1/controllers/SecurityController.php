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
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
namespace arter\amos\mobile\bridge\modules\v1\controllers;

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\ForgotPasswordForm;
use arter\amos\admin\models\LoginForm;
use arter\amos\admin\models\UserProfile;
use arter\amos\admin\utility\UserProfileUtility;
use arter\amos\mobile\bridge\modules\v1\actions\security\ActionLogin;
use arter\amos\mobile\bridge\modules\v1\actions\security\ActionLogout;
use arter\amos\mobile\bridge\modules\v1\actions\security\ActionVerifyAuth;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use Exception;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\swiftmailer\Logger;

class SecurityController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviours = parent::behaviors();
        unset($behaviours['authenticator']);

        return ArrayHelper::merge($behaviours, [
                'authenticator' => [
                    'class' => CompositeAuth::className(),
                    'optional' => [
                        'login',
                        'verify-auth',
                        'forgot-password'
                    ],
                    'authMethods' => [
                        'bearerAuth' => [
                            'class' => HttpBearerAuth::className(),
                        ]
                    ],
                ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [
            'login' => ['post'],
            'logout' => ['post'],
            'verify-auth' => ['post'],
            'forgot-password' => ['post']
        ];
    }

    public function actions()
    {
        return [
            'login' => [
                'class' => ActionLogin::className(),
                'modelClass' => LoginForm::className(),
            ],
            'logout' => [
                'class' => ActionLogout::className(),
                'modelClass' => AccessTokens::className(),
            ],
            'verify-auth' => [
                'class' => ActionVerifyAuth::className(),
                'modelClass' => AccessTokens::className(),
            ],
        ];
    }

    /**
     * 
     * @return type
     */
    public function actionForgotPassword()
    {
        $ret = [];
        try {
            //Request params
            $bodyParams = Yii::$app->getRequest()->getBodyParams();

            $model = new ForgotPasswordForm();
            $model->email = $bodyParams['email'];
            if ($model->validate()) {
                if ($model->email != NULL) {
                    $dati_utente = $model->verifyEmail($model->email);
                    if ($dati_utente) {

                        $ret = $this->spedisciCredenziali($dati_utente->userProfile->id);
                    }
                }
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $ret;
    }

    /**
     * 
     * @param type $id
     * @param type $isForgotPasswordView
     * @param type $isForgotPasswordRequest
     * @param type $urlCurrent
     * @return type
     */
    public function spedisciCredenziali($id)
    {
        $ret = [];
        try {
            $model = UserProfile::findOne($id);
            if ($model && $model->user && $model->user->email) {
                $model->user->generatePasswordResetToken();
                $model->user->save(false);
                $sent = UserProfileUtility::sendCredentialsMail($model);

                if ($sent) {

                    $ret = [
                        msg => AmosAdmin::t('amosadmin', 'Credenziali spedite correttamente alla email {email}',
                            ['email' => $model->user->email])];
                } else {

                    $ret = [
                        msg =>
                        AmosAdmin::t('amosadmin', 'Si è verificato un errore durante la spedizione delle credenziali')];
                }
            } else {

                $ret = [
                    msg => AmosAdmin::t('amosadmin', 'Si è verificato un errore durante la spedizione delle credenziali')];
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $ret;
    }
}
