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


/**
 * @package   yii2-dynagrid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2019
 * @version   1.5.1
 */

namespace kartik\dynagrid\models;

use kartik\base\Config;
use kartik\dynagrid\Module;
use Yii;
use yii\base\Model;

/**
 * Model for the dynagrid configuration
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since 1.0
 */
class DynaGridConfig extends Model
{
    /**
     * @var string the module identifier if this object is part of a module. If not set, the module identifier will
     * be auto derived based on the \yii\base\Module::getInstance method. This can be useful, if you are setting
     * multiple module identifiers for the same module in your Yii configuration file. To specify children or grand
     * children modules you can specify the module identifiers relative to the parent module (e.g. `admin/content`).
     */
    public $moduleId;
    /**
     * @var string the dynagrid widget identifier
     */
    public $id;
    /**
     * @var array the hidden grid columns
     */
    public $hiddenColumns = [];
    /**
     * @var array the visible grid columns
     */
    public $visibleColumns = [];
    /**
     * @var array the widget options for the [[\kartik\sortable\Sortable]] widget
     */
    public $widgetOptions = [];
    /**
     * @var array the list of saved grid themes
     */
    public $themeList = [];
    /**
     * @var array the list of saved grid filters
     */
    public $filterList = [];
    /**
     * @var array the list of saved grid sort
     */
    public $sortList = [];
    /**
     * @var integer the grid page size
     */
    public $pageSize = null;
    /**
     * @var string the filter identifier
     */
    public $filterId = null;
    /**
     * @var string the sort identifier
     */
    public $sortId = null;
    /**
     * @var string|null the footer content for the dynagrid configuration form
     */
    public $footer = null;
    /**
     * @var string the currently selected grid theme
     */
    public $theme = null;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        /**
         * @var Module $module
         */
        $module = Config::getModule($this->moduleId, Module::class);
        return [
            [['id', 'hiddenColumns', 'visibleColumns', 'pageSize', 'filterId', 'sortId', 'theme'], 'safe'],
            ['theme', 'required'],
            ['pageSize', 'integer', 'min' => $module->minPageSize, 'max' => $module->maxPageSize],
            ['pageSize', 'default', 'value' => $module->defaultPageSize],
            ['theme', 'default', 'value' => $module->defaultTheme],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hiddenColumns' => Yii::t('kvdynagrid', 'Hidden / Fixed Columns'),
            'visibleColumns' => Yii::t('kvdynagrid', 'Visible Columns'),
            'pageSize' => Yii::t('kvdynagrid', 'Page Size'),
            'filterId' => Yii::t('kvdynagrid', 'Default Filter'),
            'sortId' => Yii::t('kvdynagrid', 'Default Sort'),
            'theme' => Yii::t('kvdynagrid', 'Grid Theme'),
        ];
    }
}
