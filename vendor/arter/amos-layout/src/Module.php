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
 * @package    arter\amos\layout
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\layout;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\layout\components\Layout;
use yii\base\BootstrapInterface;

/**
 * Class Module
 * @package arter\amos\socialauth
 */
class Module extends AmosModule implements ModuleInterface, BootstrapInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'arter\amos\layout\controllers';

    /**
     * View path of maintenance page
     * @var string $viewMaintenanceMode
     */
    public $viewMaintenanceMode = '@vendor/arter/amos-layout/src/views/maintenance/maintenance';

    /**
     * Choose to display a single logout action in the navbar or multiple ones
     * @var boolean $advancedLogoutActions
     */
    public $advancedLogoutActions = false;

    public $breadcrumbsIconHomeText = false;

    public $excludeNetworkView = ['amos\planner\models\PlanWork'];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->defineModelClasses();
    }

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        //Set Layout
        \Yii::$app->set('layout', Layout::className());
    }

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return 'layout';
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
        ];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
        return [

        ];
    }
}
