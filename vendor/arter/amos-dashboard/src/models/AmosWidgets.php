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

namespace arter\amos\dashboard\models;

use arter\amos\dashboard\models\base\AmosWidgets as BaseAmosWidgets;
use arter\amos\dashboard\AmosDashboard;
use yii\helpers\ArrayHelper;

/**
 * @property AmosWidgets[] $childrens
 * @property AmosWidgets $father
 */
class AmosWidgets extends BaseAmosWidgets
{
    const STATUS_ENABLED  = 1;
    const STATUS_DISABLED = 0;
    const TYPE_ICON       = 'ICON';
    const TYPE_GRAPHIC    = 'GRAPHIC';

    public $classname_subdashboard;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['classname_subdashboard'], 'safe'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'classname_subdashboard' => AmosDashboard::t('amosdashboard', 'Classname'),
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildrens()
    {
        return $this->hasMany(
                \arter\amos\dashboard\models\AmosWidgets::className(), ['child_of' => 'classname']
        );
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFather()
    {
        return $this->hasOne(
                \arter\amos\dashboard\models\AmosWidgets::className(), ['classname' => 'child_of']
        );
    }
}