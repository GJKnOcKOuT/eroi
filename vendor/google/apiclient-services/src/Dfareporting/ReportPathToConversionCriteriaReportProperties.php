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

namespace Google\Service\Dfareporting;

class ReportPathToConversionCriteriaReportProperties extends \Google\Model
{
  public $clicksLookbackWindow;
  public $impressionsLookbackWindow;
  public $includeAttributedIPConversions;
  public $includeUnattributedCookieConversions;
  public $includeUnattributedIPConversions;
  public $maximumClickInteractions;
  public $maximumImpressionInteractions;
  public $maximumInteractionGap;
  public $pivotOnInteractionPath;

  public function setClicksLookbackWindow($clicksLookbackWindow)
  {
    $this->clicksLookbackWindow = $clicksLookbackWindow;
  }
  public function getClicksLookbackWindow()
  {
    return $this->clicksLookbackWindow;
  }
  public function setImpressionsLookbackWindow($impressionsLookbackWindow)
  {
    $this->impressionsLookbackWindow = $impressionsLookbackWindow;
  }
  public function getImpressionsLookbackWindow()
  {
    return $this->impressionsLookbackWindow;
  }
  public function setIncludeAttributedIPConversions($includeAttributedIPConversions)
  {
    $this->includeAttributedIPConversions = $includeAttributedIPConversions;
  }
  public function getIncludeAttributedIPConversions()
  {
    return $this->includeAttributedIPConversions;
  }
  public function setIncludeUnattributedCookieConversions($includeUnattributedCookieConversions)
  {
    $this->includeUnattributedCookieConversions = $includeUnattributedCookieConversions;
  }
  public function getIncludeUnattributedCookieConversions()
  {
    return $this->includeUnattributedCookieConversions;
  }
  public function setIncludeUnattributedIPConversions($includeUnattributedIPConversions)
  {
    $this->includeUnattributedIPConversions = $includeUnattributedIPConversions;
  }
  public function getIncludeUnattributedIPConversions()
  {
    return $this->includeUnattributedIPConversions;
  }
  public function setMaximumClickInteractions($maximumClickInteractions)
  {
    $this->maximumClickInteractions = $maximumClickInteractions;
  }
  public function getMaximumClickInteractions()
  {
    return $this->maximumClickInteractions;
  }
  public function setMaximumImpressionInteractions($maximumImpressionInteractions)
  {
    $this->maximumImpressionInteractions = $maximumImpressionInteractions;
  }
  public function getMaximumImpressionInteractions()
  {
    return $this->maximumImpressionInteractions;
  }
  public function setMaximumInteractionGap($maximumInteractionGap)
  {
    $this->maximumInteractionGap = $maximumInteractionGap;
  }
  public function getMaximumInteractionGap()
  {
    return $this->maximumInteractionGap;
  }
  public function setPivotOnInteractionPath($pivotOnInteractionPath)
  {
    $this->pivotOnInteractionPath = $pivotOnInteractionPath;
  }
  public function getPivotOnInteractionPath()
  {
    return $this->pivotOnInteractionPath;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ReportPathToConversionCriteriaReportProperties::class, 'Google_Service_Dfareporting_ReportPathToConversionCriteriaReportProperties');
