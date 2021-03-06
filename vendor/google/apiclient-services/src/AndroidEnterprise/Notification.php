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

namespace Google\Service\AndroidEnterprise;

class Notification extends \Google\Model
{
  protected $appRestrictionsSchemaChangeEventType = AppRestrictionsSchemaChangeEvent::class;
  protected $appRestrictionsSchemaChangeEventDataType = '';
  protected $appUpdateEventType = AppUpdateEvent::class;
  protected $appUpdateEventDataType = '';
  protected $deviceReportUpdateEventType = DeviceReportUpdateEvent::class;
  protected $deviceReportUpdateEventDataType = '';
  public $enterpriseId;
  protected $installFailureEventType = InstallFailureEvent::class;
  protected $installFailureEventDataType = '';
  protected $newDeviceEventType = NewDeviceEvent::class;
  protected $newDeviceEventDataType = '';
  protected $newPermissionsEventType = NewPermissionsEvent::class;
  protected $newPermissionsEventDataType = '';
  public $notificationType;
  protected $productApprovalEventType = ProductApprovalEvent::class;
  protected $productApprovalEventDataType = '';
  protected $productAvailabilityChangeEventType = ProductAvailabilityChangeEvent::class;
  protected $productAvailabilityChangeEventDataType = '';
  public $timestampMillis;

  /**
   * @param AppRestrictionsSchemaChangeEvent
   */
  public function setAppRestrictionsSchemaChangeEvent(AppRestrictionsSchemaChangeEvent $appRestrictionsSchemaChangeEvent)
  {
    $this->appRestrictionsSchemaChangeEvent = $appRestrictionsSchemaChangeEvent;
  }
  /**
   * @return AppRestrictionsSchemaChangeEvent
   */
  public function getAppRestrictionsSchemaChangeEvent()
  {
    return $this->appRestrictionsSchemaChangeEvent;
  }
  /**
   * @param AppUpdateEvent
   */
  public function setAppUpdateEvent(AppUpdateEvent $appUpdateEvent)
  {
    $this->appUpdateEvent = $appUpdateEvent;
  }
  /**
   * @return AppUpdateEvent
   */
  public function getAppUpdateEvent()
  {
    return $this->appUpdateEvent;
  }
  /**
   * @param DeviceReportUpdateEvent
   */
  public function setDeviceReportUpdateEvent(DeviceReportUpdateEvent $deviceReportUpdateEvent)
  {
    $this->deviceReportUpdateEvent = $deviceReportUpdateEvent;
  }
  /**
   * @return DeviceReportUpdateEvent
   */
  public function getDeviceReportUpdateEvent()
  {
    return $this->deviceReportUpdateEvent;
  }
  public function setEnterpriseId($enterpriseId)
  {
    $this->enterpriseId = $enterpriseId;
  }
  public function getEnterpriseId()
  {
    return $this->enterpriseId;
  }
  /**
   * @param InstallFailureEvent
   */
  public function setInstallFailureEvent(InstallFailureEvent $installFailureEvent)
  {
    $this->installFailureEvent = $installFailureEvent;
  }
  /**
   * @return InstallFailureEvent
   */
  public function getInstallFailureEvent()
  {
    return $this->installFailureEvent;
  }
  /**
   * @param NewDeviceEvent
   */
  public function setNewDeviceEvent(NewDeviceEvent $newDeviceEvent)
  {
    $this->newDeviceEvent = $newDeviceEvent;
  }
  /**
   * @return NewDeviceEvent
   */
  public function getNewDeviceEvent()
  {
    return $this->newDeviceEvent;
  }
  /**
   * @param NewPermissionsEvent
   */
  public function setNewPermissionsEvent(NewPermissionsEvent $newPermissionsEvent)
  {
    $this->newPermissionsEvent = $newPermissionsEvent;
  }
  /**
   * @return NewPermissionsEvent
   */
  public function getNewPermissionsEvent()
  {
    return $this->newPermissionsEvent;
  }
  public function setNotificationType($notificationType)
  {
    $this->notificationType = $notificationType;
  }
  public function getNotificationType()
  {
    return $this->notificationType;
  }
  /**
   * @param ProductApprovalEvent
   */
  public function setProductApprovalEvent(ProductApprovalEvent $productApprovalEvent)
  {
    $this->productApprovalEvent = $productApprovalEvent;
  }
  /**
   * @return ProductApprovalEvent
   */
  public function getProductApprovalEvent()
  {
    return $this->productApprovalEvent;
  }
  /**
   * @param ProductAvailabilityChangeEvent
   */
  public function setProductAvailabilityChangeEvent(ProductAvailabilityChangeEvent $productAvailabilityChangeEvent)
  {
    $this->productAvailabilityChangeEvent = $productAvailabilityChangeEvent;
  }
  /**
   * @return ProductAvailabilityChangeEvent
   */
  public function getProductAvailabilityChangeEvent()
  {
    return $this->productAvailabilityChangeEvent;
  }
  public function setTimestampMillis($timestampMillis)
  {
    $this->timestampMillis = $timestampMillis;
  }
  public function getTimestampMillis()
  {
    return $this->timestampMillis;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Notification::class, 'Google_Service_AndroidEnterprise_Notification');
