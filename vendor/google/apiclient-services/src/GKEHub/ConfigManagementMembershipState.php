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

namespace Google\Service\GKEHub;

class ConfigManagementMembershipState extends \Google\Model
{
  public $clusterName;
  protected $configSyncStateType = ConfigManagementConfigSyncState::class;
  protected $configSyncStateDataType = '';
  protected $hierarchyControllerStateType = ConfigManagementHierarchyControllerState::class;
  protected $hierarchyControllerStateDataType = '';
  protected $membershipSpecType = ConfigManagementMembershipSpec::class;
  protected $membershipSpecDataType = '';
  protected $operatorStateType = ConfigManagementOperatorState::class;
  protected $operatorStateDataType = '';
  protected $policyControllerStateType = ConfigManagementPolicyControllerState::class;
  protected $policyControllerStateDataType = '';

  public function setClusterName($clusterName)
  {
    $this->clusterName = $clusterName;
  }
  public function getClusterName()
  {
    return $this->clusterName;
  }
  /**
   * @param ConfigManagementConfigSyncState
   */
  public function setConfigSyncState(ConfigManagementConfigSyncState $configSyncState)
  {
    $this->configSyncState = $configSyncState;
  }
  /**
   * @return ConfigManagementConfigSyncState
   */
  public function getConfigSyncState()
  {
    return $this->configSyncState;
  }
  /**
   * @param ConfigManagementHierarchyControllerState
   */
  public function setHierarchyControllerState(ConfigManagementHierarchyControllerState $hierarchyControllerState)
  {
    $this->hierarchyControllerState = $hierarchyControllerState;
  }
  /**
   * @return ConfigManagementHierarchyControllerState
   */
  public function getHierarchyControllerState()
  {
    return $this->hierarchyControllerState;
  }
  /**
   * @param ConfigManagementMembershipSpec
   */
  public function setMembershipSpec(ConfigManagementMembershipSpec $membershipSpec)
  {
    $this->membershipSpec = $membershipSpec;
  }
  /**
   * @return ConfigManagementMembershipSpec
   */
  public function getMembershipSpec()
  {
    return $this->membershipSpec;
  }
  /**
   * @param ConfigManagementOperatorState
   */
  public function setOperatorState(ConfigManagementOperatorState $operatorState)
  {
    $this->operatorState = $operatorState;
  }
  /**
   * @return ConfigManagementOperatorState
   */
  public function getOperatorState()
  {
    return $this->operatorState;
  }
  /**
   * @param ConfigManagementPolicyControllerState
   */
  public function setPolicyControllerState(ConfigManagementPolicyControllerState $policyControllerState)
  {
    $this->policyControllerState = $policyControllerState;
  }
  /**
   * @return ConfigManagementPolicyControllerState
   */
  public function getPolicyControllerState()
  {
    return $this->policyControllerState;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ConfigManagementMembershipState::class, 'Google_Service_GKEHub_ConfigManagementMembershipState');
