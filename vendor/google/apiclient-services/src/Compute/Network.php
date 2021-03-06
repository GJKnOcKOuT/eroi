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

class Network extends \Google\Collection
{
  protected $collection_key = 'subnetworks';
  protected $internal_gapi_mappings = [
        "iPv4Range" => "IPv4Range",
  ];
  public $iPv4Range;
  public $autoCreateSubnetworks;
  public $creationTimestamp;
  public $description;
  public $gatewayIPv4;
  public $id;
  public $kind;
  public $mtu;
  public $name;
  protected $peeringsType = NetworkPeering::class;
  protected $peeringsDataType = 'array';
  protected $routingConfigType = NetworkRoutingConfig::class;
  protected $routingConfigDataType = '';
  public $selfLink;
  public $subnetworks;

  public function setIPv4Range($iPv4Range)
  {
    $this->iPv4Range = $iPv4Range;
  }
  public function getIPv4Range()
  {
    return $this->iPv4Range;
  }
  public function setAutoCreateSubnetworks($autoCreateSubnetworks)
  {
    $this->autoCreateSubnetworks = $autoCreateSubnetworks;
  }
  public function getAutoCreateSubnetworks()
  {
    return $this->autoCreateSubnetworks;
  }
  public function setCreationTimestamp($creationTimestamp)
  {
    $this->creationTimestamp = $creationTimestamp;
  }
  public function getCreationTimestamp()
  {
    return $this->creationTimestamp;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setGatewayIPv4($gatewayIPv4)
  {
    $this->gatewayIPv4 = $gatewayIPv4;
  }
  public function getGatewayIPv4()
  {
    return $this->gatewayIPv4;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setMtu($mtu)
  {
    $this->mtu = $mtu;
  }
  public function getMtu()
  {
    return $this->mtu;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param NetworkPeering[]
   */
  public function setPeerings($peerings)
  {
    $this->peerings = $peerings;
  }
  /**
   * @return NetworkPeering[]
   */
  public function getPeerings()
  {
    return $this->peerings;
  }
  /**
   * @param NetworkRoutingConfig
   */
  public function setRoutingConfig(NetworkRoutingConfig $routingConfig)
  {
    $this->routingConfig = $routingConfig;
  }
  /**
   * @return NetworkRoutingConfig
   */
  public function getRoutingConfig()
  {
    return $this->routingConfig;
  }
  public function setSelfLink($selfLink)
  {
    $this->selfLink = $selfLink;
  }
  public function getSelfLink()
  {
    return $this->selfLink;
  }
  public function setSubnetworks($subnetworks)
  {
    $this->subnetworks = $subnetworks;
  }
  public function getSubnetworks()
  {
    return $this->subnetworks;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Network::class, 'Google_Service_Compute_Network');
