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
 * @package    arter\amos\comments\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\rules;

use arter\amos\comments\models\Comment;
use arter\amos\comments\models\CommentReply;
use arter\amos\core\rules\DefaultOwnContentRule;

/**
 * Class UpdateOwnContentCommentsRule
 * @package arter\amos\comments\rules
 */
class UpdateOwnContentCommentsRule extends DefaultOwnContentRule
{
    public $name = 'updateOwnContentComments';
    
    /**
     * @inheritdoc
     */
    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var \arter\amos\core\record\Record $model */
            $model = $params['model'];
            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }
            
            if ($model instanceof CommentReply) {
                if($model->isNewRecord){
                    return true;
                }else {
                    /** @var Comment $comment */
                    $comment = $model->comment;
                    /** @var \arter\amos\core\record\Record $contextModelClassName */
                    $contextModelClassName = $comment->context;
                    /** @var \arter\amos\core\record\Record $contextModel */
                    $contextModel = $contextModelClassName::findOne($comment->context_id);
                    return ($contextModel->created_by == $user);
                }
            } elseif ($model instanceof Comment) {
                if($model->isNewRecord){
                    return true;
                }else {
                    /** @var Comment $model */
                    /** @var \arter\amos\core\record\Record $contextModelClassName */
                    $contextModelClassName = $model->context;
                    /** @var \arter\amos\core\record\Record $contextModel */
                    $contextModel = $contextModelClassName::findOne($model->context_id);
                    return ($contextModel->created_by == $user);
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
