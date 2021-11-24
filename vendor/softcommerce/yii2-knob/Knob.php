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



namespace softcommerce\knob;

use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;

class Knob extends Widget
{
    public $options = [];
    public $knobOptions = [];
    public $name = '';
    public $min = 0;
    public $max = 100;
    public $value = 0;
    public $icon = null;

    public function init()
    {
        parent::init();
        Html::addCssClass($this->options, 'jqKnob');
    }

    public function run()
    {
        if (!array_key_exists('id', $this->options)) {
            $this->options['id'] = $this->getId();
        }
        echo Html::textInput($this->name, $this->value, $this->options);
        $view = $this->getView();
        KnobAsset::register($view);
        $pluginsJs = "";
        if (!is_null($this->icon)) {
            KnobIconAsset::register($view);
            $pluginsJs .= "addKnobIcon('#{$this->options['id']}', '".addslashes($this->icon)."');\n";
        }
        $knobOptions = empty($this->knobOptions) ? '' : Json::encode($this->knobOptions);
        $js = "jQuery('#{$this->options['id']}').knob({$knobOptions});\n";
        $js .= $pluginsJs;
        $view->registerJs($js);
    }
} 