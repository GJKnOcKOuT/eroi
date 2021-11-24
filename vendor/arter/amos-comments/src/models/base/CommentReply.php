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
 * @package    arter\amos\comments\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\models\base;

use arter\amos\comments\AmosComments;
use arter\amos\notificationmanager\record\NotifyRecord;
use yii\helpers\ArrayHelper;

/**
 * Class CommentReply
 * This is the base-model class for table "comment_reply".
 *
 * @property integer $id
 * @property string $comment_reply_text
 * @property integer $comment_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\comments\models\Comment $comment
 *
 * @package arter\amos\comments\models\base
 */
class CommentReply extends NotifyRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_reply';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['comment_reply_text', 'comment_id'], 'required'],
            [['comment_reply_text'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['comment_id', 'created_by', 'updated_by', 'deleted_by'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosComments::t('amoscomments', 'ID'),
            'comment_reply_text' => AmosComments::t('amoscomments', 'Comment Reply Text'),
            'comment_id' => AmosComments::t('amoscomments', 'Comment ID'),
            'created_at' => AmosComments::t('amoscomments', 'Created At'),
            'updated_at' => AmosComments::t('amoscomments', 'Updated At'),
            'deleted_at' => AmosComments::t('amoscomments', 'Deleted At'),
            'created_by' => AmosComments::t('amoscomments', 'Created By'),
            'updated_by' => AmosComments::t('amoscomments', 'Updated By'),
            'deleted_by' => AmosComments::t('amoscomments', 'Deleted By')
        ]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(\arter\amos\comments\models\Comment::className(), ['id' => 'comment_id']);
    }
}
