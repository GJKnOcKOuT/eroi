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

use arter\amos\core\behaviors\BlameableBehavior;
use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\tag\models\EntitysTagsMm;
use arter\amos\tag\models\Tag;
use yii\db\ActiveQuery;
use yii\db\Migration;

/**
 * Class m181030_094355_populate_tematiche_smart_specialization_strategy_tree
 */
class m181030_094355_populate_tematiche_smart_specialization_strategy_tree extends Migration
{
    /**
     * @var string $rootTagName
     */
    private $rootTagName = 'Tematiche Smart Specialization Strategy';

    /**
     * @var array $tags
     */
    private $tags = [
        'Agroalimentare' => [
            'Agricoltura Resiliente',
            'Gestione di precisione',
            'IoT e Big data nei processi produttivi',
            'Sicurezza, qualità e durabilità',
            'Innovazione nei processi, impianti e materiali',
            'Sicurezza e tracciabilità alimentare',
            'Digitalizzazione dei processi alimentari',
            'Valorizzazione scarti e dei sottoprodotti',
            'Valorizzazione dei sottoprodotti e sviluppo di bioraffinerie',
            'Valorizzazione di sottoprodotti e scarti in prodotti energetici e biometano'
        ],
        'Edilizia e Costruzioni' => [
            'Migliorare le prestazioni del patrimonio costruito',
            'Manutenzione per conservazione e recupero',
            'Building Information Modeling (BIM)',
            'Nuovi materiali e componenti a basso impatto',
            'Edifici decarbonizzati e reti efficienti',
            'Resilienza degli edifici e rigenerazione urbana',
            'Sicurezza del patrimonio esistente',
            'Tecnologie innovative per edilizia industrializzata',
            'Sicurezza, resilienza delle reti infrastrutturali'
        ],
        'Energia e Sviluppo Sostenibile' => [
            'Biometano e altri biocombustibili',
            'Smart Energy Systems',
            'Efficienza energetica e soluzioni low carbon per l’industria',
            'Sviluppo sostenibile delle aree costiere',
            'Impatti antropici sulla qualità dell’aria e i cambiamenti climatici',
            'Economia circolare e sviluppo sostenibile'
        ],
        'Industrie Culturali e Creative' => [
            'Archivi della moda, per dare valore alle aziende ed al territorio',
            'Una moda smart, personalizzata e funzionalizzata',
            'Filiere Fashion 4.0',
            'Diagnosi, conservazione, preservazione del patrimonio tangibile',
            "Fruizione di patrimoni e archivi attraverso l'Intelligenza artìficiale",
            'Nuovi modelli per gestione di musei, archivi e cultural heritage',
            'Personalizzazione di prodotto e shelf innovation',
            'Tecnologie, culture, creatività, design per Made in Italy',
            'Realtà immersiva, realtà aumentata, gamification per eventi e spettacoli',
            'Tecnologie abilitanti in percorsi di inclusione didattica e formativa',
            'Filiera, piattaforme multicanale e open data per il turismo',
            'Riattivazione urbana e “co-generazione”'
        ],
        'Industrie della Salute e del Benessere' => [
            'Integrazione KETs nell’ambito del MedTech',
            'Integrazione con tecnologie meccatronica/robotica',
            'Dispositivi biomedicali innovativi e smart',
            'Prodotti medicinali per terapie avanzate, medicina personalizzata e di precisione',
            'Terapie e strumenti per il “self-repair”',
            'Nuovi approcci terapeutici e diagnostici per medicina personalizzata',
            'Nuovi approcci farmaceutici per farmaco-resistenza',
            'Nuovi sistemi per la produzione industriale di medicinali e dispositivi',
            'Salute e benessere psicofisico di diverse generazioni',
            'Innovazione tecnologica al servizio della deospedalizzazione',
            'Efficacia, produttività, inclusività dei servizi socio-sanitari'
        ],
        'Innovazione nei Servizi' => [
            'Servizi Scalabili e Intelligenti per Scenari Smart Cities',
            'IoT e Cybersecurity',
            'Servizi Innovativi e Big Data per Scenari Smart Industry 4.2',
            'Servizi IT smart per le PMI',
            'E-commerce and last mile delivery in city center',
            'Tecnologie dirompenti per la logistica delle merci',
            'AI e Machine Learning per industria 4.0',
            'Piattaforme abilitanti di servizi intelligenti per le aziende ICT',
            'Utilizzi cross-industry della tecnologia blockchain'
        ],
        'Meccatronica e Motoristica' => [
            'Applicazioni digitali nel manufatturiero',
            'Tecnologie additive e innovative sostenibili',
            'Automazione di Nuova Generazione',
            'Robotica mobile e collaborativa',
            'Veicoli autonomi e connessi, mobilità intelligente',
            'Elettrificazione dei sistemi di propulsione',
            'Rivestimenti e trattamenti superficiali innovativi',
            'Materiali innovativi per manifattura avanzata',
            'Micro/mini piattaforme aeree e applicazioni per il monitoraggio ambientale',
            "Micro/mini piattaforme satellitari per l'osservazione della Terra",
            'Produzione rapida sostenibile',
            'Propulsione navale mediante gas naturale',
            "Soluzioni ibride per l'efficienza dei sistemi oleodinamici",
            'Fluidi eco-friendly per trasmissione di potenza'
        ]
    ];

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $rootTag = Tag::findOne(['nome' => $this->rootTagName]);
        if (is_null($rootTag)) {
            $rootTag = $this->createTag($this->rootTagName);
        }

        foreach ($this->tags as $firstLevelTagName => $tagNames) {
            $firstLevelTagsFound = Tag::find()->andWhere(['nome' => $firstLevelTagName])->andWhere(['root' => $rootTag->root])->all();
            $firstLevelTag = null;
            if (count($firstLevelTagsFound) == 1) {
                $firstLevelTag = array_pop($firstLevelTagsFound);
            } elseif (count($firstLevelTagsFound) > 1) {
                foreach ($firstLevelTagsFound as $firstLevelTagFound) {
                    if ($firstLevelTagFound->root == $rootTag->root) {
                        $firstLevelTag = $firstLevelTagFound;
                    }
                }
            }

            if (is_null($firstLevelTag)) {
                $firstLevelTag = $this->createTag($firstLevelTagName, $rootTag);
            }

            $newTags = [];
            foreach ($tagNames as $tagName) {
                $tag = $this->createTag($tagName, $firstLevelTag);
                if (is_null($tag)) {
                    MigrationCommon::printConsoleMessage('Errore nella creazione del tag secondo livello ' . $tagName);
                    return false;
                }
                $newTags[$tag->id] = $tag;
            }

            /** @var ActiveQuery $query */
            $query = EntitysTagsMm::find();
            $query->andWhere(['tag_id' => $firstLevelTag->id]);
            $firstLevelTagEntityTagMms = $query->all();
            foreach ($firstLevelTagEntityTagMms as $firstLevelTagEntityTagMm) {
                /** @var EntitysTagsMm $firstLevelTagEntityTagMm */
                foreach ($newTags as $newTag) {
                    /** @var Tag $newTag */
                    $entityTagMm = new EntitysTagsMm();
                    $entityTagMm->detachBehaviorByClassName(BlameableBehavior::className());
                    $entityTagMm->classname = $firstLevelTagEntityTagMm->classname;
                    $entityTagMm->record_id = $firstLevelTagEntityTagMm->record_id;
                    $entityTagMm->tag_id = $newTag->id;
                    $entityTagMm->root_id = $newTag->root;
                    $entityTagMm->created_by = $firstLevelTagEntityTagMm->created_by;
                    $entityTagMm->updated_by = $firstLevelTagEntityTagMm->updated_by;
                    $ok = $entityTagMm->save();
                    if (!$ok) {
                        MigrationCommon::printConsoleMessage("Errore nell'associazione del tag di secondo livello con l'entità");
                        return false;
                    }
                }
                $firstLevelTagEntityTagMm->delete();
                if ($firstLevelTagEntityTagMm->hasErrors()) {
                    MigrationCommon::printConsoleMessage("Errore nella cancellazione dell'associazione del vecchio tag di secondo livello con l'entità");
                    return false;
                }
            }
        }

        MigrationCommon::printConsoleMessage('Tag creati e associati correttamente');

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
        echo "m181030_094355_populate_tematiche_smart_specialization_strategy_tree cannot be reverted.\n";

        return false;
    }
}
