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
 * @package    arter\amos\organizzazioni\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models\base;

use arter\amos\core\record\Record;
use arter\amos\organizzazioni\Module;
use Yii;

/**
 * Class ProfiloEntiType
 *
 * This is the base-model class for table "profilo_enti_type".
 *
 * @property integer $id
 * @property integer $priority
 * @property string $name
 *
 * @property \arter\amos\organizzazioni\models\Profilo[] $profili
 *
 * @package arter\amos\organizzazioni\models\base
 */
abstract class ProfiloEntiType extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profilo_enti_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['priority'], 'integer'],
            [['name'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosorganizzazioni', 'ID'),
            'name' => Yii::t('amosorganizzazioni', 'Name'),
            'priority' => Yii::t('amosorganizzazioni', 'Priority'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfili()
    {
        return $this->hasMany(Module::instance()->model('Profilo'), ['profilo_enti_type_id' => 'id']);
    }
}
