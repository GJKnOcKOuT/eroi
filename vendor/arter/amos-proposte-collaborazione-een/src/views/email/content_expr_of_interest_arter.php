<?php
use arter\amos\een\AmosEen;
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\een\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var arter\amos\een\models\EenExprOfInterest $model
 */

?>
<div style="padding:10px;margin-bottom: 10px;background-color: #ffffff;">

    <div>
        <!-- getImage universal code-->
    </div>

    <!--    <div style="padding:0;margin:0">-->
    <!--        <h3 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">-->
    <!--            < ?= Html::a($model->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #297A38;']) ?>-->
    <!--        </h3>-->
    <!--    </div>-->

    <div style="font-size:13px;font-weight:normal;color:#000000;">

    </div>
    <div style="padding-bottom: 5px;">
        <p>
            <?php
            $titolo = $model->eenPartnershipProposal->content_title;
            $code = $model->eenPartnershipProposal->reference_external;
            $company_name = $model->company_organization;
            $regione = $model->eenNetworkNode->name;
            $orgName = '';
            $emailStaff = '';
            $nomeCognomeStaff  = '';
            $noteUtente = $model->note;

            $staffEen = $model->eenStaff;
            if($staffEen) {
                $nomeCognomeStaff = $staffEen->user->userProfile->nomeCognome;
                $emailStaff = $staffEen->user->email;
                if (!empty($staffEen->user->userProfile->prevalentPartnership)) {
                    $orgName = $staffEen->user->userProfile->prevalentPartnership->name;
                }
            }

            ?>
<!--            < ?=AmosEen::t('amoseen', 'Gentile {nomeCognome}', ['nomeCognome' => $model->user->userProfile->nomeCognome])? ><br>-->
            <?php
            $str = '';
         ?>
            <?php if($model->is_request_more_info == 0) { ?>
	             <p>Nome e cognome utente: <?=$model->user->userProfile->nomeCognome ?></p>
	             <p>Indirizzo email: <?=$model->user->email ?></p>
	             <p>Regione di attività:<?=$model->eenNetworkNode->name ?></p>
	             <p>Eventuali osservazioni:<?=$model->note ?></p>
	             <p>Company organization:<?=$model->company_organization ?></p>
	             <p>Sector/Activities:<?=$model->sector ?></p>
	             <p>Address:<?=$model->address ?></p>
	             <p>City:<?=$model->city ?></p>
	             <p>Postal code:<?=$model->postal_code ?></p>
	             <p>Web site:<?=$model->web_site ?></p>
	             <p>Contact Person:<?=$model->contact_person ?></p>
	             <p>Phone:<?=$model->phone ?></p>
	             <p>Email: <?=$model->email ?></p>
	             <p>What kind of cooperation are you looking for?:<?=$model->technology_interest ?></p>
	             <p>Which information is missing or unclear?:<?=$model->information_request ?></p>
	             <p>Some facts about your company:<?=$model->organization_presentation ?></p>

	            <?php
//
            }
            else { ?>

                <?php
//	            if($staffEen) {
//                    $str = AmosEen::t('amoseen', " che riceve questo messaggio in copia e ti contatterà direttamente:<br>
//                     <strong>{nomeCognomeStaff}, {orgName} ({emailStaff})</strong> che ha ricevuto copia di questo messaggio. <br> ",[
//                        'nomeCognomeStaff' => $nomeCognomeStaff, 'orgName' => $orgName, 'companyName' => $company_name, 'emailStaff' => $emailStaff, 'een_id' => $code
//                    ]);
//                }
                ?>
                <?=AmosEen::t('amoseen',
                    "Ti confermiamo che la tua richiesta di informazioni sui servizi della rete EEN (Enterprise Europe Network) è stata acquisita correttamente.<br>
                                <br>" .
                    "La richiesta di informazioni è stata generata a partire dalla proposta di collaborazione dal titolo <strong>{titolo}</strong> e codice <strong>{een_id}</strong><br><br>"
                    . "La richiesta è stata assegnata ad un esperto della rete EEN competente per la regione indicata ({regione} )"
                    . $str
                    ." <br> Al momento della effettiva presa in carico da parte sua riceverai una notifica dal sistema."
                    . "<br><br>
                     <strong>Le tue osservazioni</strong>: {note}
                     <br><br>
                                Cordiali saluti,<br>
                                Staff ART-ER per Enterprise European Network
                              ", ['nomeCognomeStaff' => $nomeCognomeStaff, 'orgName' => $orgName, 'companyName' => $company_name, 'regione' => $regione, 'titolo' => $titolo, 'een_id' => $code, 'note' => $model->note]);?>
            <?php  } ?>
            <br>
            <br>
<!--            < ? = AmosEen::t('amoseen', "Richiedente: {nomeCognome} <br>Proposta di collaborazione {titolo} {codice}",[-->
<!--                'titolo' => $titolo, 'codice' => $code, 'nomeCognome' => $model->user->userProfile->nomeCognome-->
<!---->
<!--            ])? >-->
        </p>

    </div>
</div>