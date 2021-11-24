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
 * @package    arter\amos\documenti\assets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\assets;

use yii\web\AssetBundle;
use arter\amos\core\widget\WidgetAbstract;

/**
 * Class ModuleDocumentiAsset
 * @package arter\amos\documenti\assets
 */
class ModuleDocumentiAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-documenti/src/assets/web';

    /**
     * @inheritdoc
     */
    public $css = [
        'less/documents.less',
        'less/hierarchical-documents.less'
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/documents.js'
    ];

    /**
     * @inheritdoc
     */
    public $depends = [
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        $moduleL = \Yii::$app->getModule('layout');

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->css = ['less/documents_fullsize.less'];
        }

        if (!empty($moduleL)) {
            $this->depends [] = 'arter\amos\layout\assets\BaseAsset';
        } else {
            $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }
}
