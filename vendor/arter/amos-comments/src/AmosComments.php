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
 * @package    arter\amos\comments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments;

use arter\amos\comments\components\CommentComponent;
use arter\amos\comments\models\Comment;
use arter\amos\comments\models\CommentReply;
use arter\amos\core\components\AmosView;
use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use yii\base\BootstrapInterface;
use yii\base\Event;

/**
 * Class AmosComments
 * @package arter\amos\comments
 */
class AmosComments extends AmosModule implements ModuleInterface, BootstrapInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'arter\amos\comments\controllers';
    public $newFileMode         = 0666;
    public $name                = 'Comments';
    public $layoutInverted      = false;

    /**
     * @var array $modelsEnabled
     */
    public $modelsEnabled           = [];
    public $maxCommentAttachments   = 5;
    public $enableMailsNotification = true;

    /**
     * @var bool $enableUserSendMailCheckbox If true enable the checkbox in the comments forms with the user can select if send or not the notify mail.
     */
    public $enableUserSendMailCheckbox = true;

    /**
     * This is the html used to render the subject of the e-mail. In the view is available the variable $profile
     * that is an instance of 'arter\amos\admin\models\UserProfile'
     * @var string
     */
    public $htmlMailContentSubject = '@vendor/arter/amos-comments/src/views/comment/email/content_subject';
    //    public $htmlMailContentTitle = [
//        'arter\amos\news\models\News' => '@vendor/arter/amos-comments/src/views/comment/email/content_subject_news',
//        'arter\amos\discussioni\models\DiscussioniTopic' => '@vendor/arter/amos-comments/src/views/comment/email/content_subject_discussioni',
//        'arter\amos\documenti\models\Documenti' => '@vendor/arter/amos-comments/src/views/comment/email/content_subjcet_documenti'
//    ];

    public $htmlMailContentSubjectDefault = '@vendor/arter/amos-comments/src/views/comment/email/content_subject';

    /**
     * This is the html used to render the subject of the e-mail. In the view is available the variable $profile
     * that is an instance of 'arter\amos\admin\models\UserProfile'
     * @var string
     */
    public $htmlMailContentTitle = '@vendor/arter/amos-comments/src/views/comment/email/content_title';
    //    public $htmlMailContentTitle = [
//        'arter\amos\news\models\News' => '@vendor/arter/amos-comments/src/views/comment/email/content_title_news',
//        'arter\amos\discussioni\models\DiscussioniTopic' => '@vendor/arter/amos-comments/src/views/comment/email/content_title_discussioni',
//        'arter\amos\documenti\models\Documenti' => '@vendor/arter/amos-comments/src/views/comment/email/content_title_documenti'
//    ];

    /*
     * 
     */
    public $htmlMailContentTitleDefault = '@vendor/arter/amos-comments/src/views/comment/email/content_title';

    /**
     * This is the html used to render the message of the e-mail. In the view is available the variable $profile
     * that is an instance of 'arter\amos\admin\models\UserProfile'
     * @var string|array
     */
    public $htmlMailContent = '@vendor/arter/amos-comments/src/views/comment/email/content';
//    public $htmlMailContent = [
//        'arter\amos\news\models\News' => '@vendor/arter/amos-comments/src/views/comment/email/content_news',
//        'arter\amos\discussioni\models\DiscussioniTopic' => '@vendor/arter/amos-comments/src/views/comment/email/content_discussioni',
//        'arter\amos\documenti\models\Documenti' => '@vendor/arter/amos-comments/src/views/comment/email/content_documenti'
//    ];

    /*
     * 
     */
    public $htmlMailContentDefault = '@vendor/arter/amos-comments/src/views/comment/email/content';
    /**
     * Sets if the notify checkbox must be visible into the comments accordion
     * @var bool
     */
    public $displayNotifyCheckbox = true;

    /**
     * Sets if the comments accordion must be opened by default
     * @var bool
     */
    public $accordionOpenedByDefault = true;

    /**
     * If true it enable the comments olny with the scope (in the community)
     * @var boolean $enableCommentOnlyWithScope
     */
    public $enableCommentOnlyWithScope = false;
    public $disableAutoDisplay         = ['amos\planner\models\PlanWork'];

    /**
     * If a true notify the context model (DiscussioniTopic) if is created a comment
     * @var bool $enableNotifyCommentForDiscussions
     */
    public $enableNotifyCommentForDiscussions = true;

    /**
     *
     * @var type 3 by SORT_DESC, 4 by SORT_ASC
     */
    public $orderDisplayComments = 3;

    /**
     *
     * @var type
     */
    public $disablePagination = false;

    /**
     * @return string
     */
    public static function getModuleName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@arter/amos/'.static::getModuleName().'/controllers', __DIR__.'/controllers/');
        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php'));
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return NULL;
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        Event::on(AmosView::className(), AmosView::AFTER_RENDER_CONTENT, [new CommentComponent(), 'showComments']);
    }

    /**
     * @param $model
     */
    public function countComments($model)
    {
        $query = Comment::find()
            ->joinWith('commentReplies', true, 'LEFT JOIN')
            ->andWhere(['context' => $model->className(), 'context_id' => $model->id])
            ->groupBy('comment.id');

        /** @var \arter\amos\comments\models\Comment $lastComment */
        $countComment = $query->count();
        $query        = Comment::find()
            ->joinWith('commentReplies', true, 'LEFT JOIN')
            ->andWhere(['context' => $model->className(), 'context_id' => $model->id])
            ->andWhere(['is not', CommentReply::tableName().'.id', null]);
        $countComment += $query->count();
        return $countComment;
    }
}