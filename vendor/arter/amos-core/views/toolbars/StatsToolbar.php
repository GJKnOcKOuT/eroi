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
 * @package    arter\amos\core\views\toolbars
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\toolbars;

use arter\amos\core\interfaces\StatsToolbarInterface;
use yii\base\Widget;
use yii\base\Model;

/**
 * Class StatsToolbar
 *
 * @package arter\amos\core\views\toolbars
 *
 */
class StatsToolbar extends Widget
{
    const BEHAVIORS_METHOD_EXPOSED = 'getStatsToolbar';
    const LAYOUT_DEFAULT = 1;
    const LAYOUT_VERTICAL = 2;
    const LAYOUT_HORIZONTAL = 3;

    /**
     * @var Model the data model that this widget is associated with.
     */
    public $model;

    /**
     * @var array
     */
    public $panels = [];

    /**
     * @var bool
     */
    public $onClick = false;

    /**
     * @var int - set toolbar layout
     */
    public $layoutType = self::LAYOUT_DEFAULT;

    /**
     * @var bool $disableLink
     */
    private $disableLink = true;

    /**
     * @return bool
     */
    public function getDisableLink()
    {
        return $this->disableLink;
    }

    /**
     * @param bool $disableLink
     */
    public function setDisableLink($disableLink)
    {
        $this->disableLink = $disableLink;
    }

    /**
     *
     */
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');
        if (!empty($moduleL)) {
            \arter\amos\layout\assets\TabsAsset::register($this->getView());
        } else {
            \arter\amos\core\views\assets\TabsAsset::register($this->getView());
        }
        $this->panels = []; //$this->fetchPanels();
        parent::init();
    }

    /**
     *
     * @return array
     */
    protected function fetchPanels()
    {
        $panels = [];

        if ($this->model instanceof StatsToolbarInterface) {
            $panels = $this->model->{self::BEHAVIORS_METHOD_EXPOSED}($this->disableLink);
        }
        return $panels;
    }

    /**
     *
     */
    public function run()
    {
        return ''; /*$this->render('toolbar',
            [
                'panels' => $this->panels,
                'model' => $this->model,
                'onClick' => $this->onClick,
                'layoutType' => $this->layoutType
            ]);*/
    }
}