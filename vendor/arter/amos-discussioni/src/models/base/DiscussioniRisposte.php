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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\models\base;

use arter\amos\discussioni\AmosDiscussioni;

/**
 * Class DiscussioniRisposte
 * This is the base-model class for table "discussioni_risposte".
 *
 * @property integer $id
 * @property string $testo
 * @property integer $discussioni_topic_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 *
 * @property \arter\amos\discussioni\models\DiscussioniCommenti[] $discussioniCommentis
 * @property \arter\amos\discussioni\models\DiscussioniTopic $discussioniTopic
 * @package arter\amos\discussioni\models\base
 * @deprecated from version 1.5.
 */
class DiscussioniRisposte extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discussioni_risposte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testo'], 'string'],
            [['discussioni_topic_id'], 'required'],
            [['discussioni_topic_id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosDiscussioni::t('amosdiscussioni', 'ID'),
            'testo' => AmosDiscussioni::t('amosdiscussioni', 'Risposta'),
            'discussioni_topic_id' => AmosDiscussioni::t('amosdiscussioni', 'Discussione'),
            'created_at' => AmosDiscussioni::t('amosdiscussioni', 'Creato il'),
            'updated_at' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato il'),
            'deleted_at' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato il'),
            'created_by' => AmosDiscussioni::t('amosdiscussioni', 'Creato da'),
            'updated_by' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato da'),
            'deleted_by' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato da'),
            'version' => AmosDiscussioni::t('amosdiscussioni', 'Versione numero'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussioniCommentis()
    {
        return $this->hasMany(\arter\amos\discussioni\models\DiscussioniCommenti::className(), ['discussioni_risposte_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussioniTopic()
    {
        return $this->hasOne(\arter\amos\discussioni\models\DiscussioniTopic::className(), ['id' => 'discussioni_topic_id']);
    }
}
