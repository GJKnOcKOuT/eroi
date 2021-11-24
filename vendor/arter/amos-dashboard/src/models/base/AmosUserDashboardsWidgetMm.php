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
 * @package    arter\amos\dashboard
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\dashboard\models\base;

use arter\amos\core\record\AmosRecordAudit;
use arter\amos\dashboard\AmosDashboard;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "amos_user_dashboards_widget_mm".
 *
 * @property integer $amos_user_dashboards_id
 * @property string $amos_widgets_classname
 * @property integer $order
 */
class AmosUserDashboardsWidgetMm extends AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'amos_user_dashboards_widget_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amos_user_dashboards_id', 'amos_widgets_classname', 'id'], 'required'],
            [['amos_user_dashboards_id', 'order', 'id'], 'integer'],
            [['amos_widgets_classname', 'created_at'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'amos_user_dashboards_id' => AmosDashboard::t('amosdashboard', 'Amos User Dashboards ID'),
            'amos_widgets_classname' => AmosDashboard::t('amosdashboard', 'Amos Widgets Classname'),
            'order' => AmosDashboard::t('amosdashboard', 'Order'),
            'created_at' => AmosDashboard::t('amosdashboard', 'Created at'),
        ]);
    }
}
