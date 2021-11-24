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
 * Class DiscussioniCommenti
 * This is the base-model class for table "discussioni_commenti".
 *
 * @property integer $id
 * @property string $testo
 * @property integer $discussioni_risposte_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 *
 * @property \arter\amos\discussioni\models\DiscussioniRisposte $discussioniRisposte
 * @package arter\amos\discussioni\models\base
 * @deprecated from version 1.5.
 */
class DiscussioniCommenti extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discussioni_commenti';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testo'], 'string'],
            [['discussioni_risposte_id'], 'required'],
            [['discussioni_risposte_id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
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
            'testo' => AmosDiscussioni::t('amosdiscussioni', 'Commento'),
            'discussioni_risposte_id' => AmosDiscussioni::t('amosdiscussioni', 'Discussioni Risposte ID'),
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
    public function getDiscussioniRisposte()
    {
        return $this->hasOne(DiscussioniRisposte::className(), ['id' => 'discussioni_risposte_id']);
    }
}
