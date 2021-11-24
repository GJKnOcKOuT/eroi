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

namespace Google\Service\Clouderrorreporting;

class ErrorContext extends \Google\Collection
{
  protected $collection_key = 'sourceReferences';
  protected $httpRequestType = HttpRequestContext::class;
  protected $httpRequestDataType = '';
  protected $reportLocationType = SourceLocation::class;
  protected $reportLocationDataType = '';
  protected $sourceReferencesType = SourceReference::class;
  protected $sourceReferencesDataType = 'array';
  public $user;

  /**
   * @param HttpRequestContext
   */
  public function setHttpRequest(HttpRequestContext $httpRequest)
  {
    $this->httpRequest = $httpRequest;
  }
  /**
   * @return HttpRequestContext
   */
  public function getHttpRequest()
  {
    return $this->httpRequest;
  }
  /**
   * @param SourceLocation
   */
  public function setReportLocation(SourceLocation $reportLocation)
  {
    $this->reportLocation = $reportLocation;
  }
  /**
   * @return SourceLocation
   */
  public function getReportLocation()
  {
    return $this->reportLocation;
  }
  /**
   * @param SourceReference[]
   */
  public function setSourceReferences($sourceReferences)
  {
    $this->sourceReferences = $sourceReferences;
  }
  /**
   * @return SourceReference[]
   */
  public function getSourceReferences()
  {
    return $this->sourceReferences;
  }
  public function setUser($user)
  {
    $this->user = $user;
  }
  public function getUser()
  {
    return $this->user;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ErrorContext::class, 'Google_Service_Clouderrorreporting_ErrorContext');
