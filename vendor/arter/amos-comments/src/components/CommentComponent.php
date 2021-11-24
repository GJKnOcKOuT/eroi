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
 * @package    arter\amos\comments\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\components;

use arter\amos\comments\AmosComments;
use arter\amos\comments\models\CommentInterface;
use arter\amos\comments\widgets\CommentsWidget;
use Yii;
use yii\base\Component;
use yii\base\Event;

/**
 * Class CommentComponent
 * @package arter\amos\events\components
 */
class CommentComponent extends Component implements CommentComponentInterface
{

    /**
     * Method that enable the comments on a specific model.
     * @param \yii\base\Event $event
     */
    public function showComments(Event $event)
    {
        if (isset(Yii::$app->controller->model)) {
            /** @var \arter\amos\core\record\Record $controllerModel */
            $controllerModel = Yii::$app->controller->model;           
            if ($this->checkDisableAutoDisplay($controllerModel) && $this->checkCommentsModuleEnabled($controllerModel) && $this->checkCommentsEnabledOnModel($controllerModel)) {
                echo CommentsWidget::widget([
                    'model' => Yii::$app->controller->model
                ]);
            }
        }
    }

    /**
     * The method checks if the comment module is present and the actual controller
     * model class name is present in the comments module configurations.
     * @param \arter\amos\core\record\Record $controllerModel
     * @return bool
     */
    protected function checkCommentsModuleEnabled($controllerModel)
    {
        /** @var AmosComments $commentsModule */
        $commentsModule = Yii::$app->getModule(AmosComments::getModuleName());
        return (
            !is_null($commentsModule) &&
            isset($commentsModule->modelsEnabled) &&
            in_array($controllerModel::className(), $commentsModule->modelsEnabled)
            );
    }

    /**
     * Method that checks if the controller model is an instance of CommentInterface
     * and then if the model is commentable.
     * @param \arter\amos\core\record\Record $controllerModel
     * @return bool
     */
    protected function checkCommentsEnabledOnModel($controllerModel)
    {
        if ($controllerModel instanceof CommentInterface) {
            /** @var CommentInterface $controllerModel */
            return $controllerModel->isCommentable();
        }
        return false;
    }

    protected function checkDisableAutoDisplay($controllerModel)
    {
        $module = \Yii::$app->getModule('comments');       
        if (!in_array(get_class($controllerModel), $module->disableAutoDisplay)) {
            return true;
        }
        return false;
    }
}