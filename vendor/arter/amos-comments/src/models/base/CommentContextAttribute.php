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
use yii\helpers\ArrayHelper;

/**
 * Class CommentContextAttribute
 * This is the base-model class for table "comment_context_attribute".
 *
 * @property integer $id
 * @property integer $commentable_context
 * @property string $context
 * @property integer $context_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @package arter\amos\comments\models\base
 */
class CommentContextAttribute extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_context_attribute';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['commentable_context', 'context', 'context_id'], 'required'],
            [['commentable_context'], 'boolean'],
            [['context'], 'string', 'max' => 255],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['context_id', 'created_by', 'updated_by', 'deleted_by'], 'integer']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosComments::t('amoscomments', 'ID'),
            'commentable_context' => AmosComments::t('amoscomments', 'Commentable Context'),
            'context' => AmosComments::t('amoscomments', 'Context'),
            'context_id' => AmosComments::t('amoscomments', 'Context ID'),
            'created_at' => AmosComments::t('amoscomments', 'Created At'),
            'updated_at' => AmosComments::t('amoscomments', 'Updated At'),
            'deleted_at' => AmosComments::t('amoscomments', 'Deleted At'),
            'created_by' => AmosComments::t('amoscomments', 'Created By'),
            'updated_by' => AmosComments::t('amoscomments', 'Updated By'),
            'deleted_by' => AmosComments::t('amoscomments', 'Deleted By')
        ]);
    }
}
