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
    $this->title = Yii::t('amosapp', "TERMINI D'USO");
}
?>

<section>
    <p><?= Yii::t('amosapp', 'EROI è aperta a tutte le persone che vogliono innovare collaborando, trovando soluzioni e scambiando competenze in linea con i principi dell\'open innovation. La Piattaforma ed i relativi servizi non sono destinati ad usi e finalità commerciali.') ?></p>
    <h2 class="bold"><?= Yii::t('amosapp', 'Servizi e funzionalità') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
                'Scopo di EROI è offrire agli operatori dell\'innovazione uno spazio di confronto e condivisione per favorire progettualità collaborative, facilitare la creazione di partnership e l\'accesso a reti, promuovere il confronto rispetto alle politiche regionali di supporto alla ricerca, innovazione e competitività, utile anche ad una migliore definizione degli interventi regionali di supporto.<br>
                EROI ospita servizi/strumenti/funzionalità (in sintesi “funzionalità”) progettate per consentire a ciascun utente iscritto validato alla piattaforma di comunicare e di interagire con gli altri utenti. e  che consentono, tra le altre, agli utenti iscritti validati di pubblicare un profilo personale, postare notizie, condividere materiali nella forma di allegati, aprire specifiche discussioni tematiche e commentare discussioni aperte da altri utenti iscritti, attivare o partecipare a gruppi tematici, lanciare sfide di innovazione che rientrino nello scopo di precise iniziative o rispondere con proprie soluzioni a sfide di innovazione lanciate da altri utenti iscritti, rispondere a sondaggi, consultare informazioni relative agli attori dell’ecosistema dell’innovazione dell’Emilia-Romagna, consultare proposte di collaborazione regionali e extraregionali, comunicare tramite chat con altri utenti iscritti, interagire con il Manager, i Mentor e gli Animatori della Piattaforma.
            ')
        ?>
    </p>

    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
                'Le funzionalità includono:
            ')
        ?>
    </p>
    <ul>
        <li>
            <?=
            Yii::t('amosapp',
                    'comunità di EROI: per condividere il proprio profilo personale, visionare i profili degli altri utenti verso i quali è possibile chiedere di entrare in contatto per successiva scambio diretto di messaggistica tramite chat;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'news: per condividere e diffondere in piattaforma informazioni su temi relativi all’innovazione (ad esempio: articoli, convegni, report, analisi, documenti, link ipertestuali, ecc);
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'ecosistema dell’innovazione: accesso e consultazione di liste (con relativi contatti) delle  organizzazioni dell’ecosistema dell’innovazione regionale;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'sondaggi: partecipazione su base volontaria a sondaggi promossi dalla Regione Emilia-Romagna e/o da ART-ER;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'sfide e soluzioni: ricerca di competenze, partnership, risorse necessarie per realizzare un progetto o un’attività di interesse per l’utente e proposte di soluzioni ad una sfida lanciata da un altro utente supportato da un Animatore (nominato dal Community Manager) assegnato a ciascuna sfida;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'gruppi: la possibilità di creare/partecipare a gruppi tematici e/o di lavoro e/o di progetto e/o di condivisione di interessi comuni; all’intero dei gruppi potranno essere lanciate discussioni per facilitare e veicolare il confronto tra gli utenti su specifici temi relativi all’innovazione; condividere documenti (ad esempio: documenti, immagini, video, link, ecc); inserire news di gruppo e lanciare sfide di di gruppo (la piattaforma permette quindi di rivolgere queste ultime limitatamente agli utenti iscritti che si aggregano nei gruppi; in precedenze è invece stata descritta una funzione news e sfide che coinvolgono tutti gli iscritti).
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'storie: per condividere casi di successo di collaborazioni in ottica di open innovation in corso di esecuzione o terminati;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'proposte di collaborazione EEN: consultare le proposte di collaborazione pubblicate della rete EEN verso gli utenti della piattaforma;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'entra in contatto con i Mentor di EROI: i mentor sono figure competenti in tema di innovazione, individuate da ART-ER proposte all’utente in fase di registrazione che ha quindi la possibilità di scegliere quello più corrispondente ai propri interessi e può essere sostituito a discrezione dell’utente; oltre a validare in prima istanza l’utente, ha anche il compito di supportarlo in caso di necessità (per consigli, suggerimenti, indicazioni) nelle diverse attività previste dalla piattaforma; ogni utente ha a disposizione un solo mentor;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'cerca un finanziamento: accedere al servizio di ART-ER denominato FIRST Finanziamenti per l’innovazione, la ricerca e lo sviluppo tecnologico; 
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'trova un modello di contratto: accedere a modelli contrattuali per regolamentare attività di ricerca e innovazione.
                ')
            ?>
        </li>
    </ul>
    <p class="m-t-20">
        <?=
        Yii::t('amosapp',
                'EROI è presidiato da un <strong>Community Manager</strong>, che agisce per facilitare tutti i processi della piattaforma, orientare i singoli utenti ad un utilizzo coerente con le sue finalità. Il Community Manager raccoglie e gestisce le segnalazioni, monitora l’andamento delle diverse attività, supporta le implementazioni di specifiche iniziative.
            ')
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Registrazione e cancellazione') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
                'La registrazione a EROI da parte dell’utente può avvenire in qualsiasi momento <span style="background-color: yellow;">dal momento del ricevimento della conferma di iscrizione in sede di primo inserimento.</span> Sarà cura dell’EROE aggiornare periodicamente il proprio profilo utente qualora intervengano variazioni o modifiche sostanziali.<br>
                In qualsiasi momento l’utente può effettuare la cancellazione del proprio profilo dalla piattaforma in autonomia utilizzando la specifica funzionale prevista “cancella utente” tra i comandi previsti dalla pagina personale e necessaria a questo scopo.<br>
                La Regione Emilia-Romagna/ART-ER si riserva comunque il diritto di: cancellare il profilo dell’utente in ogni momento, senza preavviso, nel caso di violazione degli obblighi previsti dai presenti Termini d’uso.
            ')
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Attori della Piattaforma - Accessi') ?></h2>
    <p class="m-b-20">
        <?=
        Yii::t('amosapp',
            "Partecipano a  EROI le seguenti tipologie di “Attori”, secondo quanto specificato nella seguente tabella: ")
        ?>
    </p>

    <table class="table table-responsive table-bordered table-termini-uso">
        <tbody>
            <tr>
                <td>
                    <p class="bold" style="text-align: center;"> Attore</p>
                </td>
                <td>
                    <p class="bold" style="text-align: center;">Descrizione profilo</p>
                </td>
                <td>
                    <p class="bold" style="text-align: center;">Modalità accesso</p>
                </td>
                <td>
                    <p class="bold" style="text-align: center;">Abilitazioni/ruolo</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>EROE (utente)</p>
                </td>
                <td>
                    <p>Iscritto registrato interessato
                    a condividere in modo libero, educato e proattivo la propria passione per
                    l’innovazione
                    </p>
                </td>
                <td>
                    <p>Login con
                    username e password definiti in sede di registrazione
                    </p>
                </td>
                <td>
                    <p>Utilizzare
                        tutte le funzionalità della piattaforma.</p>
                    <p>In
                        particolare l’EROE può:</p>
                    <ul style='list-style-type: "-  ";'>
                        <li>pubblicare un profilo personale</li>
                        <li>postare notizie</li>
                        <li>condividere materiali nella
                        forma di allegati</li>
                        <li>- aprire specifiche discussioni
                        tematiche e commentare discussioni aperte da altri utenti iscritti</li>
                        <li>attivare o partecipare a gruppi
                        tematici</li>
                        <li>lanciare sfide di innovazione
                        che rientrino nello scopo di precise iniziative o rispondere con proprie
                        soluzioni a sfide di innovazione lanciate da altri utenti iscritti</li>
                        <li>rispondere a sondaggi</li>
                        <li>consultare informazioni relative
                        agli attori dell’ecosistema dell’innovazione
                        dell’Emilia-Romagna</li>
                        <li>consultare proposte di
                        collaborazione regionali e extraregionali</li>
                        <li>comunicare tramite chat con
                        altri utenti iscritti</li>
                        <li>interagire con il Manager, i
                        Mentor e gli Animatori della Piattaforma.</li>
                    </ul>
                    
                </td>
            </tr>
            <tr>
                <td>
                    <p>MENTOR</p>
                </td>
                <td>
                    <p>Nominato da
                    Emilia-Romagna/ART-ER segue l’EROE nelle attività che
                    deciderà di svolgere sulla piattaforma.</p>
                </td>
                <td>
                    <p>Login con
                    username e password forniti in sede di registrazione</p>
                </td>
                <td>
                    <p>Il Mentor viene abilitato al ruolo di Mentor
                    dall’Amministratore di sistema su indicazione del Community Manager.</p>
                    <p>Il Mentor
                    valida il profilo dell’EROE, verifica ed approva i contenuti pubblicati
                    dall’EROE nelle varie funzionalità con la sola eccezione della
                    funzionalità Sfide, consiglia e guida l’EROE nell’utilizzo
                    della Piattaforma.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>ANIMATORE</p>
                </td>
                <td>
                    <p>Nominato
                    dal Community Manager guida gli Eroi nella ricerca delle migliori soluzioni
                    alle loro sfide di innovazione</p>
                </td>
                <td>
                    <p>Login con
                    username e password forniti in sede di registrazione</p>
                </td>
                <td>
                    <p>L’Animatore viene abilitato al ruolo di Animatore
                    dall’Amministratore di sistema su indicazione del Community Manager.</p>
                    <p>L’Animatore valida il contenuto delle sfide pubblicati
                    dall’EROE, consiglia e guida l’EROE nella redazione della sfida,
                    promuove la sfida verso potenziali solutori, visualizza le soluzioni
                    candidate alla sfida da parte di altri utenti iscritti.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>COMMUNITY
                    MANAGER</p>
                </td>
                <td>
                    <p>Supervisiona
                    tutte le attività della Piattaforma, anima la community, promuove le
                    opportunità di EROI ed è riferimento per gli utenti iscritti in
                    caso di necessità.</p>
                </td>
                <td>
                    <p>Login con
                    username e password forniti in sede di registrazione</p>
                </td>
                <td>
                    <p>Il Community
                    Manager viene abilitato al ruolo di Community Manager dall'Amministratore di
                    sistema su indicazione di ART-ER, soggetto gestore della Piattaforma.</p>
                    <p>Il Community
                    Manager agisce per facilitare tutti i processi della piattaforma, orientare i
                    singoli utenti all’utilizzo corretto di EROI, presidia
                    l’orientamento delle varie attività verso la mission di EROI,
                    raccoglie e gestisce le segnalazioni, monitora l’andamento delle
                    diverse attività, supporta le implementazioni di specifiche
                    iniziative.</p>
                    <p>Il Community
                    Manager inoltre è anche Mentor e Animatore della Piattaforma e svolge
                    le funzioni a questi assegnate.</p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>AMMINISTRATORE
                    DI SISTEMA</p>
                </td>
                <td>
                    <p>Si occupa
                    della gestione, manutenzione e sviluppo tecnico della Piattaforma.</p>
                </td>
                <td>
                    <p>Login con username e password di sistema</p>
                </td>
                <td>
                    <p>L’Amministratore
                    di sistema viene abilitato a svolgere la funzione di Amministratore di
                    sistema da ART-ER, soggetto gestore della Piattaforma.</p>
                    <p>L’Amministratore
                    di sistema ha accesso a tutti i contenuti presenti in Piattaforma e gestisce
                    il database utenti.</p>
                    <p>L’Amministratore
                    di sistema si occupa della gestione tecnica della Piattaforma, intervenendo
                    su eventuali malfunzionamenti e occupandosi di interventi migliorativi dello
                    strumento (sviluppi).</p>
                    <p>L’Amministratore
                    di sistema può svolgere anche le funzioni assegnate a tutte le
                    tipologie di attori della Piattaforma.</p>
                </td>
            </tr>
        </tbody>
    </table>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Utilizzo della piattaforma – impegni e obblighi') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "L'utente si obbliga ad utilizzare le funzionalità di EROI solo coerentemente alle finalità e agli obiettivi indicati in piattaforma e nei presenti termini d’uso.")
        ?>
    </p>
    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
            "L’utente manterrà i propri diritti su contenuti e informazioni di cui sia autore e che sono condivise, postate e rese disponibili su EROI.")
        ?>
    </p>
    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
            "L’utente accetta che i contenuti e le informazioni di cui sia autore e che egli rende disponibili su EROI  possano essere condivisi, distribuiti o pubblicati dagli altri Attori di EROI (senza alcuna pretesa aggiuntiva incluso il pagamento di un eventuale corrispettivo all’utente).")
        ?>
    </p>
    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
            "L’utente è unico responsabile dell’utilizzo, distribuzione, divulgazione, trasmissione, delle informazioni e dei contenuti - propri o di terzi - forniti e di ogni conseguenza che ne possa derivare.")
        ?>
    </p>
    <p class="m-t-20">
        <?=
        Yii::t('amosapp',
                'Nell’utilizzo delle funzionalità di EROI l\'utente si obbliga a non:
            ')
        ?>
    </p>
    <ul>
        <li>
            <?=
            Yii::t('amosapp',
                    'diffamare, abusare, molestare, seminare panico, minacciare o altrimenti violare diritti altrui tutelati dalla legge (come ad esempio il diritto relativo alla protezione dei dati personali ed alla pubblicità);
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'pubblicare, inviare, caricare, distribuire o diffondere qualsiasi argomento, nome, materiale o informazione inappropriata, blasfema, calunniosa, trasgressiva, oscena, indecente o illegale;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'caricare o rendere disponibili file che contengano software o altro materiale protetto dalla normativa sulla proprietà intellettuale (o diritti relativi alla protezione dei dati personali o alla pubblicità) a meno che l\'utente non sia titolare di tali diritti o abbia ricevuto tutte le necessarie autorizzazioni;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'caricare file che contengano virus, cavalli di troia, worm, file danneggiati, o qualsiasi altro programma o software simile che potrebbe ledere le operazioni o il funzionamento di altri computer;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'sfide e soluzioni: ricerca di competenze, partnership, risorse necessarie per realizzare un progetto o un’attività di interesse per l’utente e proposte di soluzioni ad una sfida lanciata da un altro utente supportato da un Animatore (nominato dal Community Manager) assegnato a ciascuna sfida;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'pubblicizzare o offrire in vendita o acquistare merci o servizi per scopi commerciali;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'trasmettere o inoltrare rapporti, contestazioni, progetti a piramide o catene di lettere;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'scaricare files inviati da un altro utente che l\'utente conosce o che ragionevolmente dovrebbe conoscere, che non è possibile riprodurre, visualizzare, eseguire e/o distribuire legalmente secondo tali modalità;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'falsificare o cancellare informazioni relative alla gestione del copyright, quali il nome di un autore, avvertenze particolari o legali o designazioni di proprietà o etichette di origine o la fonte dei software o di altro materiale contenuto in un file che è stato caricato;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'limitare o impedire ad altri utenti l\'uso delle funzionalità di EROI;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'raccogliere o riunire informazioni su altri utenti, inclusi gli indirizzi di posta elettronica, senza il consenso degli stessi;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'violare qualsivoglia codice di condotta o altre linee guida che possano essere applicabili;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'creare una falsa identità nell\'intento di trarre in inganno altri utenti;
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'violare qualsiasi legge o regolamento.
                ')
            ?>
        </li>
    </ul>

    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
            "La Regione Emilia-Romagna ed ART-ER non si assumono alcuna responsabilità per l'utilizzo di contenuti, messaggi, informazioni disponibili in EROI per le eventuali azioni risultanti dalla partecipazione dell'utente alla piattaforma.")
        ?>
    </p>

    <p class="m-t-20">
        <?=
        Yii::t('amosapp',
                'La Regione Emilia-Romagna ed ART-ER si riservano comunque il diritto di:
            ')
        ?>
    </p>
    <ul>
        <li>
            <?=
            Yii::t('amosapp',
                    'rivedere le informazioni e i materiali pubblicati e di rimuoverli, integralmente o parzialmente, a sua esclusiva e insindacabile discrezione
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'interrompere l\'accesso dell\'utente ad uno o a tutte le funzionalità di EROI in ogni momento, senza preavviso e per qualsiasi ragione
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'cancellare il profilo dell’utente in ogni momento, senza preavviso, nel caso di violazione degli obblighi previsti dai presenti Termini d’uso
                ')
            ?>
        </li>
        <li>
            <?=
            Yii::t('amosapp',
                    'divulgare in qualsiasi momento qualsivoglia informazione ritenuta necessaria per soddisfare le leggi, le norme ed i regolamenti applicabili.
                ')
            ?>
        </li>
    </ul>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Interruzione di accesso') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "La Regione Emilia-Romagna ed ART-ER si riservano il diritto, a loro esclusiva e insindacabile discrezione, in qualsiasi momento e senza preavviso, di concludere le attività della piattaforma e conseguentemente di interrompere l'accesso dell'utente o di terzi al Sito e alle relative funzionalità.<br>
            L’accesso e l’utilizzo dello strumento potranno essere sospesi o interrotti anche in caso di congestione e/o sovraccarico del sistema, nonché, al fine di garantire gli interventi di manutenzione ordinaria e straordinaria, a esclusiva discrezione di Regione Emilia-Romagna e di ART-ER senza che ciò comporti alcuna responsabilità di Regione Emilia-Romagna e di ART-ER che non garantiscono in alcun modo la ininterrotta funzionalità dello strumento.<br>
            Regione Emilia-Romagna ed ART-ER non rispondono pertanto di ritardi, cattivo funzionamento, sospensione e/o interruzione nell’erogazione del servizio dello strumento causati da forza maggiore o caso fortuito.
            ")
        ?>
    </p>
    <h2 class="bold"><?= Yii::t('amosapp', 'Responsabilità') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "EROI non da’ luogo ad alcuna forma di consulenza o raccomandazione e non ha l'intenzione di indurre gli utenti a prendere o ad astenersi dal prendere decisioni di qualsiasi natura (incluse decisioni a carattere finanziario o legale).<br>
            La Regione Emilia-Romagna/ART-ER non potrà in alcun modo essere ritenuta responsabile, né direttamente né indirettamente, per qualsiasi atto intrapreso sulla base di tali informazioni, consigli, avvisi o notizie, o per qualsiasi perdita o danno ad altri intervenuto come risultato dell'avere intrapreso tale azione.")
        ?>
    </p>
    <p class="m-t-20 m-b-20">
        <?=
        Yii::t('amosapp',
            "In nessuna circostanza, la Regione Emilia-Romagna/ART-ER ed i suoi fornitori potranno essere ritenuti responsabili per qualsiasi danno diretto, indiretto, incidentale, consequenziale, derivante dall'uso o in relazione all'uso del presente sito web o di altri siti web ad esso collegati da un link ipertesto, ivi compresi senza alcuna limitazione, i danni quali la perdita di profitti o fatturato, l'interruzione di attività aziendale o professionale, la perdita di programmi o altro tipo di dati ubicati sul sistema informatico dell'utente o altro sistema, e ciò anche qualora la Società fosse stato espressamente messo al corrente della possibilità del verificarsi di tali danni.")
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Manleva') ?></h2>
    <p>
        <?=
        Yii::t('amosapp',
            "Ciascun utente registrato si impegna a tenere indenne e manlevare a prima richiesta, rimossa ogni possibilità di sollevare eccezioni, la Regione Emilia-Romagna/ART-ER e i suoi soci, amministratori, dipendenti, collaboratori e consulenti, in relazione a qualsiasi azione, pretesa di risarcimento, passività, danno, costo o spesa, domanda, giudizio, decisione che possa essere da chiunque richiesto, sostenuto, avanzato o minacciato contro gli stessi in relazione alla violazione delle disposizioni di cui ai presenti Termini, all’accesso al Portale EROI e al servizio ed alla pubblicazione e diffusione del materiale da parte degli utenti o su richiesta degli stessi o, comunque, all’utilizzo di EROI.")
        ?>
    </p>

    <br>
    <h2 class="bold"><?= Yii::t('amosapp', 'Modifiche dei termini e delle condizioni di utilizzo') ?></h2>
    <p>
        <?= Yii::t('amosapp', "La Regione Emilia-Romagna/ART-ER si riserva il diritto di modificare, a suo esclusivo e insindacabile giudizio, in qualsiasi momento e senza alcun preavviso, i termini e le condizioni di utilizzo ai sensi dei quali vengono offerti i servizi e le informazioni contenute nel Sito. È interamente a carico dell'utente la responsabilità del controllo costante di detti termini e condizioni. L'utilizzo del Sito e dei relativi servizi, successivo alle intervenute modifiche, comporta l'assenso dell'utente alle stesse.") ?>
    </p>

</section>