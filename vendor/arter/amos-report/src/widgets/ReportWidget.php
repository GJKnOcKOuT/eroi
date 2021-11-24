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
 * @category   Widget
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\report\widgets;

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\report\AmosReport;
use yii\base\Widget;

/**
 * Class ReportWidget
 * @package arter\amos\report\widgets
 */
class ReportWidget extends Widget
{
    /**
     * @var string $modelClassName the current model processed className
     */
    public $modelClassName = '';

    /**
     * @var null
     */
    public $context_id = null;

    /**
     * @var string
     */
    public $layout = "{reportButton}";
    /**
     * @var array
     */
    public $renderSections = [];

    /**
     * @var
     */
    public $options = [];

    /**
     * @var string
     */
    public $title = '';

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->modelClassName)) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Model'));
        }
        if (is_null($this->context_id)) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Context Id'));
        }

    }


    /**
     * @return mixed
     */
    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $this->layout);
        $options = $this->options;

        return $this->render('report',[
            'widget' => $this,
            'content' => $content,
            'context_id' => $this->context_id,
            'className' => $this->modelClassName,
            'title' => $this->title
        ]);
    }

      /**
     * Renders a section of the specified name.
     * If the named section is not supported, false will be returned.
     * @param string $name the section name, e.g., `{publisher}`, `{publisherAdv}`.
     * @return string|bool the rendering result of the section, or false if the named section is not supported.
     */
    public function renderSection($name)
    {
        if (isset($this->renderSections[$name]) && $this->renderSections[$name] instanceof \Closure) {
            return call_user_func($this->renderSections[$name], $this->model, $this);
        }
        switch ($name) {
            case '{reportButton}':
                return $this->renderReportButton();
            default:
                return false;
        }
    }

    /**
     * @return string
     */
    public function renderReportButton()
    {
        $href = 'javascript: void(0)';
        $button = Html::a(AmosIcons::show("flag", ["class" => "am-2"]), null , [
            'id' => 'load_form-'.$this->context_id,
            'title' => AmosReport::t('amosreport', 'You can report errors or contents that you consider inappropriate and, if necessary, ask for correction')
        ]);
//        $button = '<a href="' . $href . '" id="load_form" title="'. AmosReport::t('amosreport', 'Report').'">' . AmosIcons::show("flag", ["class" => "am-2"]) . '</a>';
        return $button;
    }


}