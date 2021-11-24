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

namespace Google\Service\ToolResults;

class TestSuiteOverview extends \Google\Model
{
  protected $elapsedTimeType = Duration::class;
  protected $elapsedTimeDataType = '';
  public $errorCount;
  public $failureCount;
  public $flakyCount;
  public $name;
  public $skippedCount;
  public $totalCount;
  protected $xmlSourceType = FileReference::class;
  protected $xmlSourceDataType = '';

  /**
   * @param Duration
   */
  public function setElapsedTime(Duration $elapsedTime)
  {
    $this->elapsedTime = $elapsedTime;
  }
  /**
   * @return Duration
   */
  public function getElapsedTime()
  {
    return $this->elapsedTime;
  }
  public function setErrorCount($errorCount)
  {
    $this->errorCount = $errorCount;
  }
  public function getErrorCount()
  {
    return $this->errorCount;
  }
  public function setFailureCount($failureCount)
  {
    $this->failureCount = $failureCount;
  }
  public function getFailureCount()
  {
    return $this->failureCount;
  }
  public function setFlakyCount($flakyCount)
  {
    $this->flakyCount = $flakyCount;
  }
  public function getFlakyCount()
  {
    return $this->flakyCount;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setSkippedCount($skippedCount)
  {
    $this->skippedCount = $skippedCount;
  }
  public function getSkippedCount()
  {
    return $this->skippedCount;
  }
  public function setTotalCount($totalCount)
  {
    $this->totalCount = $totalCount;
  }
  public function getTotalCount()
  {
    return $this->totalCount;
  }
  /**
   * @param FileReference
   */
  public function setXmlSource(FileReference $xmlSource)
  {
    $this->xmlSource = $xmlSource;
  }
  /**
   * @return FileReference
   */
  public function getXmlSource()
  {
    return $this->xmlSource;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TestSuiteOverview::class, 'Google_Service_ToolResults_TestSuiteOverview');
