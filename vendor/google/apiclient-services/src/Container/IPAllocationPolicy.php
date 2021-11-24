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

namespace Google\Service\Container;

class IPAllocationPolicy extends \Google\Model
{
  public $clusterIpv4Cidr;
  public $clusterIpv4CidrBlock;
  public $clusterSecondaryRangeName;
  public $createSubnetwork;
  public $nodeIpv4Cidr;
  public $nodeIpv4CidrBlock;
  public $servicesIpv4Cidr;
  public $servicesIpv4CidrBlock;
  public $servicesSecondaryRangeName;
  public $subnetworkName;
  public $tpuIpv4CidrBlock;
  public $useIpAliases;
  public $useRoutes;

  public function setClusterIpv4Cidr($clusterIpv4Cidr)
  {
    $this->clusterIpv4Cidr = $clusterIpv4Cidr;
  }
  public function getClusterIpv4Cidr()
  {
    return $this->clusterIpv4Cidr;
  }
  public function setClusterIpv4CidrBlock($clusterIpv4CidrBlock)
  {
    $this->clusterIpv4CidrBlock = $clusterIpv4CidrBlock;
  }
  public function getClusterIpv4CidrBlock()
  {
    return $this->clusterIpv4CidrBlock;
  }
  public function setClusterSecondaryRangeName($clusterSecondaryRangeName)
  {
    $this->clusterSecondaryRangeName = $clusterSecondaryRangeName;
  }
  public function getClusterSecondaryRangeName()
  {
    return $this->clusterSecondaryRangeName;
  }
  public function setCreateSubnetwork($createSubnetwork)
  {
    $this->createSubnetwork = $createSubnetwork;
  }
  public function getCreateSubnetwork()
  {
    return $this->createSubnetwork;
  }
  public function setNodeIpv4Cidr($nodeIpv4Cidr)
  {
    $this->nodeIpv4Cidr = $nodeIpv4Cidr;
  }
  public function getNodeIpv4Cidr()
  {
    return $this->nodeIpv4Cidr;
  }
  public function setNodeIpv4CidrBlock($nodeIpv4CidrBlock)
  {
    $this->nodeIpv4CidrBlock = $nodeIpv4CidrBlock;
  }
  public function getNodeIpv4CidrBlock()
  {
    return $this->nodeIpv4CidrBlock;
  }
  public function setServicesIpv4Cidr($servicesIpv4Cidr)
  {
    $this->servicesIpv4Cidr = $servicesIpv4Cidr;
  }
  public function getServicesIpv4Cidr()
  {
    return $this->servicesIpv4Cidr;
  }
  public function setServicesIpv4CidrBlock($servicesIpv4CidrBlock)
  {
    $this->servicesIpv4CidrBlock = $servicesIpv4CidrBlock;
  }
  public function getServicesIpv4CidrBlock()
  {
    return $this->servicesIpv4CidrBlock;
  }
  public function setServicesSecondaryRangeName($servicesSecondaryRangeName)
  {
    $this->servicesSecondaryRangeName = $servicesSecondaryRangeName;
  }
  public function getServicesSecondaryRangeName()
  {
    return $this->servicesSecondaryRangeName;
  }
  public function setSubnetworkName($subnetworkName)
  {
    $this->subnetworkName = $subnetworkName;
  }
  public function getSubnetworkName()
  {
    return $this->subnetworkName;
  }
  public function setTpuIpv4CidrBlock($tpuIpv4CidrBlock)
  {
    $this->tpuIpv4CidrBlock = $tpuIpv4CidrBlock;
  }
  public function getTpuIpv4CidrBlock()
  {
    return $this->tpuIpv4CidrBlock;
  }
  public function setUseIpAliases($useIpAliases)
  {
    $this->useIpAliases = $useIpAliases;
  }
  public function getUseIpAliases()
  {
    return $this->useIpAliases;
  }
  public function setUseRoutes($useRoutes)
  {
    $this->useRoutes = $useRoutes;
  }
  public function getUseRoutes()
  {
    return $this->useRoutes;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(IPAllocationPolicy::class, 'Google_Service_Container_IPAllocationPolicy');
