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

namespace Google\Service\SQLAdmin;

class BackupConfiguration extends \Google\Model
{
  protected $backupRetentionSettingsType = BackupRetentionSettings::class;
  protected $backupRetentionSettingsDataType = '';
  public $binaryLogEnabled;
  public $enabled;
  public $kind;
  public $location;
  public $pointInTimeRecoveryEnabled;
  public $replicationLogArchivingEnabled;
  public $startTime;
  public $transactionLogRetentionDays;

  /**
   * @param BackupRetentionSettings
   */
  public function setBackupRetentionSettings(BackupRetentionSettings $backupRetentionSettings)
  {
    $this->backupRetentionSettings = $backupRetentionSettings;
  }
  /**
   * @return BackupRetentionSettings
   */
  public function getBackupRetentionSettings()
  {
    return $this->backupRetentionSettings;
  }
  public function setBinaryLogEnabled($binaryLogEnabled)
  {
    $this->binaryLogEnabled = $binaryLogEnabled;
  }
  public function getBinaryLogEnabled()
  {
    return $this->binaryLogEnabled;
  }
  public function setEnabled($enabled)
  {
    $this->enabled = $enabled;
  }
  public function getEnabled()
  {
    return $this->enabled;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setLocation($location)
  {
    $this->location = $location;
  }
  public function getLocation()
  {
    return $this->location;
  }
  public function setPointInTimeRecoveryEnabled($pointInTimeRecoveryEnabled)
  {
    $this->pointInTimeRecoveryEnabled = $pointInTimeRecoveryEnabled;
  }
  public function getPointInTimeRecoveryEnabled()
  {
    return $this->pointInTimeRecoveryEnabled;
  }
  public function setReplicationLogArchivingEnabled($replicationLogArchivingEnabled)
  {
    $this->replicationLogArchivingEnabled = $replicationLogArchivingEnabled;
  }
  public function getReplicationLogArchivingEnabled()
  {
    return $this->replicationLogArchivingEnabled;
  }
  public function setStartTime($startTime)
  {
    $this->startTime = $startTime;
  }
  public function getStartTime()
  {
    return $this->startTime;
  }
  public function setTransactionLogRetentionDays($transactionLogRetentionDays)
  {
    $this->transactionLogRetentionDays = $transactionLogRetentionDays;
  }
  public function getTransactionLogRetentionDays()
  {
    return $this->transactionLogRetentionDays;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(BackupConfiguration::class, 'Google_Service_SQLAdmin_BackupConfiguration');
