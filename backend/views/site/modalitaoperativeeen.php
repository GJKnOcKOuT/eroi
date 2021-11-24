<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\views\site
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */
//check to avoid whole page having title 'Privacy Policy' when rendered in a modal
if (empty($this->title)) {
    $this->title = Yii::t('amosapp', 'Modalità operative dello svolgimento del servizio');
}
?>


<section>
	<p>
        <?=
        Yii::t('amosapp',
            '<a href="https://een.ec.europa.eu/">Enterprise Europe Network (di seguito “EEN”) </a>')
        ?>


        <?=
        Yii::t('amosapp',
            'è la Rete globale creata e finanziata dalla Commissione Europea a supporto dell’innovazione e ricerca, dell’internazionalizzazione e dello sviluppo delle Piccole e medie imprese. La Rete opera dal 2008, è formata da oltre 600 organizzazione in più di 60 Paesi in tutto il mondo e si avvale di un sistema per la gestione delle comunicazioni fra i centri della Rete gestito dall’Agenzia EASME della Commissione Europea, allo scopo di garantire il rispetto delle normative europee sulla protezione dei dati.')
        ?>
	</p>

	<br>

	<p>
        <?=
        Yii::t('amosapp',
            'Fra i suoi servizi, la Rete EEN offre la possibilità di ')
        ?>
	
        <?=
        Yii::t('amosapp',
            '<strong>diffondere in maniera anonima proposte di collaborazione in tutti i Paesi in cui opera</strong>')
        ?>

    <?=
    Yii::t('amosapp',
        ', assicurando il supporto necessario alla redazione delle proposte (inclusa la verifica di coerenza e qualità del contenuto) e alla creazione di un primo contatto fra i soggetti interessati')
    ?>
	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            'Le proposte di collaborazione possono avere come oggetto :')
        ?>
        <?=
        Yii::t('amosapp',
            'Le proposte di collaborazione possono avere come oggetto : 
				<ul>
				<li>la realizzazione di progetti congiunti di ricerca (Research & Development Requests o “RDR”)</li>
				<li>la realizzazione di progetti di trasferimento tecnologico (Technology Requests “TR” e Technology Offers “TO”)</li>
				<li>la conclusione di accordi commerciali (Business Requests “BR” e Business Offers “BO”).</li>
				</ul>');
        ?>

	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            '<strong>Per entrare in contatto con chi ha formulato una proposta di collaborazione è necessario compilare una manifestazione di interesse (o Expression of Interest, di seguito “EOI”).</strong>'
        )
        ?>

	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            'Trattandosi di una Rete globale, il supporto viene fornito a ciascuna delle parti interessate dai centri della Rete su base regionale; tutti i centri della Rete dialogano utilizzando strumenti e metodi condivisi.'
        )
        ?>

	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            '<a href="https://www.aster.it/eroi-la-piattaforma-di-open-innovation-dellemilia-romagna">EROI - La Piattaforma di Open Innovation dell\'Emilia-Romagna</a> pubblica le proposte di collaborazione provenienti dalla Rete EEN e <strong>facilita l’avvio del processo di messa in contatto</strong> offrendo supporto preliminare ai partecipanti e dialogando direttamente con i centri EEN di competenza, a cui trasferisce le EOI per le azioni successive. Tuttavia, ricordiamo che <strong>la scelta di dare corso alla EOI, e quindi di stabilire un contatto diretto, è competenza esclusiva del soggetto che ha formulato la proposta che riceve la EOI</strong>).'
        )
        ?>

	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            'La EOI si compone di due sezioni: una redatta in lingua italiana che contiene informazioni utili al nodo EEN competente per territorio italiano che le darà supporto; una redatta in lingua inglese che contiene informazioni utili a chi ha formulato la proposta per decidere se dare corso ad un contatto diretto.'
        )
        ?>
	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            'Alla luce di quanto sopra, non essendo determinabile a priori l’identità dei soggetti internazionali che potranno ricevere le informazioni contenute nella EOI, <strong>le chiediamo di porre particolare attenzione a verificare che questa non contenga informazioni riservate o comunque di cui non sia proprietario</strong> o per cui non si sia preventivamente munito di autorizzazione al trasferimento a terzi.'
        )
        ?>
	</p>
	<br>
	<p>
        <?=
        Yii::t('amosapp',
            'Inoltre le comunichiamo che i suoi dati personali potranno essere comunicati ai Partner del Consorzio SIMPLER, esclusivamente per le finalità indicate nella presente informativa per la raccolta e l’elaborazione per lo svolgimento delle attività inerenti al Progetto. Infine le comunichiamo che i dati personali da lei forniti su base volontaria verranno trattati da personale ART-ER allo scopo di dare esecuzione al servizio e di trasferire la EOI al centro EEN che segue il soggetto che ha pubblicato la proposta, oppure a quello competente per territorio. Infatti il servizio prevede che i due centri EEN competenti offrano supporto all\'avvio del contatto diretto tra i due soggetti interessati (chi manifesta interesse inviando questa EOI e il soggetto che ha formulato la proposta che riceve la EOI):<strong> i suoi dati potranno quindi essere inviati al soggetto che ha formulato la proposta</strong>.'
        )
        ?>

	</p>


</section>
