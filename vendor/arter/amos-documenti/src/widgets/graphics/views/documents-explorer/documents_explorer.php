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
 * @package    arter\amos\documenti\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


/**
 * @var View $this
 */

use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\widgets\graphics\WidgetGraphicsUltimeDocumenti;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;
use arter\amos\documenti\assets\ModuleDocumentiAsset;

\arter\amos\documenti\assets\ModuleDocumentiDocumentsExplorerAsset::register($this);

$moduleDocumenti = \Yii::$app->getModule(AmosDocumenti::getModuleName());
$moduleL = \Yii::$app->getModule('layout');
if (!empty($moduleL)) {
    \arter\amos\layout\assets\SpinnerWaitAsset::register($this);
} else {
    \arter\amos\core\views\assets\SpinnerWaitAsset::register($this);
}

$exploder = (isset($explorer) && $explorer == true) ? true : false; 
$exploClass = !isset($explorer) ? '' : '-explorer';
$exploSize  = !isset($explorer) ? '8' : '12';

// Importing explorer html parts
echo $this->render('parts/navbar');
echo $this->render('parts/breadcrumb');
echo $this->render('parts/folders');
echo $this->render('parts/files');
echo $this->render('parts/modals/new-folder-modal');
echo $this->render('parts/modals/delete-file-modal');
echo $this->render('parts/modals/delete-folder-modal');
echo $this->render('parts/modals/delete-area-modal');
echo $this->render('parts/modals/delete-stanza-modal');
?>

<div class="loading" id="loader" hidden></div>
    <div class="box-widget-header">
        <div class="box-widget-wrapper">
            <h2 class="box-widget-title">
                <?= AmosIcons::show('news', ['class' => 'am-2'], AmosIcons::IC)?>
                <?= AmosDocumenti::tHTml('amosdocumenti', 'Documenti') ?>
            </h2>
        </div>
    </div>
<div class="box-widget">
    <section>
        <div class="list-items">
            <div id="documents-explorer">
                <?php if (!isset($explorer)) : ?>
                <section id="content-explorer-navbar"></section>
                <div class="col-md-4 col-xs-12 documents-explorer-sidebar-container">
                    <div id="location-title" class="col-xs-12 sidebar-container-header">
                        <h2><?= Yii::t('amosdocumenti', 'Aree di condivisione'); ?></h2>
    <!--                        <span id="go-back-room" class="am am-arrow-left" title="Torna indietro"> <!--TODO add class hidden if first layer-->
    <!--                            <span class="sr-only">Indietro</span>-->
    <!--                        </span>-->
    <!--                        <h2 class=""></h2> <!--TODO change with room name-->
                    </div>
                    <div class="col-xs-12 documents-explorer-sidebar">
                        <section id="content-explorer-sidebar">
                            <div class="stanze-list" id="stanze-list">
                            </div>
                        </section>
                    </div>
                </div>
                <?php endif ?>
                <div class="col-md-<?= $exploSize ?> col-xs-12 documents-explorer-items-container">
                    <div class="col-xs-12 items-container-header">
                        <section id="content-explorer-breadcrumb"></section>
                        <!--                        <span id="go-back-files" class="am am-arrow-left" title="Torna indietro"><span class="sr-only">Indietro</span></span>-->
                        <!--                        <h2 class="current-directory">Cartella corrente</h2> <!--TODO change with folder name if subfolder-->
                    </div>
                    <div class="col-xs-12 documents-explorer-items">
                        <section id="content-explorer-folders">
                        </section>
                        <section id="content-explorer-files">
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
