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

namespace Google\Service\AdExperienceReport;

class PlatformSummary extends \Google\Collection
{
  protected $collection_key = 'region';
  public $betterAdsStatus;
  public $enforcementTime;
  public $filterStatus;
  public $lastChangeTime;
  public $region;
  public $reportUrl;
  public $underReview;

  public function setBetterAdsStatus($betterAdsStatus)
  {
    $this->betterAdsStatus = $betterAdsStatus;
  }
  public function getBetterAdsStatus()
  {
    return $this->betterAdsStatus;
  }
  public function setEnforcementTime($enforcementTime)
  {
    $this->enforcementTime = $enforcementTime;
  }
  public function getEnforcementTime()
  {
    return $this->enforcementTime;
  }
  public function setFilterStatus($filterStatus)
  {
    $this->filterStatus = $filterStatus;
  }
  public function getFilterStatus()
  {
    return $this->filterStatus;
  }
  public function setLastChangeTime($lastChangeTime)
  {
    $this->lastChangeTime = $lastChangeTime;
  }
  public function getLastChangeTime()
  {
    return $this->lastChangeTime;
  }
  public function setRegion($region)
  {
    $this->region = $region;
  }
  public function getRegion()
  {
    return $this->region;
  }
  public function setReportUrl($reportUrl)
  {
    $this->reportUrl = $reportUrl;
  }
  public function getReportUrl()
  {
    return $this->reportUrl;
  }
  public function setUnderReview($underReview)
  {
    $this->underReview = $underReview;
  }
  public function getUnderReview()
  {
    return $this->underReview;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PlatformSummary::class, 'Google_Service_AdExperienceReport_PlatformSummary');
