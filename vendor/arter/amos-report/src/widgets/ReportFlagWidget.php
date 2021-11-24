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
use arter\amos\core\record\Record;
use arter\amos\report\AmosReport;
use arter\amos\report\utilities\ReportUtil;
use Yii;
use yii\base\Widget;

/**
 * Class ReportWidget
 * @package arter\amos\report\widgets
 */
class ReportFlagWidget extends Widget
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
     * @var Record
     */
    public $model;


    public $permissionName = null;

    private $hasPermission = false;

    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->model)) {
            throw new \Exception(BaseAmosModule::t('amosreport', 'Missing Model'));
        } else {
            $this->modelClassName = $this->model->classname();
            $this->context_id = $this->model->id;
        }

        if(!is_null($this->permissionName)){
            $this->hasPermission = Yii::$app->user->can($this->permissionName, ['model' => $this->model]);
        } else {
            $this->hasPermission = (Yii::$app->user->can(strtoupper($this->model->formName(). '_UPDATE'),  ['model' => $this->model])
                || \Yii::$app->user->can( $this->modelClassName. '_UPDATE', ['model' => $this->model]));
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

        if($this->hasPermission) {
            return $content 
                . ReportsListModalWidget::widget([
                    'model' => $this->model
                ]);
        }
        
        return '';
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

        return Html::tag(
            'div',
            Html::a(
                AmosIcons::show(
                    'flag', 
                    ['class' => 'am-2']
                ), 
                null, 
                [
                    'id' => 'load_reports_list_from_flag-' . $this->context_id,
                    'title' => AmosReport::t('amosreport', '#view_reports_list'),
                ]
            ),
            [
                'class' => 'reportflag-widget' 
                    . (count(ReportUtil::retrieveUnreadReports($this->modelClassName, $this->context_id)) > 0 
                        ? ' unread-report' 
                        : ''
                    )
            ]
        );

    }

}