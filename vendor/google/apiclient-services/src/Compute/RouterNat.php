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

class RouterNat extends \Google\Collection
{
  protected $collection_key = 'subnetworks';
  public $drainNatIps;
  public $enableEndpointIndependentMapping;
  public $icmpIdleTimeoutSec;
  protected $logConfigType = RouterNatLogConfig::class;
  protected $logConfigDataType = '';
  public $minPortsPerVm;
  public $name;
  public $natIpAllocateOption;
  public $natIps;
  public $sourceSubnetworkIpRangesToNat;
  protected $subnetworksType = RouterNatSubnetworkToNat::class;
  protected $subnetworksDataType = 'array';
  public $tcpEstablishedIdleTimeoutSec;
  public $tcpTransitoryIdleTimeoutSec;
  public $udpIdleTimeoutSec;

  public function setDrainNatIps($drainNatIps)
  {
    $this->drainNatIps = $drainNatIps;
  }
  public function getDrainNatIps()
  {
    return $this->drainNatIps;
  }
  public function setEnableEndpointIndependentMapping($enableEndpointIndependentMapping)
  {
    $this->enableEndpointIndependentMapping = $enableEndpointIndependentMapping;
  }
  public function getEnableEndpointIndependentMapping()
  {
    return $this->enableEndpointIndependentMapping;
  }
  public function setIcmpIdleTimeoutSec($icmpIdleTimeoutSec)
  {
    $this->icmpIdleTimeoutSec = $icmpIdleTimeoutSec;
  }
  public function getIcmpIdleTimeoutSec()
  {
    return $this->icmpIdleTimeoutSec;
  }
  /**
   * @param RouterNatLogConfig
   */
  public function setLogConfig(RouterNatLogConfig $logConfig)
  {
    $this->logConfig = $logConfig;
  }
  /**
   * @return RouterNatLogConfig
   */
  public function getLogConfig()
  {
    return $this->logConfig;
  }
  public function setMinPortsPerVm($minPortsPerVm)
  {
    $this->minPortsPerVm = $minPortsPerVm;
  }
  public function getMinPortsPerVm()
  {
    return $this->minPortsPerVm;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNatIpAllocateOption($natIpAllocateOption)
  {
    $this->natIpAllocateOption = $natIpAllocateOption;
  }
  public function getNatIpAllocateOption()
  {
    return $this->natIpAllocateOption;
  }
  public function setNatIps($natIps)
  {
    $this->natIps = $natIps;
  }
  public function getNatIps()
  {
    return $this->natIps;
  }
  public function setSourceSubnetworkIpRangesToNat($sourceSubnetworkIpRangesToNat)
  {
    $this->sourceSubnetworkIpRangesToNat = $sourceSubnetworkIpRangesToNat;
  }
  public function getSourceSubnetworkIpRangesToNat()
  {
    return $this->sourceSubnetworkIpRangesToNat;
  }
  /**
   * @param RouterNatSubnetworkToNat[]
   */
  public function setSubnetworks($subnetworks)
  {
    $this->subnetworks = $subnetworks;
  }
  /**
   * @return RouterNatSubnetworkToNat[]
   */
  public function getSubnetworks()
  {
    return $this->subnetworks;
  }
  public function setTcpEstablishedIdleTimeoutSec($tcpEstablishedIdleTimeoutSec)
  {
    $this->tcpEstablishedIdleTimeoutSec = $tcpEstablishedIdleTimeoutSec;
  }
  public function getTcpEstablishedIdleTimeoutSec()
  {
    return $this->tcpEstablishedIdleTimeoutSec;
  }
  public function setTcpTransitoryIdleTimeoutSec($tcpTransitoryIdleTimeoutSec)
  {
    $this->tcpTransitoryIdleTimeoutSec = $tcpTransitoryIdleTimeoutSec;
  }
  public function getTcpTransitoryIdleTimeoutSec()
  {
    return $this->tcpTransitoryIdleTimeoutSec;
  }
  public function setUdpIdleTimeoutSec($udpIdleTimeoutSec)
  {
    $this->udpIdleTimeoutSec = $udpIdleTimeoutSec;
  }
  public function getUdpIdleTimeoutSec()
  {
    return $this->udpIdleTimeoutSec;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(RouterNat::class, 'Google_Service_Compute_RouterNat');
