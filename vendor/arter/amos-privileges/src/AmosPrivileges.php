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
 * @package    arter-privileges
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\privileges;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use Yii;

/**
 * Class AmosReport
 * @package arter\amos\privileges
 */
class AmosPrivileges extends AmosModule implements ModuleInterface
{
    /**
     * @var array roles that must not be considered by Privileges module
     */
    public $blackListRoles = ['AMMINISTRATORE_CRTT'];
    /**
     * @var array if set, consider only the roles in this list
     */
    public $whiteListRoles = [];
    /**
     * @var array array of modules for which privileges are not considered
     */
    public $blackListModules = ['inforeq', 'proposte_collaborazione', 'proposte_collaborazione_een'];
    /**
     * @var array list of platform roles (not from a single plugin) - override this if necessary
     */
    public $platformRoles = ['ADMIN', 'BASIC_USER'];

    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    public $name = 'Privileges';

    public static function getModuleName()
    {
        return "privileges";
    }

    public function init()
    {
        parent::init();

        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php'));
    }

    public function getWidgetIcons()
    {
        return [

        ];
    }

    public function getWidgetGraphics()
    {
        return [

        ];
    }

    protected function getDefaultModels()
    {
        // TODO: Implement getDefaultModels() method.
    }
}