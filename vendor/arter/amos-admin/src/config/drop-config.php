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
 * @package    arter\amos\admin\config
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

return [
    'models' => [
        'arter\amos\documenti\models\Documenti' => [
            'titolo',
            'sottotitolo',
            'descrizione_breve',
            'descrizione'
        ],
        'arter\amos\discussioni\models\DiscussioniTopic' => [
            'titolo',
            'testo',
        ],
        'arter\amos\discussioni\models\DiscussioniCommenti' => [
            'titolo',
            'testo',
        ],
        'arter\amos\news\models\News' => [
            'titolo',
            'sottotitolo',
            'descrizione',
            'descrizione_breve',
        ],
        'arter\amos\comments\models\Comment' => [
            'comment_text',
        ],
        'arter\amos\comments\models\CommentReply' => [
            'comment_reply_text',
        ],
        'arter\amos\projectmanagement\models\Projects' => [
            'name',
            'summary',
        ],
        'arter\amos\events\models\Event' => [
            'status',
            'title',
            'summary',
            'description',
        ],
        'arter\amos\partnershipprofiles\models\PartnershipProfiles' => [
            'title',
            'short_description',
            'extended_description',
            'advantages_innovative_aspects',
            'other_prospect_desired_collab',
            'expected_contribution',
            'contact_person',
            'english_title',
            'english_short_description',
            'english_extended_description',
            'other_work_language',
            'other_development_stage',
            'other_intellectual_property',
        ],
        'arter\amos\partnershipprofiles\models\ExpressionsOfInterest' => [
            'status',
            'partnership_offered',
            'additional_information',
            'clarifications',
            'user_network_reference_classname',
        ],
        'amos\results\models\Result' => [
            'title',
            'summary',
            'project_proposal',
            'initiative_text',
            'website',
            'innovation_description',
            'insights'
        ],
        'amos\results\models\ResultProposal' => [
            'title',
            'summary',
            'project_proposal',
            'initiative_text',
            'website',
        ],
        'arter\amos\sondaggi\models\Sondaggi' => [
            'titolo',
            'descrizione'
        ],
        'arter\amos\sondaggi\models\SondaggiDomande' => [
            'domanda'
        ],
        'arter\amos\sondaggi\models\SondaggiRisposte' => [
            'risposta_libera'
        ],
        'arter\amos\organizzazioni\models\Profilo' => [
            'name',
            'presentazione_della_organizzaz',
            'principali_ambiti_di_attivita_',
            'ambiti_tecnologici_su_cui_siet',
            'tipologia_di_organizzazione',
            'forma_legale',
            'sito_web',
            'indirizzo',
            'la_sede_legale_e_la_stessa_del',
            'sede_legale_indirizzo',
            'responsabile',
            'rappresentante_legale',
            'referente_operativo',
        ],
        'arter\amos\showcaseprojects\models\ShowcaseProject' => [
            'title',
            'summary',
            'insights',
        ],
        'arter\amos\showcaseprojects\models\ShowcaseProjectProposal' => [
            'title',
            'summary',
        ],
        'arter\amos\een\models\EenPartnershipProposal' => [
            'company_certifications_list',
            'company_experience',
            'company_languages_list',
            'contact_email',
            'contact_fullname',
            'contact_organization',
            'content_description',
            'content_summary',
            'content_title',
            'cooperation_exploitation_list',
            'cooperation_ipr_comment',
            'cooperation_ipr_status',
            'cooperation_partner_area',
            'cooperation_partner_sought',
            'cooperation_partner_task',
            'cooperation_plusvalue',
            'cooperation_stagedev_comment',
            'cooperation_stagedev_stage',
            'reference_external',
            'reference_internal',
            'tags_not_found',
        ],
        'arter\amos\proposte_collaborazione\models\ProposteDiCollaborazione' => [
            'titolo',
            'persona_di_riferimento_e_conta',
            'tipo_di_collaborazione_prospet',
            'altro_tipo_di_collaborazione_p',
            'titolo_inglese',
            'descrizione_sintetica_inglese',
            'descrizione_estesa_inglese',
            'altra_lingua_di_lavoro',
            'altro_stadio_di_sviluppo_dei_c',
            'altra_proprieta_intellettuale_'
        ],
        'arter\amos\proposte_collaborazione\models\ManifestazioniInteresse' => [
            'contributo_offerto',
            'informazioni_aggiuntive',
            'chiarimenti'
        ],
    ]
];
