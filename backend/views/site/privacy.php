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
    $this->title = Yii::t('amosapp', 'INFORMATIVA SULLA PRIVACY');
}
?>

<section>
    <div class="row">
        <div class="col-xs-12">
            <h1 class="text-center text-uppercase bold"><?=
                Yii::t('amosapp',
                    'INFORMATIVA per il trattamento dei dati personali ai sensi dell’art 13 del Regolamento europeo n.
679/2016')
                ?></h1>
        </div>
    </div>
</section>
<section>
    <h2 class="bold"><?= Yii::t('amosapp', '1. Premessa') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            'Ai sensi dell’art. 13 del Regolamento europeo n. 679/2016, la Giunta della Regione Emilia-Romagna, in
qualità di “Titolare” del trattamento, è tenuta a fornirle informazioni in merito all’utilizzo dei suoi dati
personali.')
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '2. Identità e i dati di contatto del titolare del trattamento') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            'Il Titolare del trattamento dei dati personali di cui alla presente Informativa è la Giunta della Regione
Emilia-Romagna, con sede in Bologna, Viale Aldo Moro n. 52, cap 40127.
Al fine di semplificare le modalità di inoltro e ridurre i tempi per il riscontro si invita a presentare le
richieste di cui al paragrafo n. 10, alla Regione Emilia-Romagna, Ufficio per le relazioni con il pubblico (Urp),
per iscritto o recandosi direttamente presso lo sportello Urp.
L’Urp è aperto dal lunedì al venerdì dalle 9 alle 13 in Viale Aldo Moro 52, 40127 Bologna (Italia): telefono
800-662200, fax 051-527.5360, e-mail urp@regione.emilia-romagna.it.
Come indicato al par. 4 la Regione ha assegnato ad ART-ER S. cons. p. a. la gestione della piattaforma EROI
(Emilia Romagna Open Innovation) contattabile alla mail info@art-er.it, pec art-er@legalmail.it')
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '3. Il Responsabile della protezione dei dati personali') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "Il Responsabile della protezione dei dati designato dall’Ente è contattabile all’indirizzo mail
dpo@regione.emilia-romagna.it o presso la sede della Regione Emilia-Romagna di Viale Aldo Moro n. 30.")
        ?>

    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '4. Responsabili del trattamento') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "L’Ente può avvalersi di soggetti terzi per l’espletamento di attività e relativi trattamenti di dati personali di
cui manteniamo la titolarità. Conformemente a quanto stabilito dalla normativa, tali soggetti assicurano
livelli esperienza, capacità e affidabilità tali da garantire il rispetto delle vigenti disposizioni in materia di
trattamento, ivi compreso il profilo della sicurezza dei dati.
La Regione formalizza istruzioni, compiti ed oneri in capo a tali soggetti terzi con la designazione degli stessi
a 'Responsabili del trattamento' e sottopone tali soggetti a verifiche periodiche al fine di constatare il
mantenimento dei livelli di garanzia registrati in occasione dell’affidamento dell’incarico iniziale.
Specificatamente la Regione ha assegnato ad ART-ER S. cons. p. a., con sede legale c/o CNR – Area della
Ricerca di Bologna Via P. Gobetti, 101 – 40129 Bologna, la gestione della piattaforma EROI (Emilia Romagna
Open Innovation) e, pertanto, ha nominato la stessa quale responsabile del trattamento.")
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '5. Soggetti autorizzati al trattamento') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "I Suoi dati personali sono trattati da personale interno previamente autorizzato e designato quale
incaricato del trattamento, a cui sono impartite idonee istruzioni in ordine a misure, accorgimenti, modus
operandi, tutti volti alla concreta tutela dei suoi dati personali.")
        ?>
    </p>
    <h2 class="bold"><?= Yii::t('amosapp', '6. Finalità e base giuridica del trattamento') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "Il trattamento dei suoi dati personali viene effettuato dalla Giunta della Regione Emilia-Romagna ai fini
della promozione dello sviluppo di sistemi e metodologie basate prioritariamente sulle tecnologie
dell’informazione volte a favorire una più efficace interazione tra i soggetti partecipi all’ecosistema
regionale dell’innovazione e, in particolare, una piattaforma di Open innovation (cfr. artt. 54-55 L.r. n.
3/1999, art. 3 L.r. 7/2002, art. 27 L.r. 25/2016, D.G.R. 1951/2017) e, pertanto, ai sensi dell’art. 6 comma 1
lett. e) non necessita del suo consenso. I dati personali sono trattati per le seguenti finalità:")
        ?>
    </p>
    <ul>
        <li><?=
            \Yii::t('amosapp',
                'registrazione dell’Utente - ll trattamento ha ad oggetto i dati personali comuni forniti dall’Utente in sede
di registrazione ad EROI ed è finalizzato a consentire la creazione dell’account/profilo Utente e l’accesso ai
servizi e attività previste dal Sito. Le informazioni inserite che saranno visibili a tutti gli utenti registrati
saranno individuabili tramite apposite indicazioni (asterischi, note, ecc.).')
            ?></li>
        <li><?=
            \Yii::t('amosapp',
                'Accesso ai servizi - Il trattamento è finalizzato a consentire l’accesso dell’Utente registrato ai servizi del
sito che riguardano: l’assegnazione di un mentor in grado di supervisionare e affiancare l’utente nelle
diverse attività previste dal sito; la possibilità di entrare in contatto con altri utenti, se preventivamente
richiesto; l’accesso ai contenuti inseriti da altri soggetti (profili, post, news, commenti, video, documenti,
allegati, immagini)')
            ?></li>
        <li><?=
            \Yii::t('amosapp',
                "Corrispondenza con l’Utente, supporto tecnico ed assistenza - Il trattamento è finalizzato all’invio,
all’indirizzo fornito dall’Utente, delle comunicazioni inerenti l'attività e i contenuti generati all’interno del
sito (news, notifiche di messaggi chat o commenti ai contenuti esistenti, richieste di contatto,
aggiornamenti sulle “Sfide” lanciate, ecc.) nonché all’espletamento di attività di assistenza e supporto.")
            ?></li>
    </ul>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '7. Destinatari dei dati personali') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "I suoi dati personali non sono oggetto di comunicazione o diffusione, eccetto verso i soggetti di cui al par. 4
della presente informativa.")
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', '8. Trasferimento dei dati personali a Paesi extra UE') ?></h2>
    <p>
        <?= Yii::t('amosapp', "I suoi dati personali non sono trasferiti al di fuori dell’Unione europea.") ?>
    </p>
    <h2 class="bold"><?= Yii::t('amosapp', '9. Periodo di conservazione') ?></h2>
    <p><?=
        Yii::t('amosapp',
            "I suoi dati sono conservati per un periodo non superiore a quello necessario per il perseguimento delle
finalità sopra menzionate. A tal fine, anche mediante controlli periodici, viene verificata costantemente la
stretta pertinenza, non eccedenza e indispensabilità dei dati rispetto alle finalità di cui al par. 6 della
presente informativa. I dati che, anche a seguito delle verifiche, risultano eccedenti o non pertinenti o non
indispensabili non sono utilizzati, salvo che per l'eventuale conservazione, a norma di legge, dell'atto o del
documento che li contiene.")
        ?></p>
    <h2 class="bold"><?= Yii::t('amosapp', '10. I suoi diritti') ?></h2>
    <p><?= Yii::t('amosapp', "Nella sua qualità di interessato, Lei ha diritto:") ?></p>
    <ul>
        <li> <?= Yii::t('amosapp', "di accesso ai dati personali;") ?></li>
        <li> <?=
            Yii::t('amosapp',
                "di ottenere la rettifica o la cancellazione degli stessi o la limitazione del trattamento che lo
riguardano;")
            ?></li>
        <li> <?= Yii::t('amosapp', "di opporsi al trattamento;") ?></li>
        <li> <?= Yii::t('amosapp', "di proporre reclamo al Garante per la protezione dei dati personali") ?></li>
    </ul>
    <h2 class="bold"><?= Yii::t('amosapp', '11. Conferimento dei dati') ?></h2>
    <p><?=
        Yii::t('amosapp',
            "Il conferimento dei Suoi dati è facoltativo, ma necessario per le finalità sopra indicate. Il mancato
conferimento comporterà l’impossibilità di accedere alla piattaforma.")
        ?></p>

</section>
