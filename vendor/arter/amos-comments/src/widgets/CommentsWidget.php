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
 * @package    arter\amos\comments\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\widgets;

use arter\amos\comments\models\CommentDisabledNotificationUsers;
use arter\amos\comments\AmosComments;
use arter\amos\comments\models\Comment;
use yii\base\Widget;
use yii\data\Pagination;

/**
 * Class CommentsWidget
 *
 * Widget to show the comments for a content.
 *
 * @package arter\amos\comments\widgets
 */
class CommentsWidget extends Widget
{
    public $layout = '<div id="comments-container">{commentSection}{commentsSection}</div>';

    /**
     * @var \arter\amos\core\record\Record $model
     */
    public $model;
    public $namespaceAssetBootstrapitalia = 'amos\planner\assets\BootstrapItaliaAsset';
    public $noAttach                      = 0;

    /**
     * @var array $options Options array for the widget (ie. html options)
     */
    public $options = [];

    /**
     * @see \kartik\base\Widget::init();
     *
     * Set of the permissionSave
     */
    public function init()
    {
        $this->initDefaultOptions();

        $module = \Yii::$app->getModule('comments');
        if (!empty($module->layoutInverted) && $module->layoutInverted == true) {
            $this->layout = '<div id="comments-container">{commentsSection}{commentSection}</div>';
        }
        if (property_exists(get_class($this->model), 'bootstrapItalia') && $this->model->bootstrapItalia == true) {
            $this->layout = '{commentsSection}{commentSection}';
        }

        parent::init();
    }

    /**
     * Set default options values.
     */
    private function initDefaultOptions()
    {
        $this->options['commentPlaceholder']      = AmosComments::t('amoscomments', 'Write a comment').'...';
        $this->options['commentReplyPlaceholder'] = AmosComments::t('amoscomments', 'Write a reply').'...';
        $this->options['commentTitle']            = AmosComments::t('amoscomments', '#COMMENT_TITLE');
        $this->options['lastCommentsTitle']       = AmosComments::t('amoscomments', 'Last comments');
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/",
            function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $this->layout);

        return $content;
    }

    /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{summary}`, `{items}`.
     * @return string|boolean the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{commentSection}':
                $module = \Yii::$app->getModule('comments');
                if (!empty($module->enableCommentOnlyWithScope) && $module->enableCommentOnlyWithScope == true) {
                    $moduleCwh = \Yii::$app->getModule('cwh');
                    if (!is_null($moduleCwh)) {
                        $scope = $moduleCwh->getCwhScope();
                        if (!isset($scope['community'])) {
                            return null;
                        }
                    }
                }
                if ($this->model->hasMethod('getCloseCommentThread') && $this->model->getCloseCommentThread()) {
                    return null;
                }
                return $this->commentSection();
            case '{commentsSection}':
                return $this->commentsSection();
            default:
                return false;
        }
    }

    /**
     * Method that render the section of the comment container.
     * @return string
     */
    public function commentSection()
    {
        if (property_exists(get_class($this->model), 'bootstrapItalia') && $this->model->bootstrapItalia == true) {
            return $this->render('bootstrapitalia/comment', [
                    'widget' => $this
            ]);
        } else {
            return $this->render('comments-widget/comment', [
                    'widget' => $this
            ]);
        }
    }

    /**
     * Method that render the comments section where there are all the comments and comments replies.
     * @return string
     */
    public function commentsSection()
    {
        $module = \Yii::$app->getModule('comments');
        /** @var \yii\db\ActiveQuery $query */
        $query  = Comment::find()->andWhere(['context' => $this->model->className(), 'context_id' => $this->model->id])->orderBy([
            'created_at' => $module->orderDisplayComments]);

        /** @var \arter\amos\comments\models\Comment $lastComment */
        $lastComment = $query->one();

        if ($module->disablePagination == true) {
            $pages    = null;
            $comments = $query->all();
        } else {
            $pages    = new Pagination(['totalCount' => $query->count()]);
            $pages->setPageSize(5);
            $comments = $query->offset($pages->offset)->limit($pages->limit)->all();
        }
        if (property_exists(get_class($this->model), 'bootstrapItalia') && $this->model->bootstrapItalia == true) {
            return $this->render('bootstrapitalia/comments',
                    [
                    'widget' => $this,
                    'pages' => $pages,
                    'comments' => $comments,
                    'lastComment' => $lastComment,
                    'asset' => $this->namespaceAssetBootstrapitalia,
                    'no_attach' => $this->noAttach,
                    'isEnableCommentNotificationAuthUser' => $this->isEnableCommentNotificationAuthUser()
            ]);
        } else {
            return $this->render('comments-widget/comments',
                    [
                    'widget' => $this,
                    'pages' => $pages,
                    'comments' => $comments,
                    'lastComment' => $lastComment,
                    'isEnableCommentNotificationAuthUser' => $this->isEnableCommentNotificationAuthUser()
            ]);
        }
    }


    /**
     * Method to check if the authenticated current user is in comment_disabled_notification_users
     *
     * @return boolean
     */
    public function isEnableCommentNotificationAuthUser(){

        // check if user is in comment_disabled_notification_users
        $comment_disabled_notification_user = CommentDisabledNotificationUsers::find()
                                                ->andWhere(['user_id' => \Yii::$app->user->id])
                                                ->andWhere(['deleted_at' => null])
                                                ->one();

        return (null != $comment_disabled_notification_user) ? false : true;
    }
}