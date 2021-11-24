<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\tag\models\Tag;
use yii\db\Migration;

/**
 * Class m181001_141113_add_rete_alta_tecnologia_tree
 */
class m181001_141113_add_rete_alta_tecnologia_tree extends Migration
{
    /**
     * @var array $tags
     */
    private $tags = [
        'Meccanica - materiali' => [
            'Progettazione e sviluppo di nuovi prodotti/processi',
            'Processi di lavorazione',
            'Manutenzione e diagnostica',
            'Materiali',
            'Rumore, Vibrazioni, Dinamica, NVH',
            'Termofluidodinamica',
            'Modellazione di sistemi fisici e simulazione',
            'Automazione: attuatori e robotica',
            'Sensori'
        ],
        'Scienze della vita' => [
            'Biosensori',
            'Dispositivi e protesi',
            'Drug delivery',
            'Drug discovery',
            'e-Care',
            'Omics',
            'Personal Health System',
            'Studi preclinici',
            'Scaffold',
            'Strumentazione biomedica per terapia e diagnosi',
            'Terapie avanzate'
        ],
        'Agroalimentare' => [
            'Nuovi metodi per la qualità e sicurezza degli alimenti',
            'Alimenti funzionali, nutrizione e salute',
            'Qualità e tipicità degli alimenti',
            'Microbiologia degli alimenti e microrganismi di interesse industriale',
            'Macchine e impianti',
            'Ottimizzazione e innovazione di processo/prodotto',
            "Valorizzazione dei sottoprodotti dell'industria agroalimentare",
            'Qualità delle materie prime',
            'Packaging',
            'Tracciabilità molecolare e sistemi per la rintracciabilità'
        ],
        'Costruzioni' => [
            "Materiali e componenti per l'edilizia ad elevate prestazioni",
            'Nuova edilizia ad elevate prestazioni (strutturale)',
            'Recupero del costruito',
            'Restauro dei beni culturali',
            'Materiali ceramici tradizionali, avanzati, funzionalizzati e/o a ridotto impatto ambientale',
            'Monitoraggio e valorizzazione di aree a rischio/interesse archeologico e paleontologico',
            'Progettazione museale ed exhibition design',
            'Diagnostica e conservazione (diagnosi, monitoraggio, fruizione) dei beni culturali',
            'Materiali e componenti per le fonti rinnovabili solari',
            'Infrastrutture Civili ed Edili (anche per fonti rinnovabili idriche e geotermiche)',
            'Valorizzazione dei beni culturali e delle forme espositive'
        ],
        'ICT e design' => [
            'Dispositivi e Componenti Elettronici',
            'Green IT',
            'Sistemi Embedded',
            'Internet delle cose e Sistemi Cyber-Fisici',
            'Automazione, Controllo  e Robotica',
            'Tecnologie per la guida autonoma',
            'Sistemi di comunicazione e reti',
            'Super Calcolo',
            'Cloud computing',
            'Middleware, Mobile e Sistemi Pervasivi',
            'Sicurezza e Privacy',
            'Computer Vision e Visual Computing',
            'Multimedia e interfacce uomo-macchina',
            'Ingegneria del software',
            'Intelligenza artificiale e ottimizzazione',
            "Sistemi semantici e dell'informazione, Gestione della conoscenza",
            'Big Data'
        ],
        'Energia - Ambiente' => [
            'Simbiosi industriale: uso, riuso, valorizzazione e sostituzione di materia',
            'Biotecnologie per la produzione di chemicals, materia ed energia',
            'Energie sostenibili: tecnologie e sistemi di produzione',
            'Efficienza energetica',
            'Strumenti e metodi per la sostenibilità',
            'Ecosystem services (Servizi ecosistemici)',
            'Tecnologie per la gestione della risorsa idrica',
            'Mobilità sostenibile'
        ]
    ];

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $rootTag = Tag::findOne(['nome' => 'Rete Alta Tecnologia']);
        if (is_null($rootTag)) {
            $rootTag = $this->createTag('Rete Alta Tecnologia');
        }

        foreach ($this->tags as $firstLevelName => $tagNames) {

            $firstLevelTag = $this->createTag($firstLevelName, $rootTag);
            if (is_null($firstLevelTag)) {
                MigrationCommon::printConsoleMessage('Errore nella creazione del tag primo livello ' . $firstLevelName);
                return false;
            }

            foreach ($tagNames as $tagName) {
                $tag = $this->createTag($tagName, $firstLevelTag);
                if (is_null($tag)) {
                    MigrationCommon::printConsoleMessage('Errore nella creazione del tag secondo livello ' . $tagName);
                    return false;
                }
            }
        }

        MigrationCommon::printConsoleMessage('Tag creati correttamente');

        return true;
    }

    /**
     * @param string $nome
     * @param Tag|null $parent
     * @return Tag|null
     */
    private function createTag($nome, $parent = null)
    {
        $node = new Tag();
        $node->nome = $nome;
        $node->codice = '';
        $node->descrizione = '';
        $node->icon = '';
        $node->icon_type = 1;
        $node->active = 1;
        $node->activeOrig = $node->active;
        $node->selected = 0;
        $node->disabled = 0;
        $node->readonly = 0;
        $node->visible = 1;
        $node->collapsed = 0;
        $node->movable_u = 1;
        $node->movable_d = 1;
        $node->movable_l = 1;
        $node->movable_r = 1;
        $node->removable = 1;
        $node->removable_all = 0;

        if (!is_null($parent)) {
            $node->appendTo($parent);
        } else {
            $node->makeRoot();
        }

        if (!$node->save()) {
            return null;
        }

        return $node;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180904_084129_add_cl_roles_tags cannot be reverted.\n";

        return false;
    }
}
