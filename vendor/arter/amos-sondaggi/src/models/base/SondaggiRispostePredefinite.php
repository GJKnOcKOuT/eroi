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
 * @package    arter\amos\sondaggi\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\models\base;

use Yii;
use arter\amos\sondaggi\AmosSondaggi;

/**
 * This is the base-model class for table "sondaggi_risposte_predefinite".
 *
 * @property integer $id
 * @property string $risposta
 * @property integer $sondaggi_domande_id
 * @property integer $ordinamento
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 *
 * @property \arter\amos\sondaggi\models\SondaggiDomandeCondizionate[] $sondaggiDomandeCondizionates
 * @property \arter\amos\sondaggi\models\SondaggiDomande $sondaggiDomande
 */
class SondaggiRispostePredefinite extends \arter\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sondaggi_risposte_predefinite';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['risposta'], 'safe'],
            [['sondaggi_domande_id'], 'required'],
            [['sondaggi_domande_id', 'ordinamento', 'created_by', 'updated_by', 'deleted_by', 'version', 'modello_id'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosSondaggi::t('amossondaggi', 'ID'),
            'risposta' => AmosSondaggi::t('amossondaggi', 'Risposta predefinita'),
            'sondaggi_domande_id' => AmosSondaggi::t('amossondaggi', 'Domanda'),
            'modello_id' => AmosSondaggi::t('amossondaggi', 'Id modello'),
            'ordinamento' => AmosSondaggi::t('amossondaggi', 'Ordinamento'),
            'created_at' => AmosSondaggi::t('amossondaggi', 'Creato il'),
            'updated_at' => AmosSondaggi::t('amossondaggi', 'Aggiornato il'),
            'deleted_at' => AmosSondaggi::t('amossondaggi', 'Cancellato il'),
            'created_by' => AmosSondaggi::t('amossondaggi', 'Creato da'),
            'updated_by' => AmosSondaggi::t('amossondaggi', 'Aggiornato da'),
            'deleted_by' => AmosSondaggi::t('amossondaggi', 'Cancellato da'),
            'version' => AmosSondaggi::t('amossondaggi', 'Versione'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSondaggiDomandeCondizionates()
    {
        return $this->hasMany(\arter\amos\sondaggi\models\SondaggiDomandeCondizionate::className(), ['sondaggi_risposte_predefinite_id' => 'id'])
            ->andWhere([\arter\amos\sondaggi\models\SondaggiDomandeCondizionate::tableName().'.deleted_at' => null]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSondaggiDomande()
    {
        return $this->hasOne(\arter\amos\sondaggi\models\SondaggiDomande::className(), ['id' => 'sondaggi_domande_id'])
            ->andWhere([\arter\amos\sondaggi\models\SondaggiDomande::tableName().'.deleted_at' => null]);
    }
}
