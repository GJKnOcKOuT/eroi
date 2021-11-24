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

namespace Google\Service\CloudMachineLearningEngine;

class GoogleCloudMlV1SuggestTrialsResponse extends \Google\Collection
{
  protected $collection_key = 'trials';
  public $endTime;
  public $startTime;
  public $studyState;
  protected $trialsType = GoogleCloudMlV1Trial::class;
  protected $trialsDataType = 'array';

  public function setEndTime($endTime)
  {
    $this->endTime = $endTime;
  }
  public function getEndTime()
  {
    return $this->endTime;
  }
  public function setStartTime($startTime)
  {
    $this->startTime = $startTime;
  }
  public function getStartTime()
  {
    return $this->startTime;
  }
  public function setStudyState($studyState)
  {
    $this->studyState = $studyState;
  }
  public function getStudyState()
  {
    return $this->studyState;
  }
  /**
   * @param GoogleCloudMlV1Trial[]
   */
  public function setTrials($trials)
  {
    $this->trials = $trials;
  }
  /**
   * @return GoogleCloudMlV1Trial[]
   */
  public function getTrials()
  {
    return $this->trials;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudMlV1SuggestTrialsResponse::class, 'Google_Service_CloudMachineLearningEngine_GoogleCloudMlV1SuggestTrialsResponse');
