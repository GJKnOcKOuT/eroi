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
* This is the base-model class for table "sondaggi_domande_condizionate".
*
    * @property integer $sondaggi_risposte_predefinite_id
    * @property integer $sondaggi_domande_id
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property integer $version
    *
            * @property \arter\amos\sondaggi\models\SondaggiDomande $sondaggiDomande
            * @property \arter\amos\sondaggi\models\SondaggiRispostePredefinite $sondaggiRispostePredefinite
    */
class SondaggiDomandeCondizionate extends \arter\amos\core\record\Record
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'sondaggi_domande_condizionate';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['sondaggi_risposte_predefinite_id', 'sondaggi_domande_id'], 'required'],
            [['sondaggi_risposte_predefinite_id', 'sondaggi_domande_id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'sondaggi_risposte_predefinite_id' => AmosSondaggi::t('amossondaggi', 'Risposta attesa'),
    'sondaggi_domande_id' => AmosSondaggi::t('amossondaggi', 'Domanda condizionata'),
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
    public function getSondaggiDomande()
    {
    return $this->hasOne(\arter\amos\sondaggi\models\SondaggiDomande::className(), ['id' => 'sondaggi_domande_id'])
        ->andWhere([\arter\amos\sondaggi\models\SondaggiDomande::tableName().'.deleted_at' => null]);
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSondaggiRispostePredefinite()
    {
    return $this->hasOne(\arter\amos\sondaggi\models\SondaggiRispostePredefinite::className(), ['id' => 'sondaggi_risposte_predefinite_id']);
    }
}
