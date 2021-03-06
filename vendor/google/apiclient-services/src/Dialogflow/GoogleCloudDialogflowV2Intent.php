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

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowV2Intent extends \Google\Collection
{
  protected $collection_key = 'trainingPhrases';
  public $action;
  public $defaultResponsePlatforms;
  public $displayName;
  public $endInteraction;
  public $events;
  protected $followupIntentInfoType = GoogleCloudDialogflowV2IntentFollowupIntentInfo::class;
  protected $followupIntentInfoDataType = 'array';
  public $inputContextNames;
  public $isFallback;
  public $liveAgentHandoff;
  protected $messagesType = GoogleCloudDialogflowV2IntentMessage::class;
  protected $messagesDataType = 'array';
  public $mlDisabled;
  public $name;
  protected $outputContextsType = GoogleCloudDialogflowV2Context::class;
  protected $outputContextsDataType = 'array';
  protected $parametersType = GoogleCloudDialogflowV2IntentParameter::class;
  protected $parametersDataType = 'array';
  public $parentFollowupIntentName;
  public $priority;
  public $resetContexts;
  public $rootFollowupIntentName;
  protected $trainingPhrasesType = GoogleCloudDialogflowV2IntentTrainingPhrase::class;
  protected $trainingPhrasesDataType = 'array';
  public $webhookState;

  public function setAction($action)
  {
    $this->action = $action;
  }
  public function getAction()
  {
    return $this->action;
  }
  public function setDefaultResponsePlatforms($defaultResponsePlatforms)
  {
    $this->defaultResponsePlatforms = $defaultResponsePlatforms;
  }
  public function getDefaultResponsePlatforms()
  {
    return $this->defaultResponsePlatforms;
  }
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setEndInteraction($endInteraction)
  {
    $this->endInteraction = $endInteraction;
  }
  public function getEndInteraction()
  {
    return $this->endInteraction;
  }
  public function setEvents($events)
  {
    $this->events = $events;
  }
  public function getEvents()
  {
    return $this->events;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentFollowupIntentInfo[]
   */
  public function setFollowupIntentInfo($followupIntentInfo)
  {
    $this->followupIntentInfo = $followupIntentInfo;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentFollowupIntentInfo[]
   */
  public function getFollowupIntentInfo()
  {
    return $this->followupIntentInfo;
  }
  public function setInputContextNames($inputContextNames)
  {
    $this->inputContextNames = $inputContextNames;
  }
  public function getInputContextNames()
  {
    return $this->inputContextNames;
  }
  public function setIsFallback($isFallback)
  {
    $this->isFallback = $isFallback;
  }
  public function getIsFallback()
  {
    return $this->isFallback;
  }
  public function setLiveAgentHandoff($liveAgentHandoff)
  {
    $this->liveAgentHandoff = $liveAgentHandoff;
  }
  public function getLiveAgentHandoff()
  {
    return $this->liveAgentHandoff;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentMessage[]
   */
  public function setMessages($messages)
  {
    $this->messages = $messages;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentMessage[]
   */
  public function getMessages()
  {
    return $this->messages;
  }
  public function setMlDisabled($mlDisabled)
  {
    $this->mlDisabled = $mlDisabled;
  }
  public function getMlDisabled()
  {
    return $this->mlDisabled;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param GoogleCloudDialogflowV2Context[]
   */
  public function setOutputContexts($outputContexts)
  {
    $this->outputContexts = $outputContexts;
  }
  /**
   * @return GoogleCloudDialogflowV2Context[]
   */
  public function getOutputContexts()
  {
    return $this->outputContexts;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentParameter[]
   */
  public function setParameters($parameters)
  {
    $this->parameters = $parameters;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentParameter[]
   */
  public function getParameters()
  {
    return $this->parameters;
  }
  public function setParentFollowupIntentName($parentFollowupIntentName)
  {
    $this->parentFollowupIntentName = $parentFollowupIntentName;
  }
  public function getParentFollowupIntentName()
  {
    return $this->parentFollowupIntentName;
  }
  public function setPriority($priority)
  {
    $this->priority = $priority;
  }
  public function getPriority()
  {
    return $this->priority;
  }
  public function setResetContexts($resetContexts)
  {
    $this->resetContexts = $resetContexts;
  }
  public function getResetContexts()
  {
    return $this->resetContexts;
  }
  public function setRootFollowupIntentName($rootFollowupIntentName)
  {
    $this->rootFollowupIntentName = $rootFollowupIntentName;
  }
  public function getRootFollowupIntentName()
  {
    return $this->rootFollowupIntentName;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentTrainingPhrase[]
   */
  public function setTrainingPhrases($trainingPhrases)
  {
    $this->trainingPhrases = $trainingPhrases;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentTrainingPhrase[]
   */
  public function getTrainingPhrases()
  {
    return $this->trainingPhrases;
  }
  public function setWebhookState($webhookState)
  {
    $this->webhookState = $webhookState;
  }
  public function getWebhookState()
  {
    return $this->webhookState;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowV2Intent::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowV2Intent');
