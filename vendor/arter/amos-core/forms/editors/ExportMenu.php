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
 * @package    arter\amos\core\forms\editors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms\editors;

use arter\amos\core\forms\editors\assets\ExportMenuAsset;
use arter\amos\core\utilities\StringUtils;
use kartik\base\BootstrapInterface;
use kartik\base\BootstrapTrait;
use kartik\dialog\Dialog;
use kartik\export\ExportColumnAsset;
use kartik\export\ExportMenu as KartikExportMenu;
use ReflectionClass;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;

/**
 * Export menu widget. Export tabular data to various formats using the `\PhpOffice\PhpSpreadsheet\Spreadsheet library
 * by reading data from a dataProvider - with configuration very similar to a GridView.
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class ExportMenu extends KartikExportMenu
{  
    /**
     * @var string the view file for rendering the export form
     */
    public $exportFormView = '';

    /**
     * @var string the view file for rendering the columns selection
     */
    public $exportColumnsView = '';

    public $afterSaveView = '';


    public $batchSize = 500;

    /**
     *
     * @param type $config
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $reflector = new ReflectionClass('\kartik\export\ExportMenu');
        $fn = dirname($reflector->getFileName());
        $vendor = Yii::getAlias('@vendor');
        $fn = '@vendor' . StringUtils::replace(StringUtils::replace($fn, '\\', '/'), StringUtils::replace($vendor, '\\', '/'), '');

        $this->exportFormView = $fn . '/views/_form';
        $this->exportColumnsView = $fn . '/views/_columns';
        $this->afterSaveView = $fn . '/views/_view';
    }

    /**
     * Initializes export settings
     */
    public function initExport()
    {
        if (!$this->dataProvider->pagination) {
            $this->dataProvider->setPagination(['pageSize' => $this->batchSize]);
        }
        parent::initExport();
    }
    
}
