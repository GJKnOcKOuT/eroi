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
 * This is the base-model class for table "istat_comuni_cap".
 *
    * @property integer $id
    * @property integer $comune_id
    * @property string $cap
    * @property string $sospeso
    *
    * @property \app\models\IstatComuni $comune
    */

    class IstatComuniCap extends \arter\amos\core\record\Record
    {


        /**
         * @inheritdoc
         */
        public static function tableName()
        {
            return 'istat_comuni_cap';
        }

        /**
         * @inheritdoc
         */
        public function rules()
        {
            return [
                [['comune_id','cap'],'required'],
                [['comune_id'], 'integer'],
                [['cap', 'sospeso'], 'string', 'max' => 255],
                [['comune_id'], 'exist', 'skipOnError' => true, 'targetClass' => IstatComuni::className(), 'targetAttribute' => ['comune_id' => 'id']],
            ];
        }

        /**
         * @inheritdoc
         */
        public function attributeLabels()
        {
            return [
                'id' => Yii::t('app', 'ID'),
                'comune_id' => Yii::t('app', 'Comune ID'),
                'cap' => Yii::t('app', 'Cap'),
                'sospeso' => Yii::t('app', 'Sospeso'),
            ];
        }

        /**
        * @return \yii\db\ActiveQuery
        */
        public function getComune()
        {
            return $this->hasOne(\arter\amos\comuni\models\IstatComuni::className(), ['id' => 'comune_id']);
        }

}
