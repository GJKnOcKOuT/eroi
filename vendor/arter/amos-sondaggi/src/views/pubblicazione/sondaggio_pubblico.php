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

if ($libero) {
    $link = "/" . $this->context->module->id . "/pubblicazione/sondaggi-pubblici";
    $testoLink = "Sondaggi pubblici";
    $quest = arter\amos\sondaggi\models\Sondaggi::findOne($id);
    $breadcrumb = $quest->titolo;
    $this->title = $breadcrumb;
    $descrizione = $quest->descrizione;
} else { //TODO PER ENTITA' SPECIFICHE
    $link = "/" . $this->context->module->id . "/pubblicazione/sondaggio-pubblico-attivita";
    $testoLink = "Sondaggio di gradimento";
    $quest = arter\amos\sondaggi\models\Sondaggi::findOne($id);
    $breadcrumb = 'DA CONFIGURARE';//backend\modules\attivitaformative\models\PeiAttivitaFormative::findOne(['codice_attivita' => $attivita])->titolo;
    $this->title = $breadcrumb;
    $descrizione = $quest->descrizione;
}
?>
<!--<div class="container">
    <nav role="navigation" aria-label="breadcrumbs" aria-labelledby="bc-title" id="bc">
        <h5 id="bc-title" class="vis-off">Sei qui:</h5>
        <ol class="breadcrumb">
            <li><a href="/site/index">Home</a></li>  
            <li><a href="< ? =$link;?>">< ? =$testoLink;?></a></li>  
            <li class="active">< ? = $breadcrumb ?></li>
        </ol>
    </nav>
</div>-->
<main role="main" id="mainContent">
    <div class="container">
        <div class="page" role="contentinfo">
            <h1><?= $this->title; ?></h1>
            <div class="sondaggi-compilazione marginTB">
                <?= $this->render('/q' . $id . '/Pagina_' . $idPagina, [
                    'model' => $model,
                    'idSessione' => $idSessione,
                    'idPagina' => $idPagina,
                    'attivita' => $attivita,
                    'libero' => $libero,
                    'utente' => NULL
                ]) ?>
            </div>
        </div>
    </div>
</main>
