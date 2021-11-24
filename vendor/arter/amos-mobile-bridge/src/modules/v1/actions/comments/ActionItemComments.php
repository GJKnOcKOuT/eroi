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

use arter\amos\admin\models\UserProfile;
use arter\amos\comments\models\Comment;
use arter\amos\comments\models\CommentInterface;
use arter\amos\community\models\Community;
use arter\amos\core\record\Record;
use arter\amos\mobile\bridge\modules\v1\controllers\CommentsController;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use arter\amos\mobile\bridge\modules\v1\models\User;
use yii\base\Exception;
use yii\helpers\Json;
use yii\rest\Action;

class ActionItemComments extends Action
{
    public function run()
    {
        //Request params
        $bodyParams = \Yii::$app->getRequest()->getBodyParams();

        //Refference namespace
        $namespace = $bodyParams['namespace'];

        //Current Page
        $page = isset($bodyParams['page']) ? $bodyParams['page'] : 0;

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
        if ($record instanceof CommentInterface && \Yii::$app->user->can($canComment)) {
            //If the content is commentable
            if (!$record->isCommentable()) {
                return ['commentable' => false];
            }

            //Query all comments
            $q = Comment::find();
            $q->where([
                'context' => $namespace,
                'context_id' => $record->id,
            ]);
            $q->orderBy('created_at DESC');
            $q->limit(10);
            $q->offset($page * 10);

            //List of comments uset to fill array
            $comments = $q->all();

            //Result array to return
            $commentsArray = [];

            foreach ($comments as $comment) {
                //List of replies for this comment
                $repliesArray = [];

                $replies = $comment->commentReplies;

                foreach ($replies as $reply) {
                    //Creator profile
                    $rep_owner = UserProfile::findOne(['id' => $reply->created_by]);

                    $repliesArray[] = [
                        'id' => $reply->id,
                        'comment_text' => strip_tags($reply->comment_reply_text),
                        'created_at' => $reply->created_at,
                        'owner' => [
                            'nome' => $owner->nome,
                            'cognome' => $owner->cognome,
                            'presentazione_breve' => $rep_owner->presentazione_breve,
                            'avatarUrl' => $owner->avatarWebUrl,
                        ],
                    ];
                }

                //Creator profile
                $owner = UserProfile::findOne(['id' => $comment->created_by]);

                $commentsArray[] = [
                    'id' => $comment->id,
                    'comment_text' => html_entity_decode(strip_tags($comment->comment_text)),
                    'created_at' => $comment->created_at,
                    'replies' => $repliesArray,
                    'owner' => [
                        'nome' => $owner->nome,
                        'cognome' => $owner->cognome,
                        'presentazione_breve' => $owner->presentazione_breve,
                        'avatarUrl' => $owner->avatarWebUrl,
                    ],
                ];
            }


            return [
                'commentable' => true,
                'comments' => $commentsArray
            ];
        }

        return ['commentable' => false];
    }
}