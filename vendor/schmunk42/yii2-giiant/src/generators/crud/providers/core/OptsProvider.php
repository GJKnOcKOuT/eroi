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


namespace schmunk42\giiant\generators\crud\providers\core;

use yii\db\ColumnSchema;

/**
 * Class OptsProvider.
 *
 * @author Christopher Stebe <c.stebe@herzogkommunikation.de>
 */
class OptsProvider extends \schmunk42\giiant\base\Provider
{
    public function activeField($attribute)
    {
        $column = $this->generator->getColumnByAttribute($attribute);
        if (!$column) {
            return;
        }

        $modelClass = $this->generator->modelClass;
        $func = 'opts'.str_replace('_', '', $attribute);
        $camel_func = 'opts'.str_replace(' ', '', ucwords(implode(' ', explode('_', $attribute))));

        if (method_exists($modelClass::className(), $func)) {
            $mode = isset($this->columnNames[$attribute]) ? $this->columnNames[$attribute] : null;
        } elseif (method_exists($modelClass::className(), $camel_func)) {
            $func = $camel_func;
            $mode = isset($this->columnNames[$attribute]) ? $this->columnNames[$attribute] : null;
        } else {
            return;
        }

        switch ($mode) {
            case 'radio':
                return <<<EOS
                    \$form->field(\$model, '{$attribute}')->radioList(
                        {$modelClass}::{$func}()
                    );
EOS;
                break;

            case 'select2':
                return <<<EOS
                    \$form->field(\$model, '{$attribute}')->widget(\kartik\select2\Select2::classname(), [
                        'name' => 'class_name',
                        'model' => \$model,
                        'attribute' => '{$attribute}',
                        'data' => {$modelClass}::{$func}(),
                        'options' => [
                            'placeholder' => {$this->generator->generateString('Type to autocomplete')},
                            'multiple' => false,
                        ]
                    ]);
EOS;
                break;

            default:
                // Render a dropdown list if the model has a method optsColumn().
                return <<<EOS
                        \$form->field(\$model, '{$attribute}')->dropDownList(
                            {$modelClass}::{$func}()
                        );
EOS;

        }

        return;
    }

    /**
     * Formatter for detail view attributes, who have get[..]ValueLabel function.
     *
     * @param $column ColumnSchema
     *
     * @return null|string
     */
    public function attributeFormat($attribute)
    {
        $modelClass = $this->generator->modelClass;
        $camel_func = 'get'.str_replace(' ', '', ucwords(implode(' ', explode('_', $attribute)))).'ValueLabel';

        if (!method_exists($modelClass::className(), $camel_func)) {
            return;
        }

        return <<<EOS
            [
                'attribute'=>'{$attribute}',
                'value'=>{$modelClass}::{$camel_func}(\$model->{$attribute}),
            ]
EOS;
    }

    /**
     * Formatter for detail view attributes, who have get[..]ValueLabel function.
     *
     * @param $column ColumnSchema
     * @param $model ActiveRecord
     *
     * @return null|string
     */
    public function columnFormat($attribute, $model)
    {
        $modelClass = $this->generator->modelClass;
        $camel_func = 'get'.str_replace(' ', '', ucwords(implode(' ', explode('_', $attribute)))).'ValueLabel';

        if (!method_exists($modelClass::className(), $camel_func)) {
            return;
        }

        return <<<EOS
			[
                'attribute'=>'{$attribute}',
                'value' => function (\$model) {
                    return {$modelClass}::{$camel_func}(\$model->{$attribute});
                }    
            ]        
EOS;
    }
}
