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

namespace Google\Service\DoubleClickBidManager;

class QueryMetadata extends \Google\Collection
{
  protected $collection_key = 'shareEmailAddress';
  public $dataRange;
  public $format;
  public $googleCloudStoragePathForLatestReport;
  public $googleDrivePathForLatestReport;
  public $latestReportRunTimeMs;
  public $locale;
  public $reportCount;
  public $running;
  public $sendNotification;
  public $shareEmailAddress;
  public $title;

  public function setDataRange($dataRange)
  {
    $this->dataRange = $dataRange;
  }
  public function getDataRange()
  {
    return $this->dataRange;
  }
  public function setFormat($format)
  {
    $this->format = $format;
  }
  public function getFormat()
  {
    return $this->format;
  }
  public function setGoogleCloudStoragePathForLatestReport($googleCloudStoragePathForLatestReport)
  {
    $this->googleCloudStoragePathForLatestReport = $googleCloudStoragePathForLatestReport;
  }
  public function getGoogleCloudStoragePathForLatestReport()
  {
    return $this->googleCloudStoragePathForLatestReport;
  }
  public function setGoogleDrivePathForLatestReport($googleDrivePathForLatestReport)
  {
    $this->googleDrivePathForLatestReport = $googleDrivePathForLatestReport;
  }
  public function getGoogleDrivePathForLatestReport()
  {
    return $this->googleDrivePathForLatestReport;
  }
  public function setLatestReportRunTimeMs($latestReportRunTimeMs)
  {
    $this->latestReportRunTimeMs = $latestReportRunTimeMs;
  }
  public function getLatestReportRunTimeMs()
  {
    return $this->latestReportRunTimeMs;
  }
  public function setLocale($locale)
  {
    $this->locale = $locale;
  }
  public function getLocale()
  {
    return $this->locale;
  }
  public function setReportCount($reportCount)
  {
    $this->reportCount = $reportCount;
  }
  public function getReportCount()
  {
    return $this->reportCount;
  }
  public function setRunning($running)
  {
    $this->running = $running;
  }
  public function getRunning()
  {
    return $this->running;
  }
  public function setSendNotification($sendNotification)
  {
    $this->sendNotification = $sendNotification;
  }
  public function getSendNotification()
  {
    return $this->sendNotification;
  }
  public function setShareEmailAddress($shareEmailAddress)
  {
    $this->shareEmailAddress = $shareEmailAddress;
  }
  public function getShareEmailAddress()
  {
    return $this->shareEmailAddress;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getTitle()
  {
    return $this->title;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(QueryMetadata::class, 'Google_Service_DoubleClickBidManager_QueryMetadata');
