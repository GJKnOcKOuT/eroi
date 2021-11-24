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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\models\base;

use Yii;
use arter\amos\comuni\AmosComuni;

/**
 * This is the base-model class for table "istat_nazioni".
 *
 * @property integer $id
 * @property string $nome
 * @property string $nome_inglese
 * @property integer $area
 * @property integer $unione_europea
 * @property string $codice_catastale
 * @property string $iso2
 * @property string $iso3
 * @property integer $istat_continenti_id
 *
 * @property \arter\amos\comuni\models\IstatContinenti $istatContinenti
 * @property \arter\amos\comuni\models\IstatRegioni[] $istatRegionis
 */
class IstatNazioni extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'istat_nazioni';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'istat_continenti_id'], 'required'],
            [['id', 'area', 'unione_europea', 'istat_continenti_id', 'iso2', 'iso3'], 'integer'],
            [['nome', 'nome_inglese', 'codice_catastale'], 'string', 'max' => 255],
            [['istat_continenti_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatContinenti::className(), 'targetAttribute' => ['istat_continenti_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosComuni::t('amoscomuni', 'Codice Istat'),
            'nome' => AmosComuni::t('amoscomuni', 'Nazione'),
            'nome_inglese' => AmosComuni::t('amoscomuni', 'Nome inglese'),
            'area' => AmosComuni::t('amoscomuni', 'Area'),
            'unione_europea' => AmosComuni::t('amoscomuni', 'Appartenente all\'UE'),
            'codice_catastale' => AmosComuni::t('amoscomuni', 'Codice catastale'),
            'istat_continenti_id' => AmosComuni::t('amoscomuni', 'Continente'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatContinenti()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatContinenti::className(), ['id' => 'istat_continenti_id'])->inverseOf('istatNazionis');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatRegionis()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatRegioni::className(), ['istat_nazioni_id' => 'id'])->inverseOf('istatNazioni');
    }
}
