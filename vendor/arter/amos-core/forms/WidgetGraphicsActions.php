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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\widget\WidgetGraphic;
use yii\base\Widget;

/**
 * Class WidgetGraphicsActions
 * @package arter\amos\core\forms
 */
class WidgetGraphicsActions extends Widget
{
    /**
     * @var string $layout Widget view
     */
    public $layout = "@vendor/arter/amos-core/forms/views/widgets/widget_graphics_actions.php";

    /**
     * @var WidgetGraphic $widget Graphic widget object
     */
    private $widget = null;

    /**
     * @var string $tClassName Classname of module of the graphic widget
     */
    private $tClassName = '';

    /**
     * @var string $actionRoute Route to controller action
     */
    private $actionRoute;
    
    /**
     * @var string $permissionCreate Permission to check to view the create new button
     */
    private $permissionCreate;

    /**
     * @var array $options Options array for the widget (ie. html options)
     */
    private $options = [];

    /**
     * @var string $toRefreshSectionId Id of the section to refresh (ie. a "div" tag or other tag)
     */
    private $toRefreshSectionId;

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->renderFile($this->getLayout(), [
            'widget' => $this->getWidget(),
            'tClassName' => $this->getTClassName(),
            'actionRoute' => $this->getActionRoute(),
            'permissionSave' => $this->getPermissionCreate(),
            'options' => $this->getOptions(),
            'toRefreshSectionId' => $this->getToRefreshSectionId()
        ]);
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return mixed
     */
    public function getWidget()
    {
        return $this->widget;
    }

    /**
     * @param mixed $widget
     */
    public function setWidget($widget)
    {
        $this->widget = $widget;
    }

    /**
     * @return mixed
     */
    public function getTClassName()
    {
        return $this->tClassName;
    }

    /**
     * @param mixed $tClassName
     */
    public function setTClassName($tClassName)
    {
        $this->tClassName = $tClassName;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return string
     */
    public function getActionRoute()
    {
        return $this->actionRoute;
    }

    /**
     * @param string $actionRoute
     */
    public function setActionRoute($actionRoute)
    {
        $this->actionRoute = $actionRoute;
    }
    
    /**
     * @return string
     */
    public function getPermissionCreate()
    {
        return $this->permissionCreate;
    }
    
    /**
     * @param string $permissionCreate
     */
    public function setPermissionCreate($permissionCreate)
    {
        $this->permissionCreate = $permissionCreate;
    }

    /**
     * @return mixed
     */
    public function getToRefreshSectionId()
    {
        return $this->toRefreshSectionId;
    }

    /**
     * @param mixed $toRefreshSectionId
     */
    public function setToRefreshSectionId($toRefreshSectionId)
    {
        $this->toRefreshSectionId = $toRefreshSectionId;
    }
}
