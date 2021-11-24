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
$this->title = AmosSondaggi::t('amossondaggi', 'Sondaggio terminato');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sondaggi-index">
    <?php
    if (!empty($pubblicazioni->one()->text_not_compilable) && strlen(trim($pubblicazioni->one()->text_not_compilable))) {
        if ($pubblicazioni->one()->text_not_compilable_html == 1) {
            ?>
            <?= $pubblicazioni->one()->text_not_compilable ?>
            <?php
        } else {
            ?>
            <h4><?= $pubblicazioni->one()->text_not_compilable ?></h4>
            <?php
        }
    } else {
        ?>
        <h4><?= AmosSondaggi::tHtml('amossondaggi', 'SPIACENTI!!! SONDAGGIO GIA\' COMPILATO O NON COMPILABILE PER QUESTO PROFILO.') ?></h4>
    <?php } ?>
</div>
