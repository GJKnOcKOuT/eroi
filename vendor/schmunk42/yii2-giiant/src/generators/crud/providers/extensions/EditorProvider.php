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

/**
 */
namespace schmunk42\giiant\generators\crud\providers\extensions;

class EditorProvider extends \schmunk42\giiant\base\Provider
{
    public $widget = 'ckeditor';
    public $widgets = [];

    public function activeField($attribute)
    {
        if (!isset($this->generator->getTableSchema()->columns[$attribute])) {
            return;
        }

        $column = $this->generator->getTableSchema()->columns[$attribute];

        if (in_array($column->name, $this->columnNames)) {
            if (isset($this->widgets[$column->name])) {
                $this->widget = $this->widgets[$column->name];
            }

            switch ($this->widget) {
                case 'redactor':
                    $this->generator->requires[] = 'yiidoc/yii2-redactor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\yii\\redactor\\widgets\\Redactor::className())";
                    break;
                case 'aceHTML':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'html', 'theme' => 'twilight'])";
                    break;
                case 'aceLESS':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'less', 'theme' => 'twilight'])";
                    break;
                case 'aceJS':
                    $this->generator->requires[] = 'trntv/aceeditor';

                    return "\$form->field(\$model, '{$attribute}')->widget(\\trntv\\aceeditor\\AceEditor::className(), ['mode' => 'javascript', 'theme' => 'twilight'])";
                    break;
                default:
                    $this->generator->requires[] = '2amigos/yii2-ckeditor-widget';

                    return <<<EOS
\$form->field(\$model, '{$attribute}')->widget(
    \dosamigos\ckeditor\CKEditor::className(),
    [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]
)
EOS;
            }
        }
    }
}
