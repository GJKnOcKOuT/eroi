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
 * @package    arter-report
 * @category   Model
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\report\models\base;

use arter\amos\report\AmosReport;
use yii\helpers\ArrayHelper;

/**
 * Class reportType
 *
 * This is the base-model class for table "report_type".
 *
 * @property    integer $id
 * @property    string $name
 * @property    string $description
 * @property    string $created_at
 * @property    string $updated_at
 * @property    string $deleted_at
 * @property    integer $created_by
 * @property    integer $updated_by
 * @property    integer $deleted_by
 *
 * @package arter\amos\report\models\base
 */
class ReportType  extends \arter\amos\core\record\Record
{
    /**
     * @see    \yii\db\ActiveRecord::tableName()    for more info.
     */
    public static function tableName()
    {
        return 'report_type';
    }

    /**
     * @see    \yii\base\Model::rules()    for more info.
     */
    public function rules()
    {
        return [
            [['name','description'], 'string'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'required']
        ];
    }

    /**
     * @see    \arter\amos\core\record\Record::attributeLabels()    for more info.
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(),
            [
                'id' => AmosReport::t('amosreport', 'Id'),
                'name' => AmosReport::t('amosreport', 'Report Type name'),
                'description' => AmosReport::t('amosreport', 'Report Type description'),
                'created_at' => AmosReport::t('amosreport', 'Created at'),
                'updated_at' => AmosReport::t('amosreport', 'Modified at'),
                'deleted_at' => AmosReport::t('amosreport', 'Deleted at'),
                'created_by' => AmosReport::t('amosreport', 'Created by'),
                'updated_by' => AmosReport::t('amosreport', 'Modified by'),
                'deleted_by' => AmosReport::t('amosreport', 'Deleted by')
            ]
        );
    }
}