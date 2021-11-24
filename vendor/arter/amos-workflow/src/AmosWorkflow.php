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
 * @package    arter\amos\workflow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\workflow;

use arter\amos\core\module\Module;
use arter\amos\core\module\ModuleInterface;
use arter\amos\core\record\Record;
use arter\amos\workflow\components\events\SimpleWorkFlowEventsListener;
use raoul2000\workflow\base\SimpleWorkflowBehavior;
use Yii;
use yii\base\Event;

/**
 * Class AmosWorkflow
 * @package arter\amos\workflow
 */
class AmosWorkflow extends Module implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    public $name = 'Workflow';

    public static function getModuleName()
    {
        return "workflow";
    }

    public function init()
    {
        parent::init();
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php'));

        Event::on(Record::className(), SimpleWorkflowBehavior::EVENT_AFTER_CHANGE_STATUS, [SimpleWorkFlowEventsListener::className(), 'afterChangeStatus']);
    }

    public function getWidgetIcons()
    {
        return [];
    }

    public function getWidgetGraphics()
    {
        return [];
    }
}