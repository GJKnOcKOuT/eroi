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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\invitations\widgets\icons\WidgetIconInvitations;
use arter\amos\invitations\widgets\icons\WidgetIconInvitationsAll;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * @package arter\amos\invitations
 */
class Module extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout = 'main';

    /**
     * @var string $name
     */
    public $name = 'invitations';

    /**
     *
     * @var string $subjectPlaceholder
     * Valore del placeholder per la label che corrisponde all'oggetto della mail invito (in traduzione)
     * Il default è #subject-invite
     */
    public $subjectPlaceholder = '#subject-invite';

    /**
     *
     * @var string $subjectCategory
     * Valore della categoria per la label che corrisponde all'oggetto della mail invito (in traduzione)
     * Il default è amosinvitations
     */
    public $subjectCategory = 'amosinvitations';

    /**
     * @inheritdoc
     */
    public static function getModuleName()
    {
        return "invitations";
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::setAlias('@arter/amos/' . static::getModuleName() . '/controllers', __DIR__ . '/controllers');

        //Configuration: merge default module configurations loaded from config.php with module configurations set by the application
        $config = require(__DIR__ . DIRECTORY_SEPARATOR . self::$CONFIG_FOLDER . DIRECTORY_SEPARATOR . 'config.php');
        \Yii::configure($this, ArrayHelper::merge($config, $this));
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            WidgetIconInvitations::className(),
            WidgetIconInvitationsAll::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return [];
    }

    /**
     * Get default model classes
     */
    protected function getDefaultModels()
    {
        return [
            'Invitation' => __NAMESPACE__ . '\\' . 'models\Invitation',
            'InvitationUser' => __NAMESPACE__ . '\\' . 'models\InvitationUser',
        ];
    }
}
