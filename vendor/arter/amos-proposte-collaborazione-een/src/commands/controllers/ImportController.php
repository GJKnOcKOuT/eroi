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
 * @package    arter-proposte-collaborazione-een
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\commands\controllers;

use arter\amos\attachments\components\FileImport;
use arter\amos\attachments\models\File;
use arter\amos\cwh\models\CwhPubblicazioni;
use arter\amos\een\commands\models\CollaborationProposalEen;
use arter\amos\een\models\EenPartnershipProposal;
use arter\amos\een\utility\EenMailUtility;
use arter\amos\tag\models\EntitysTagsMm;
use yii\console\Controller;
use yii\console\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use yii\helpers\Json;
use arter\amos\cwh\models\CwhConfigContents;

/**
 * Class ImportController
 * @package arter\amos\een\commands\controllers
 */
class ImportController extends Controller
{
    public $tempPath;
    public $ContractId;
    public $CountriesForDissemination;
    public $DeadlineDateAfter;
    public $DeadlineDateBefore;
    public $IncludeImages;
    public $OrganisationCountryName;
    public $OrganisationIdentifier;
    public $OrganisationName;
    public $ProfileTypes;
    public $PublishedDateAfter;
    public $PublishedDateBefore;
    public $SubmitDateAfter;
    public $SubmitDateBefore;
    public $UpdateDateAfter;
    public $UpdateDateBefore;
    public $passedOptions          = [
        'ContractId',
        'CountriesForDissemination',
        'DeadlineDateAfter',
        'DeadlineDateBefore',
        'IncludeImages',
        'OrganisationCountryName',
        'OrganisationIdentifier',
        'OrganisationName',
        'ProfileTypes',
        'PublishedDateAfter',
        'PublishedDateBefore',
        'SubmitDateAfter',
        'SubmitDateBefore',
        'UpdateDateAfter',
        'UpdateDateBefore',
    ];
    public $passedOptionsExplained = [
        'ContractId' => 'with Contract Id {value}',
        'CountriesForDissemination' => 'for the following countries {value}',
        'DeadlineDateAfter' => 'which expires after {value}',
        'DeadlineDateBefore' => 'which expires before {value}',
        'IncludeImages' => 'with attachments',
        'OrganisationCountryName' => 'published by an organization that resides in {value}',
        'OrganisationIdentifier' => 'published by (identifier) {value}',
        'OrganisationName' => 'published by (name) {value}',
        'ProfileTypes' => 'of these types {value}',
        'PublishedDateAfter' => 'published after {value}',
        'PublishedDateBefore' => 'published before {value}',
        'SubmitDateAfter' => 'submitted after {value}',
        'SubmitDateBefore' => 'submitted before {value}',
        'UpdateDateAfter' => 'updated after {value}',
        'UpdateDateBefore' => 'updated before {value}',
    ];

    public function options($actionID)
    {
        return ArrayHelper::merge(parent::options($actionID), $this->passedOptions);
    }

    /**
     * Import EEN Profile request proposal from http://een.ec.europa.eu
     *
     *
     * ```
     * php yii een/import/start --UpdateDateAfter="2020-11-01" --UpdateDateBefore="2020-11-05" --ProfileTypes="Tr,To,Br,Rdr" --IncludeImages=1
     * ```
     *
     * @throws Exception if the name argument is invalid or nothin passed
     */
    public function actionStart()
    {
        ini_set('memory_limit', '4096M');
        ini_set('soap.wsdl_cache_enabled', '0');
        ini_set('soap.wsdl_cache_ttl', '0');

        //ini_set("memory_limit","2G");

        if (!count($this->getPassedOptionValues())) {
            throw new Exception('No arguments passed');
        }

        $moduleEen  = \Yii::$app->getModule(\arter\amos\een\AmosEen::getModuleName());
        $conversion = $moduleEen->enableConversionTag;

        $this->ProfileTypes              = $this->normalizeArray($this->ProfileTypes);
        $this->CountriesForDissemination = $this->normalizeArray($this->CountriesForDissemination);

        $this->DeadlineDateAfter   = $this->normalizeDate($this->DeadlineDateAfter);
        $this->DeadlineDateBefore  = $this->normalizeDate($this->DeadlineDateBefore);
        $this->PublishedDateAfter  = $this->normalizeDate($this->PublishedDateAfter);
        $this->PublishedDateBefore = $this->normalizeDate($this->PublishedDateBefore);
        $this->SubmitDateAfter     = $this->normalizeDate($this->SubmitDateAfter);
        $this->SubmitDateBefore    = $this->normalizeDate($this->SubmitDateBefore);
        $this->UpdateDateAfter     = $this->normalizeDate($this->UpdateDateAfter);
        $this->UpdateDateBefore    = $this->normalizeDate($this->UpdateDateBefore);

        $this->IncludeImages = $this->normalizeBoolean($this->IncludeImages);

        $this->OrganisationCountryName = $this->normalizeString($this->OrganisationCountryName);
        $this->OrganisationIdentifier  = $this->normalizeString($this->OrganisationIdentifier);
        $this->OrganisationName        = $this->normalizeString($this->OrganisationName);

        $this->explainRequest();

        $Proposte = CollaborationProposalEen::findAll($this->getPassedOptionValues());
        $notify=0;

        $proposteCount = count($Proposte);
        if ($proposteCount) {

            $list_tags_not_found = false;

            foreach ((array) $Proposte->profile as $k => $profile) {

                $proposta = EenPartnershipProposal::findOne(['reference_external' => $profile->reference->external]);

                $PodProfile = new CollaborationProposalEen([
                    'podXml' => $profile
                ]);

                if (!$proposta) {
                    Console::stdout("NUOVA PROPOSTA {$profile->reference->external} \n\r");
                    $proposta = new EenPartnershipProposal();
                } else {
                    Console::stdout(@$profile->reference->external."\n\r");
                    Console::stdout("AGGIORNO LA PROPOSTA {$profile->reference->external} \n\r");
                    Console::stdout("CANCELLO I FILE DI {$profile->reference->external} \n\r");
                    File::deleteAll([
                        'attribute' => 'attachments',
                        'model' => EenPartnershipProposal::className(),
                        'itemId' => $proposta['id'],
                    ]);
                }

                $proposta->detachBehavior('fileBehavior');

                $proposta->setAttributes($PodProfile->toArray());

                $proposta->detachBehavior('cwhBehavior');
                $proposta->save(false);

                $attachments = $PodProfile->getAttachments();

                $attachmentsCount = count($attachments);

                if ($attachmentsCount) {
                    Console::stdout("SALVO I FILE {$attachmentsCount} DI {$PodProfile->podXml->reference->external} \n\r");
                    $FileImport = new FileImport();
                    foreach ($PodProfile->getAttachments() as $attachmentFilepath) {
                        Console::stdout("\t\t{$attachmentFilepath}\n\r");
                        $FileImport->importFileForModel($proposta, 'attachments', $attachmentFilepath);
                    }
                }

                $tagsNotFound            = [];
                $tagsMarkets             = $PodProfile->getTagsMarkets();
                $tagsMarketsCount        = count($tagsMarkets);
                $tagsNotFound['markets'] = [];
                $savedTags               = [];

                if ($tagsMarketsCount && in_array('markets', $moduleEen->tagsEenEnabled)) {
                    Console::stdout("SALVO I TAGS {$tagsMarketsCount} MARKETS DI {$PodProfile->podXml->reference->external} \n\r");

                    $params = [
                        'classname' => EenPartnershipProposal::className(),
                        'record_id' => $proposta['id'],
                        'root_id' => $moduleEen->book_ids['markets']
                    ];

                    EntitysTagsMm::deleteAll($params);

                    foreach ($tagsMarkets as $tag) {
                        Console::stdout("\t\t{$tag['codice']} - {$tag['nome']}");
                        $tagIds = $tag->getIds($moduleEen->root_id, $conversion);
                        if (!empty($tagIds)) {
                            Console::stdout("\tTROVATO\n\r");
                        foreach ($tagIds as $tagId){
                            $TagProposta = new EntitysTagsMm(ArrayHelper::merge($params,
                                [
                                    'tag_id' => $tagId
                                ]));
                            $TagProposta->save(false);
                        }

                        } else {
                            $tagsNotFound['markets'][] = $tag;
                            if ($conversion == true) {
                                $tag->setNotFound();
                            }
                            Console::stdout("\tNON TROVATO\n\r");
                            $notify=1;
                        }
                    }
                }

                $tagsNaces             = $PodProfile->getTagsNaces();
                $tagsNacesCount        = count($tagsNaces);
                $tagsNotFound['naces'] = [];

                if ($tagsNacesCount && in_array('naces', $moduleEen->tagsEenEnabled)) {
                    Console::stdout("SALVO I TAGS {$tagsNacesCount} NACES DI {$PodProfile->podXml->reference->external} \n\r");

                    $params = [
                        'classname' => EenPartnershipProposal::className(),
                        'record_id' => $proposta['id'],
                        'root_id' => $moduleEen->book_ids['naces']
                    ];

                    EntitysTagsMm::deleteAll($params);

                    foreach ($tagsNaces as $tag) {
                        Console::stdout("\t\t{$tag['codice']} - {$tag['nome']}");
                        $tagIds = $tag->getIds($moduleEen->root_id, $conversion);
                        if (!empty($tagIds)) {
                            Console::stdout("\tTROVATO\n\r");
                            foreach ($tagIds as $tagId){
                                $TagProposta = new EntitysTagsMm(ArrayHelper::merge($params,
                                    [
                                        'tag_id' => $tagId
                                    ]));
                                $TagProposta->save(false);
                            }
                        } else {
                            $tagsNotFound['naces'][] = $tag;
                            if ($conversion == true) {
                                $tag->setNotFound();
                            }
                            Console::stdout("\tNON TROVATO\n\r");
                            $notify=1;
                        }
                    }
                }

                $tagsTechnologies = $PodProfile->getTagsTechnologies();

                $tagsTechnologiesCount = count($tagsTechnologies);

                if ($tagsTechnologiesCount && in_array('tecnologies', $moduleEen->tagsEenEnabled)) {
                    Console::stdout("SALVO I TAGS {$tagsTechnologiesCount} TECHNOLOGIES DI {$PodProfile->podXml->reference->external} \n\r");

                    $params = [
                        'classname' => EenPartnershipProposal::className(),
                        'record_id' => $proposta['id'],
                        'root_id' => $moduleEen->book_ids['tecnologies']
                    ];
  
                    EntitysTagsMm::deleteAll($params);

                    foreach ($tagsTechnologies as $tag) {
                        Console::stdout("\t\t{$tag['codice']} - {$tag['nome']}");
                        $tagIds = $tag->getIds($moduleEen->root_id, $conversion);
                        if (!empty($tagIds)) {
                            Console::stdout("\tTROVATO\n\r");
                            foreach ($tagIds as $tagId){
                                $TagProposta = new EntitysTagsMm(ArrayHelper::merge($params,
                                    [
                                        'tag_id' => $tagId
                                    ]));
                                $TagProposta->save(false);
                            }
                        } else {
                            $tagsNotFound['tecnologies'][] = $tag;
                            if ($conversion == true) {
                                $tag->setNotFound();
                            }
                            Console::stdout("\tNON TROVATO\n\r");
                            $notify=1;
                        }
                    }
                }

                $proposta->tags_not_found = Json::encode($tagsNotFound, true);
                $proposta->detachBehavior('cwhBehavior');
                $ok                       = $proposta->save(false);

                if ($ok) {
                    //$cwhPubbId = 'een_partnership_proposal-' . $proposta->id;
                    $configContent    = CwhConfigContents::findOne(['tablename' => $proposta->tableName()])->id;
                    $cwhPubblicazioni = CwhPubblicazioni::findOne([
                            'cwh_config_contents_id' => $configContent,
                            'content_id' => $proposta->id,
                            'cwh_regole_pubblicazione_id' => 2
                    ]);
                    if (is_null($cwhPubblicazioni)) {
                        $cwhPubblicazioni                              = new CwhPubblicazioni();
                        $cwhPubblicazioni->cwh_config_contents_id      = $configContent;
                        $cwhPubblicazioni->content_id                  = $proposta->id;
                        $cwhPubblicazioni->cwh_regole_pubblicazione_id = 2;
                    }

                    $ok = $cwhPubblicazioni->save(false);
                    //se viene fatto un aggiornamento per via della proposta che scade in giornata non notifichiamo la proposta
                    if($proposta->datum_deadline != $proposta->datum_update){
                        $proposta->saveNotificationSendEmail($proposta->classname(), \arter\amos\notificationmanager\models\NotificationChannels::CHANNEL_MAIL, $proposta->id, true);
                    }
                    /* if ($ok) {
                      $eenUtility = new EenMailUtility();
                      $eenUtility->sendMails($proposta->id);
                      } */
                }
                foreach ($tagsNotFound as $tag)
                    print($tag);
                if($conversion == true && !empty($tagsNotFound)){
                    // EenMailUtility::sendEmailTagsNotFound();
                    $list_tags_not_found = true;
                }

                Console::stdout("{$profile->reference->external} => ID {$proposta['id']}  \n\r");
                Console::stdout(".................................................................\n\r\n\r");
            }
            
            if( $notify ) {
                EenMailUtility::sendEmailTagsNotFound();
            }

            Console::stdout($k++." TROVATE\n\r");

            Console::stdout("Saved!\n\r");
        } else {
            Console::stdout("NESSUNA PROPOSTA TROVATA\n\r");
        }

        return [
            'copde' => '1',
            'message' => '??'
        ];
    }

    private function normalizeArray($value, $separator = ',')
    {
        if (isset($value)) {
            return explode($separator, $value);
        }
        return null;
    }

    private function normalizeDate($date)
    {
        if (isset($date)) {
            return date('Ymd', strtotime(
                    date($date)
                )
            );
        }
        return null;
    }

    private function normalizeBoolean($value)
    {
        if (isset($value)) {
            if ($value == 1 || $value == '1' || $value == true || $value == 'true' || strtolower($value) == 'y' || strtolower($value)
                == 'yes') {
                return true;
            }
            return false;
        }
        return null;
    }

    private function normalizeString($value)
    {
        if (is_string($value)) {
            return trim($value);
        }
        return null;
    }

    private function explainRequest()
    {
        Console::stdout("\n\r\n\r==============================================\n\r\n\r");
        Console::stdout("This request returns EEN Collaboration Proposal:\n\r");

        foreach ($this->getPassedOptionValues() as $passedOption => $passedValue) {

            $help = $passedOption;
            if (array_key_exists($passedOption, $this->passedOptionsExplained)) {
                $help = $this->passedOptionsExplained[$passedOption];
            }

            $value = $passedValue;

            if (is_array($passedValue)) {
                $value = implode(',', $passedValue);
            }

            Console::stdout(\Yii::t('amoseen', "\t".$help."\n\r", [
                    'value' => $value
            ]));
        }

        Console::stdout("\n\r\n\r==============================================\n\r\n\r");
    }
}