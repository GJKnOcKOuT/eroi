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

namespace Google\Service\Cloudchannel;

class GoogleCloudChannelV1alpha1Entitlement extends \Google\Collection
{
  protected $collection_key = 'suspensionReasons';
  public $assignedUnits;
  protected $associationInfoType = GoogleCloudChannelV1alpha1AssociationInfo::class;
  protected $associationInfoDataType = '';
  public $channelPartnerId;
  protected $commitmentSettingsType = GoogleCloudChannelV1alpha1CommitmentSettings::class;
  protected $commitmentSettingsDataType = '';
  public $createTime;
  public $maxUnits;
  public $name;
  public $numUnits;
  public $offer;
  protected $parametersType = GoogleCloudChannelV1alpha1Parameter::class;
  protected $parametersDataType = 'array';
  protected $provisionedServiceType = GoogleCloudChannelV1alpha1ProvisionedService::class;
  protected $provisionedServiceDataType = '';
  public $provisioningState;
  public $purchaseOrderId;
  public $suspensionReasons;
  protected $trialSettingsType = GoogleCloudChannelV1alpha1TrialSettings::class;
  protected $trialSettingsDataType = '';
  public $updateTime;

  public function setAssignedUnits($assignedUnits)
  {
    $this->assignedUnits = $assignedUnits;
  }
  public function getAssignedUnits()
  {
    return $this->assignedUnits;
  }
  /**
   * @param GoogleCloudChannelV1alpha1AssociationInfo
   */
  public function setAssociationInfo(GoogleCloudChannelV1alpha1AssociationInfo $associationInfo)
  {
    $this->associationInfo = $associationInfo;
  }
  /**
   * @return GoogleCloudChannelV1alpha1AssociationInfo
   */
  public function getAssociationInfo()
  {
    return $this->associationInfo;
  }
  public function setChannelPartnerId($channelPartnerId)
  {
    $this->channelPartnerId = $channelPartnerId;
  }
  public function getChannelPartnerId()
  {
    return $this->channelPartnerId;
  }
  /**
   * @param GoogleCloudChannelV1alpha1CommitmentSettings
   */
  public function setCommitmentSettings(GoogleCloudChannelV1alpha1CommitmentSettings $commitmentSettings)
  {
    $this->commitmentSettings = $commitmentSettings;
  }
  /**
   * @return GoogleCloudChannelV1alpha1CommitmentSettings
   */
  public function getCommitmentSettings()
  {
    return $this->commitmentSettings;
  }
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  public function setMaxUnits($maxUnits)
  {
    $this->maxUnits = $maxUnits;
  }
  public function getMaxUnits()
  {
    return $this->maxUnits;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNumUnits($numUnits)
  {
    $this->numUnits = $numUnits;
  }
  public function getNumUnits()
  {
    return $this->numUnits;
  }
  public function setOffer($offer)
  {
    $this->offer = $offer;
  }
  public function getOffer()
  {
    return $this->offer;
  }
  /**
   * @param GoogleCloudChannelV1alpha1Parameter[]
   */
  public function setParameters($parameters)
  {
    $this->parameters = $parameters;
  }
  /**
   * @return GoogleCloudChannelV1alpha1Parameter[]
   */
  public function getParameters()
  {
    return $this->parameters;
  }
  /**
   * @param GoogleCloudChannelV1alpha1ProvisionedService
   */
  public function setProvisionedService(GoogleCloudChannelV1alpha1ProvisionedService $provisionedService)
  {
    $this->provisionedService = $provisionedService;
  }
  /**
   * @return GoogleCloudChannelV1alpha1ProvisionedService
   */
  public function getProvisionedService()
  {
    return $this->provisionedService;
  }
  public function setProvisioningState($provisioningState)
  {
    $this->provisioningState = $provisioningState;
  }
  public function getProvisioningState()
  {
    return $this->provisioningState;
  }
  public function setPurchaseOrderId($purchaseOrderId)
  {
    $this->purchaseOrderId = $purchaseOrderId;
  }
  public function getPurchaseOrderId()
  {
    return $this->purchaseOrderId;
  }
  public function setSuspensionReasons($suspensionReasons)
  {
    $this->suspensionReasons = $suspensionReasons;
  }
  public function getSuspensionReasons()
  {
    return $this->suspensionReasons;
  }
  /**
   * @param GoogleCloudChannelV1alpha1TrialSettings
   */
  public function setTrialSettings(GoogleCloudChannelV1alpha1TrialSettings $trialSettings)
  {
    $this->trialSettings = $trialSettings;
  }
  /**
   * @return GoogleCloudChannelV1alpha1TrialSettings
   */
  public function getTrialSettings()
  {
    return $this->trialSettings;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudChannelV1alpha1Entitlement::class, 'Google_Service_Cloudchannel_GoogleCloudChannelV1alpha1Entitlement');
