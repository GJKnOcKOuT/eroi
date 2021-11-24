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
 * @package    arter\amos\core\forms\editors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms\editors;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\widgets\ActiveForm;
use kartik\base\InputWidget;
use kartik\field\FieldRangeAsset;

class AmosDatePicker extends \kartik\date\DatePicker {

    /**
     * The markup to render the calendar icon in the date picker button.
     */
    const CALENDAR_ICON = '<span class="glyphicon glyphicon-calendar"></span>';

    /**
     * @var array the HTML attributes for the button that is rendered for [[TYPE_BUTTON]]. Defaults to
     * `['class'=>'btn btn-default']`. The following special options are recognized:
     * - 'label': string the button label. Defaults to `<span class="glyphicon glyphicon-calendar"></span>`
     */
    public $buttonOptions = [];

    /**
     * Returns the addon to render
     *
     * @param array  $options the HTML attributes for the addon
     * @param string $type whether the addon is the picker or remove
     *
     * @return string
     */
    protected function renderAddon(&$options, $type = 'picker') {
        if ($options === false) {
            return '';
        }
        if (is_string($options)) {
            return $options;
        }
        $icon = ($type === 'picker') ? 'calendar' : 'remove';
        Html::addCssClass($options, 'input-group-addon kv-date-' . $icon);
        $icon = '<span class="glyphicon glyphicon-' . ArrayHelper::remove($options, 'icon', $icon) . '"></span>';
        $title = ArrayHelper::getValue($options, 'title', '');
        if ($title !== false && empty($title)) {
            $options['title'] = ($type === 'picker') ? Yii::t('kvdate', 'Select date') :
                    Yii::t('kvdate', 'Clear field');
        }
        return Html::tag('span', $icon, $options);
    }

}
