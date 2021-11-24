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

/**
 * Class ModuleDocumentiDocumentsExplorerAsset
 * @package arter\amos\documenti\assets
 */
class ModuleDocumentiDocumentsExplorerAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@vendor/arter/amos-documenti/src/assets/web';

    /**
     * @inheritdoc
     */
    public $css = [
        //'less/documents.less',
        //'less/hierarchical-documents.less',
        //'css/materialize/materialize.min.css',
        //'css/materialize/sidenav.css',
        'less/documents-explorer.less',
        'css/jquery.modal.min.css',
        'css/jquery.contextMenu.min.css',
    ];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/documents-explorer/lajax.js',
        'js/documents.js',
        'js/documents-explorer/mustache.min.js',
        'js/documents-explorer/jquery.modal.min.js',
        'js/documents-explorer/jquery.ui.position.min.js',
        'js/documents-explorer/jquery.contextMenu.min.js',
        'js/documents-explorer/underscore-min.js',
        'js/documents-explorer/documents-explorer.js',
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
        // TODO Disable force copy
        \Yii::$app->assetManager->forceCopy = true;
        $moduleL = \Yii::$app->getModule('layout');
        if (!empty($moduleL)) {
            $this->depends [] = 'arter\amos\layout\assets\BaseAsset';
        } else {
            $this->depends [] = 'arter\amos\core\views\assets\AmosCoreAsset';
        }
        parent::init();
    }
}
