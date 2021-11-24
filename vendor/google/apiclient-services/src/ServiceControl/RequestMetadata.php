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

namespace Google\Service\ServiceControl;

class RequestMetadata extends \Google\Model
{
  public $callerIp;
  public $callerNetwork;
  public $callerSuppliedUserAgent;
  protected $destinationAttributesType = Peer::class;
  protected $destinationAttributesDataType = '';
  protected $requestAttributesType = Request::class;
  protected $requestAttributesDataType = '';

  public function setCallerIp($callerIp)
  {
    $this->callerIp = $callerIp;
  }
  public function getCallerIp()
  {
    return $this->callerIp;
  }
  public function setCallerNetwork($callerNetwork)
  {
    $this->callerNetwork = $callerNetwork;
  }
  public function getCallerNetwork()
  {
    return $this->callerNetwork;
  }
  public function setCallerSuppliedUserAgent($callerSuppliedUserAgent)
  {
    $this->callerSuppliedUserAgent = $callerSuppliedUserAgent;
  }
  public function getCallerSuppliedUserAgent()
  {
    return $this->callerSuppliedUserAgent;
  }
  /**
   * @param Peer
   */
  public function setDestinationAttributes(Peer $destinationAttributes)
  {
    $this->destinationAttributes = $destinationAttributes;
  }
  /**
   * @return Peer
   */
  public function getDestinationAttributes()
  {
    return $this->destinationAttributes;
  }
  /**
   * @param Request
   */
  public function setRequestAttributes(Request $requestAttributes)
  {
    $this->requestAttributes = $requestAttributes;
  }
  /**
   * @return Request
   */
  public function getRequestAttributes()
  {
    return $this->requestAttributes;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(RequestMetadata::class, 'Google_Service_ServiceControl_RequestMetadata');
