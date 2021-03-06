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

namespace Google\Service\Storagetransfer;

class TransferJob extends \Google\Model
{
  public $creationTime;
  public $deletionTime;
  public $description;
  public $lastModificationTime;
  public $latestOperationName;
  public $name;
  protected $notificationConfigType = NotificationConfig::class;
  protected $notificationConfigDataType = '';
  public $projectId;
  protected $scheduleType = Schedule::class;
  protected $scheduleDataType = '';
  public $status;
  protected $transferSpecType = TransferSpec::class;
  protected $transferSpecDataType = '';

  public function setCreationTime($creationTime)
  {
    $this->creationTime = $creationTime;
  }
  public function getCreationTime()
  {
    return $this->creationTime;
  }
  public function setDeletionTime($deletionTime)
  {
    $this->deletionTime = $deletionTime;
  }
  public function getDeletionTime()
  {
    return $this->deletionTime;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setLastModificationTime($lastModificationTime)
  {
    $this->lastModificationTime = $lastModificationTime;
  }
  public function getLastModificationTime()
  {
    return $this->lastModificationTime;
  }
  public function setLatestOperationName($latestOperationName)
  {
    $this->latestOperationName = $latestOperationName;
  }
  public function getLatestOperationName()
  {
    return $this->latestOperationName;
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
   * @param NotificationConfig
   */
  public function setNotificationConfig(NotificationConfig $notificationConfig)
  {
    $this->notificationConfig = $notificationConfig;
  }
  /**
   * @return NotificationConfig
   */
  public function getNotificationConfig()
  {
    return $this->notificationConfig;
  }
  public function setProjectId($projectId)
  {
    $this->projectId = $projectId;
  }
  public function getProjectId()
  {
    return $this->projectId;
  }
  /**
   * @param Schedule
   */
  public function setSchedule(Schedule $schedule)
  {
    $this->schedule = $schedule;
  }
  /**
   * @return Schedule
   */
  public function getSchedule()
  {
    return $this->schedule;
  }
  public function setStatus($status)
  {
    $this->status = $status;
  }
  public function getStatus()
  {
    return $this->status;
  }
  /**
   * @param TransferSpec
   */
  public function setTransferSpec(TransferSpec $transferSpec)
  {
    $this->transferSpec = $transferSpec;
  }
  /**
   * @return TransferSpec
   */
  public function getTransferSpec()
  {
    return $this->transferSpec;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TransferJob::class, 'Google_Service_Storagetransfer_TransferJob');
