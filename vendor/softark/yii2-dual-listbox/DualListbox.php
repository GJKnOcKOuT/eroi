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


namespace softark\duallistbox;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use yii\helpers\Json;

/**
 *  yii2-dual-listbox Widget
 *
 * @author Nobuo Kihara <softark@gmail.comu>
 * @since 1.0
 */
class DualListbox extends InputWidget
{
    /**
     * @var array listbox items
     */
    public $items = [];

    /**
     * @var string|array selected items
     */
    public $selection;

    /**
     * @var array listbox options
     */
    public $options = [];

    /**
     * @var array dual listbox options
     */
    public $clientOptions = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();

        Html::addCssClass($this->options, 'form-control');
        $this->options['multiple'] = true;

        if ($this->hasModel()) {
            return Html::activeListBox($this->model, $this->attribute, $this->items, $this->options);
        } else {
            return Html::listBox($this->name, $this->selection, $this->items, $this->options);
        }
    }

    /**
     * Registers the required JavaScript.
     */
    public function registerClientScript()
    {
        $view = $this->getView();
        DualListboxAsset::register($view);

        $id = (array_key_exists('id', $this->options)) ? $this->options['id'] : Html::getInputId($this->model, $this->attribute);
        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $view->registerJs("jQuery('#$id').bootstrapDualListbox($options);");
    }
}
