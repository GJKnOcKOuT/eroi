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
 * @package    arter\amos\sondaggi\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\core\helpers\Html;
use arter\amos\sondaggi\AmosSondaggi;
use arter\amos\sondaggi\assets\ModuleSondaggiAsset;
use arter\amos\sondaggi\widgets\graphics\WidgetGraphicsUltimiSondaggi;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;

/**
 * @var View $this
 * @var ActiveDataProvider $lista
 * @var WidgetGraphicsUltimiSondaggi $widget
 * @var string $toRefreshSectionId
 */

ModuleSondaggiAsset::register($this);

$moduleSondaggi = \Yii::$app->getModule(AmosSondaggi::getModuleName());
$listaModels = $lista->getModels();

?>
<div class="grid-item grid-item--width2 grid-item--height2">
    <div class="box-widget latest-sondaggi">
        <div class="box-widget-toolbar">
            <h1 class="box-widget-title col-xs-10 nop"><?= AmosSondaggi::t('amossondaggi', 'Ultimi sondaggi') ?></h1>
            <?php
            if (isset($moduleSondaggi) && !$moduleSondaggi->hideWidgetGraphicsActions) {
                WidgetGraphicsActions::widget([
                    'widget' => $widget,
                    'tClassName' => AmosSondaggi::className(),
                    'actionRoute' => '/sondaggi/sondaggi/create',
                    'toRefreshSectionId' => $toRefreshSectionId
                ]);
            } ?>
        </div>
        <section class="clearfixplus">
            <h2 class="sr-only"><?= AmosSondaggi::t('amossondaggi', 'Ultimi sondaggi') ?></h2>
            <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
            <?php
            if (count($listaModels) == 0) {
                $textReadAll = AmosSondaggi::t('amossondaggi', '#addSondaggio');
                $linkReadAll = '/sondaggi/sondaggi/create';
                $checkPermNew = true;
            } else {
                $textReadAll = AmosSondaggi::t('amossondaggi', 'Visualizza Elenco Sondaggi');
                $linkReadAll = ['/sondaggi/pubblicazione/all'];
                $checkPermNew = false;
            }
            ?>
            <div class="list-items">
                <?php foreach ($listaModels as $sondaggio): ?>
                    <div class="col-xs-12 col-sm-4 col-md-4 widget-listbox-option" role="option">
                        <article class="col-xs-12 nop">
                            <div class="container-img">
                                <?php
                                $url = '/img/img_default.jpg';
                                if (!is_null($sondaggio->file)) {
                                    $url = $sondaggio->file->getUrl('square_medium', false, true);
                                }
                                ?>
                                <?= Html::img($url, ['class' => 'img-responsive', 'alt' => AmosSondaggi::t('amossondaggi', 'Immagine del sondaggio')]); ?>
                            </div>
                            <div class="container-text clearfixplus">

                                <div class="col-xs-12">
                                    <h2 class="box-widget-subtitle">
                                        <?php
                                        if (strlen($sondaggio->titolo) > 55) {
                                            $stringCut = substr($sondaggio->titolo, 0, 55);
                                            echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                        } else {
                                            echo $sondaggio->titolo;
                                        }
                                        ?>
                                    </h2>
                                    <p class="box-widget-text">
                                        <?php
                                        if (strlen($sondaggio->descrizione) > 80) {
                                            $stringCut = substr($sondaggio->descrizione, 0, 80);
                                            echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                                        } else {
                                            echo $sondaggio->descrizione;
                                        }
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="footer-listbox col-xs-12 m-t-5 nop">
                                <?= Html::a(AmosSondaggi::t('amossondaggi', 'LEGGI TUTTO'), ['/sondaggi/sondaggi/view', 'id' => $sondaggio->id], ['class' => 'btn btn-navigation-primary']); ?>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php Pjax::end(); ?>
        </section>
        <div class="read-all"><?= Html::a($textReadAll, $linkReadAll, ['class' => ''], $checkPermNew); ?></div>
    </div>
</div>
