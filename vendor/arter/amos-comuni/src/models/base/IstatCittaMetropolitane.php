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
 * This is the base-model class for table "istat_citta_metropolitane".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property \arter\amos\comuni\models\IstatProvince[] $istatProvinces
 */
class IstatCittaMetropolitane extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'istat_citta_metropolitane';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome'], 'required'],
            [['id'], 'integer'],
            [['nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosComuni::t('amoscomuni', 'Codice Istat'),
            'nome' => AmosComuni::t('amoscomuni', 'Città Metropolitana'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIstatProvinces()
    {
        return $this->hasMany(\arter\amos\comuni\models\IstatProvince::className(), ['istat_citta_metropolitane_id' => 'id'])->inverseOf('istatCittaMetropolitane');
    }
}
