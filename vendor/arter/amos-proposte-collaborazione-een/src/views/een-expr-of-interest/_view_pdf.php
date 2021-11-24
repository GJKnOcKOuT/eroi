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
 use arter\amos\een\AmosEen;
/**
 * @var $model \arter\amos\een\models\EenExprOfInterest
 * */

?>
<div><p><img src="/img/head-pdf.png"></p></div>

<p style="text-align: center">
    <?= AmosEen::t('amoseen', "<strong>Emilia Romagna Open Innovation (EROI)</strong><br>
    <a href=\"http://eroi.art-er.it/\">http://eroi.art-er.it/</a>
")?>
</p>

<p style="text-align: center">
    <?= AmosEen::t('amoseen', "Manifestazione di interesse (expression of interest) in una proposta di collaborazione generata nell’ambito di <a href=\"http://eroi.art-er.it/\">Enterprise Europe Network</a> tramite <a href=\"http://eroi.art-er.it/\">ART-ER</a>
")?>
</p>



<?php if($model->is_request_more_info == 1) { ?>
    <h5 style="text-align: center"><strong><?= AmosEen::t('amoseen', "REQUESTO MORE INFO")?></strong></h5>
<?php  } else { ?>
    <h5 style="text-align: center"><strong><?= AmosEen::t('amoseen', "EXPRESSION OF INTEREST")?></strong></h5>
<?php  } ?>
<div class="container-general-info">
<table  style="width: 100%;border: 1px solid; border-collapse: collapse; ">
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Identificativo proposta")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->eenPartnershipProposal->reference_external?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Titolo proposta")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->eenPartnershipProposal->content_title?></td>
    </tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Nome e cognome")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->contact_person?></td>
	</tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Email")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->email?></td>
	</tr>
</table>
<br>
<table style="width: 100%;border: 1px solid; border-collapse: collapse; ">
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "In quale regione operi abitualmente?")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->eenNetworkNode->name?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Conosci già i servizi di Enterprise Europe Network?")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->know_een == 0 ?'No':'Si'?></td>
    </tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Eventuali osservazioni")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->note?></td>
	</tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Company organization")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->company_organization?></td>
	</tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Sector/Activities")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->sector?></td>
	</tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Address")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->address?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "City")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->city?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Postal code")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->postal_code?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Web site")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->web_site?></td>
    </tr>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Contact Person")?></td>
		<td style="width: auto;border: 1px solid;"><?= $model->contact_person?></td>
	</tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Phone1")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->phone?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Email")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->email?></td>
    </tr>
    <tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "What kind of cooperation are you looking for?")?></td>
        <td style="width: auto;border: 1px solid;"><?= $model->technology_interest ?></td>
    </tr>
	<tr>
        <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Some facts about your company")?></td>
        <td style="width: auto;border: 1px solid;"> <?= $model->organization_presentation ?></td>
    </tr>
    <?php if(!empty($model->information_request)) { ?>
        <tr>
            <td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Which information is missing or unclear?")?></td>
            <td style="width: auto;border: 1px solid;"> <?= $model->information_request ?></td>
        </tr>
    <?php } ?>
	<tr>
		<td style="width: auto;border: 1px solid;"><?= AmosEen::t('amoseen', "Prendi visione delle modalità operative dello svolgimento del servizio e accetta per continuare")?></td>
		<td style="width: auto;border: 1px solid;"> Acconsento</td>
	</tr>
</table>
<br>
	<?php
	$url= \Yii::$app->params['platform']['backendUrl'].'/site/modalitaoperativeeen';
	?>
    <p style="font-size: 10px;">
    <?= AmosEen::t('amoseen', "EROI pubblica le proposte di collaborazione provenienti dalla Rete EEN e facilita l’avvio del processo di messa in contatto offrendo supporto preliminare ai partecipanti e dialogando direttamente con i centri EEN di competenza, a cui trasferisce le manifestazioni di interesse (Expression of Interest, di
seguito “EOI”) per le azioni successive.")?>
<br>    <?= AmosEen::t('amoseen', "La scelta di dare corso alla EOI, e quindi di stabilire un contatto diretto, è competenza esclusiva del soggetto che ha formulato la proposta che riceve la EOI.")?>
<br>    <?= AmosEen::t('amoseen', "I dati personali da te forniti su base volontaria, coerentemente a quanto accettato nelle modalità operative al momento dell’invio della manifestazione di interesse, verranno trasferiti da personale ART-ER al centro EEN competente per territorio del soggetto che ha pubblicato la proposta; in seguito potranno essere inviati al soggetto che ha formulato la proposta per la messa in contatto diretta tra le parti.")?>
<br>    <?= AmosEen::t('amoseen', "Per maggiori informazioni <a href='{url}'>prendi visione delle modalità operative dello svolgimento del servizio</a>.",['url' => $url])?>
</p>
</div>



