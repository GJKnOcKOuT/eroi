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

namespace Google\Service\Compute;

class HttpHeaderAction extends \Google\Collection
{
  protected $collection_key = 'responseHeadersToRemove';
  protected $requestHeadersToAddType = HttpHeaderOption::class;
  protected $requestHeadersToAddDataType = 'array';
  public $requestHeadersToRemove;
  protected $responseHeadersToAddType = HttpHeaderOption::class;
  protected $responseHeadersToAddDataType = 'array';
  public $responseHeadersToRemove;

  /**
   * @param HttpHeaderOption[]
   */
  public function setRequestHeadersToAdd($requestHeadersToAdd)
  {
    $this->requestHeadersToAdd = $requestHeadersToAdd;
  }
  /**
   * @return HttpHeaderOption[]
   */
  public function getRequestHeadersToAdd()
  {
    return $this->requestHeadersToAdd;
  }
  public function setRequestHeadersToRemove($requestHeadersToRemove)
  {
    $this->requestHeadersToRemove = $requestHeadersToRemove;
  }
  public function getRequestHeadersToRemove()
  {
    return $this->requestHeadersToRemove;
  }
  /**
   * @param HttpHeaderOption[]
   */
  public function setResponseHeadersToAdd($responseHeadersToAdd)
  {
    $this->responseHeadersToAdd = $responseHeadersToAdd;
  }
  /**
   * @return HttpHeaderOption[]
   */
  public function getResponseHeadersToAdd()
  {
    return $this->responseHeadersToAdd;
  }
  public function setResponseHeadersToRemove($responseHeadersToRemove)
  {
    $this->responseHeadersToRemove = $responseHeadersToRemove;
  }
  public function getResponseHeadersToRemove()
  {
    return $this->responseHeadersToRemove;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HttpHeaderAction::class, 'Google_Service_Compute_HttpHeaderAction');
