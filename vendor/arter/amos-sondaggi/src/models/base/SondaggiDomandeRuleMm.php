<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


namespace arter\amos\sondaggi\models\base;

use Yii;

/**
 * This is the base-model class for table "sondaggi_domande_rule_mm".
 *
 * @property integer $id
 * @property integer $sondaggi_domande_id
 * @property integer $sondaggi_domande_rule_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\sondaggi\models\SondaggiDomande $sondaggiDomande
 * @property \arter\amos\sondaggi\models\SondaggiDomandeRule $sondaggiDomandeRule
 */
class SondaggiDomandeRuleMm extends \arter\amos\core\record\Record
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sondaggi_domande_rule_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sondaggi_domande_id', 'sondaggi_domande_rule_id'], 'required'],
            [['sondaggi_domande_id', 'sondaggi_domande_rule_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['sondaggi_domande_id'], 'exist', 'skipOnError' => true, 'targetClass' => SondaggiDomande::className(), 'targetAttribute' => [
                    'sondaggi_domande_id' => 'id']],
            [['sondaggi_domande_rule_id'], 'exist', 'skipOnError' => true, 'targetClass' => SondaggiDomandeRule::className(),
                'targetAttribute' => ['sondaggi_domande_rule_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amossondaggi', 'ID'),
            'sondaggi_domande_id' => Yii::t('amossondaggi', 'Sondaggi Domande ID'),
            'sondaggi_domande_rule_id' => Yii::t('amossondaggi', 'Sondaggi Domande Rule ID'),
            'created_at' => Yii::t('amossondaggi', 'Creato il'),
            'updated_at' => Yii::t('amossondaggi', 'Aggiornato il'),
            'deleted_at' => Yii::t('amossondaggi', 'Cancellato il'),
            'created_by' => Yii::t('amossondaggi', 'Creato da'),
            'updated_by' => Yii::t('amossondaggi', 'Aggiornato da'),
            'deleted_by' => Yii::t('amossondaggi', 'Cancellato da'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSondaggiDomande()
    {
        return $this->hasOne(\arter\amos\sondaggi\models\SondaggiDomande::className(),
                ['id' => 'sondaggi_domande_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSondaggiDomandeRule()
    {
        return $this->hasOne(\arter\amos\sondaggi\models\SondaggiDomandeRule::className(),
                ['id' => 'sondaggi_domande_rule_id']);
    }
}