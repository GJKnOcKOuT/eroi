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

namespace arter\amos\mobile\bridge\modules\v1\actions\comments;

use arter\amos\comments\models\CommentInterface;
use arter\amos\comments\models\CommentReply;
use Yii;
use yii\rest\Action;

class ActionItemPushCommentReply extends Action
{
    public function run()
    {
        //Request params
        $bodyParams = Yii::$app->getRequest()->getBodyParams();

        if(empty($bodyParams['comment_text'])) {
            return false;
        }
        
        if(empty($bodyParams['comment_id'])) {
            return false;
        }

        //Refference namespace
        $namespace = $bodyParams['namespace'];

        /**
         * Class for this fetch, expected Record
         * @var $class Record
         */
        $class = new $namespace();

        //Record interested
        if (!empty($bodyParams['id'])) {
            $record = $class::findOne(['id' => $bodyParams['id']]);
        } else {
            $record = new $class();
        }

        //Comments permission
        $canComment = 'COMMENTS_CONTRIBUTOR';

        //Commentable
        if ($record instanceof CommentInterface && Yii::$app->user->can($canComment)) {
            //If the content is commentable
            if (!$record->isCommentable()) {
                return ['commentable' => false];
            }

            //Store comment
            $comment = new CommentReply();
            $comment->comment_reply_text = strip_tags($bodyParams['comment_text']);
            $comment->comment_id = $bodyParams['comment_id'];
            $comment->save(false);

            return [
                'commentable' => true
            ];
        }

        return ['commentable' => false];
    }
}