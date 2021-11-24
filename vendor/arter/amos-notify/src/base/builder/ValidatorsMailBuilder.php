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

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\core\interfaces\ModelLabelsInterface;
use arter\amos\core\user\User;
use arter\amos\notificationmanager\AmosNotify;

use Yii;

/**
 * Class ValidatorsMailBuilder
 * @package arter\amos\notificationmanager\base\builder
 */
class ValidatorsMailBuilder extends AMailBuilder
{
    /**
     * @inheritdoc
     */
    public function getSubject(array $resultset)
    {
        $stdMsg = AmosNotify::t('amosnotify', '#validation_request_email_subject');
        $model = reset($resultset);
        if ($model instanceof ModelLabelsInterface) {
            $grammar = $model->getGrammar();
            if (!is_null($grammar) && ($grammar instanceof ModelGrammarInterface)) {
                $stdMsg = AmosNotify::t('amosnotify', '#publication_request_email_subject', ['contentName' => $grammar->getModelSingularLabel()]);
            }
        }
        return $stdMsg;
    }

    /**
     * @inheritdoc
     */
    public function renderEmail(array $resultset, User $user)
    {
        $ris = "";
        $model = reset($resultset);
        $moduleMyActivities = Yii::$app->getModule('myactivities');
        $moduleNotify = Yii::$app->getModule('notify');
        $url = isset($moduleMyActivities) ? Yii::$app->urlManager->createAbsoluteUrl('myactivities/my-activities/index') : $model->getFullViewUrl();

        try {
            $viewValidatorPath = "@vendor/arter/amos-" . AmosNotify::getModuleName() . "/src/views/email/validator";
            if($moduleNotify && !empty($moduleNotify->viewPathEmailNotifyValidator) && !empty($moduleNotify->viewPathEmailNotifyValidator[get_class($model)])){
                $viewValidatorPath = $moduleNotify->viewPathEmailNotifyValidator[get_class($model)];
            }

            $controller = Yii::$app->controller;
            $view = $controller->renderPartial($viewValidatorPath, [
                'model' => $model,
                'url' => $url,
                'profile' => $user->userProfile
            ]);

            $ris = $this->renderView(\Yii::$app->controller->module->name, "validators_content_email", [
                'model' => $model,
                'url' => $url,
                'profile' => $user->userProfile,
                'original' => $view
            ]);
        } catch (\Exception $ex) {
            Yii::getLogger()->log($ex->getTraceAsString(), \yii\log\Logger::LEVEL_ERROR);
        }

        return $ris;
    }
}
