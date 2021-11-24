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
* This is the base-model class for table "sondaggi_stato".
*
    * @property integer $id
    * @property string $stato
    * @property string $descrizione
    * @property string $created_at
    * @property string $updated_at
    * @property string $deleted_at
    * @property integer $created_by
    * @property integer $updated_by
    * @property integer $deleted_by
    * @property integer $version
    *
            * @property \arter\amos\sondaggi\models\Sondaggi[] $sondaggis
    */
class SondaggiStato extends \arter\amos\core\record\Record
{
/**
* @inheritdoc
*/
public static function tableName()
{
return 'sondaggi_stato';
}

/**
* @inheritdoc
*/
public function rules()
{
return [
            [['descrizione'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['stato'], 'string', 'max' => 255]
        ];
}

/**
* @inheritdoc
*/
public function attributeLabels()
{
return [
    'id' => AmosSondaggi::t('amossondaggi', 'ID'),
    'stato' => AmosSondaggi::t('amossondaggi', 'Stato'),
    'descrizione' => AmosSondaggi::t('amossondaggi', 'Descrizione'),
    'created_at' => AmosSondaggi::t('amossondaggi', 'Creato il'),
    'updated_at' => AmosSondaggi::t('amossondaggi', 'Aggiornato il'),
    'deleted_at' => AmosSondaggi::t('amossondaggi', 'Cancellato il'),
    'created_by' => AmosSondaggi::t('amossondaggi', 'Creato da'),
    'updated_by' => AmosSondaggi::t('amossondaggi', 'Aggiornato da'),
    'deleted_by' => AmosSondaggi::t('amossondaggi', 'Cancellato da'),
    'version' => AmosSondaggi::t('amossondaggi', 'Versione numero'),
];
}

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getSondaggis()
    {
    return $this->hasMany(\arter\amos\sondaggi\models\Sondaggi::className(), ['sondaggi_stato_id' => 'id']);
    }
}
