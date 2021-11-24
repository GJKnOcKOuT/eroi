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
 * @package    arter\amos\core\giiamos\crud\providers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\giiamos\crud\providers;

class DateTimeProvider extends \schmunk42\giiant\generators\crud\providers\extensions\DateTimeProvider
{


    public function activeField($attribute)
    {
        $column = $this->generator->getTableSchema()->columns[$attribute];

        switch ($column->type) {
            case 'datetime':
            case 'timestamp':
                $this->generator->requires[] = 'kartik\widgets\DateTimePicker;';
                /*return <<<EOS
\$form->field(\$model, '{$column->name}')->widget(DateTimePicker::classname(), [
	'options' => ['placeholder' => Yii::t('{$this->generator->messageCategory}','Inserisci un orario ...')],
	'pluginOptions' => [
		'autoclose' => true
	]
])
EOS;*/
                return <<<EOS
\$form->field(\$model, '{$column->name}')->widget(DateTimePicker::classname(), [
	'options' => ['placeholder' => Yii::t('amoscore','Set time')],
	'pluginOptions' => [
		'autoclose' => true
	]
])
EOS;
                break;
            case 'date':
                $this->generator->requires[] = 'kartik\datecontrol\DateControl';
                return <<<EOS
\$form->field(\$model, '{$column->name}')->widget(DateControl::classname(), [
    'displayFormat' => 'dd/MM/yyyy',
    'saveFormat' => 'yyyy-MM-dd',
    'autoWidget' => false,
    'widgetClass' => 'yii\widgets\MaskedInput',
    'options' => [
        'mask' => '99/99/9999'
    ],
])
EOS;
                break;
            default:
                return null;
        }
    }

} 
