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
 * This is the base-model class for table "istat_unione_dei_comuni".
 *
 * @property integer $id
 * @property string $nome
 * @property string $sito
 * @property integer $istat_province_id
 *
 * @property \arter\amos\comuni\models\IstatComuni[] $istatComunis
 * @property \arter\amos\comuni\models\IstatProvince $istatProvince
 */
class IstatUnioneDeiComuni extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'istat_unione_dei_comuni';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'istat_province_id'], 'required'],
            [['id', 'istat_province_id'], 'integer'],
            [['nome', 'sito'], 'string', 'max' => 255],
            [['istat_province_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatProvince::className(), 'targetAttribute' => ['istat_province_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosComuni::t('amoscomuni', 'Codice Gestione Associata'),
            'nome' => AmosComuni::t('amoscomuni', 'Unione dei comuni'),
            'sito' => AmosComuni::t('amoscomuni', 'Sito web'),
            'istat_province_id' => AmosComuni::t('amoscomuni', 'Provincia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatComunis()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatComuni::className(), ['istat_unione_dei_comuni_id' => 'id'])->inverseOf('istatUnioneDeiComuni');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatProvince()
    {
        return $this->hasOne(\arter\amos\comuni\models\IstatProvince::className(), ['id' => 'istat_province_id'])->inverseOf('istatUnioneDeiComunis');
    }
}
