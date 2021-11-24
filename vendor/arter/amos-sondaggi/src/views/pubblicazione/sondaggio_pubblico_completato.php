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
 * @package    arter\amos\sondaggi\views\pubblicazione
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\sondaggi\AmosSondaggi;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var arter\amos\sondaggi\models\search\SondaggiSearch $searchModel
 */
$this->title = AmosSondaggi::t('amossondaggi', 'Sondaggio completato');
?>
<div class="container">
    <nav role="navigation" aria-label="breadcrumbs" aria-labelledby="bc-title" id="bc">
        <h5 id="bc-title" class="vis-off"><?= AmosSondaggi::tHtml('amossondaggi', 'Sei qui') ?>:</h5>
        <ol class="breadcrumb">
            <li><a href="/site/index"><?= AmosSondaggi::tHtml('amossondaggi', 'Home') ?></a></li>
            <li><a href="/<?= $this->context->module->id ?>/pubblicazione/sondaggi-pubblici"><?= AmosSondaggi::tHtml('amossondaggi', 'Sondaggi pubblici') ?></a>
            </li>
            <li class="active"><?= AmosSondaggi::tHtml('amossondaggi', 'Sondaggio completato') ?></li>
        </ol>
    </nav>
</div>

<main role="main" id="mainContent">
    <div class="container">
        <div class="page" role="contentinfo">
            <h1><?= AmosSondaggi::tHtml('amossondaggi', 'Sondaggio pubblico') ?></h1>
            <div class="sondaggi-compilazione marginTB">
                <div class="sondaggi-index">
                    <h4 class="green"><strong><?= AmosSondaggi::tHtml('amossondaggi', 'Complimenti! Sondaggio completato') ?></strong></h4>
                </div>
            </div>
        </div>
    </div>
</main>

<main role="main" id="mainContent">
    <div class="container">
        <div class="page" role="contentinfo">
            <?php
            if (!empty($pubblicazioni->one()->text_end_title) && strlen(trim($pubblicazioni->one()->text_end_title))) {
                ?>
                <h1><?= $pubblicazioni->one()->text_end_title ?></h1>
                <?php
            } else {
                ?>
                <h1><?= AmosSondaggi::tHtml('amossondaggi', 'Sondaggio pubblico') ?></h1>
            <?php } ?>
            <div class="sondaggi-compilazione marginTB">
                <div class="sondaggi-index">
                    <?php
                    if (!empty($pubblicazioni->one()->text_end) && strlen(trim($pubblicazioni->one()->text_end))) {
                        if ($pubblicazioni->one()->text_end_html == 1) {
                            ?>
                            <?= $pubblicazioni->one()->text_end ?>
                            <?php
                        } else {
                            ?>
                            <h4 class="green"><strong><?= $pubblicazioni->one()->text_end ?></strong></h4>
                            <?php
                        }
                    } else {
                        ?>
                        <h4 class="green"><strong><?= AmosSondaggi::tHtml('amossondaggi', 'Complimenti! Sondaggio completato') ?></strong></h4>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</main>
