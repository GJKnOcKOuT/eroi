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

/**
 * @var $model
 * @var $idSessione
 * @var $idPagina
 * @var $utente
 */

$arrayModelRisposte = [];
foreach ((Array)$risposteWithFiles as $rispostaWithFile){
    $nomeVariabileDomanda = 'file_'.$rispostaWithFile->sondaggi_domande_id;
    $arrayModelRisposte [$nomeVariabileDomanda]= $rispostaWithFile;
}
?>

<div class="sondaggi-compilazione sondaggi-compilazione-sondaggio<?=$id?>">
    <?= $this->render('@backend/' . $this->context->module->id . '/pubblicazione/views/q' . $id . '/Pagina_' . $idPagina, \yii\helpers\ArrayHelper::merge([
        'model' => $model,
        'idSessione' => $idSessione,
        'idPagina' => $idPagina,
        'utente' => $utente,
        'ultimaPagina' => $ultimaPagina,
    ], $arrayModelRisposte)) ?>
</div>
