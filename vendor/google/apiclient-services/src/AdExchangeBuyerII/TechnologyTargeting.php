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

namespace Google\Service\AdExchangeBuyerII;

class TechnologyTargeting extends \Google\Model
{
  protected $deviceCapabilityTargetingType = CriteriaTargeting::class;
  protected $deviceCapabilityTargetingDataType = '';
  protected $deviceCategoryTargetingType = CriteriaTargeting::class;
  protected $deviceCategoryTargetingDataType = '';
  protected $operatingSystemTargetingType = OperatingSystemTargeting::class;
  protected $operatingSystemTargetingDataType = '';

  /**
   * @param CriteriaTargeting
   */
  public function setDeviceCapabilityTargeting(CriteriaTargeting $deviceCapabilityTargeting)
  {
    $this->deviceCapabilityTargeting = $deviceCapabilityTargeting;
  }
  /**
   * @return CriteriaTargeting
   */
  public function getDeviceCapabilityTargeting()
  {
    return $this->deviceCapabilityTargeting;
  }
  /**
   * @param CriteriaTargeting
   */
  public function setDeviceCategoryTargeting(CriteriaTargeting $deviceCategoryTargeting)
  {
    $this->deviceCategoryTargeting = $deviceCategoryTargeting;
  }
  /**
   * @return CriteriaTargeting
   */
  public function getDeviceCategoryTargeting()
  {
    return $this->deviceCategoryTargeting;
  }
  /**
   * @param OperatingSystemTargeting
   */
  public function setOperatingSystemTargeting(OperatingSystemTargeting $operatingSystemTargeting)
  {
    $this->operatingSystemTargeting = $operatingSystemTargeting;
  }
  /**
   * @return OperatingSystemTargeting
   */
  public function getOperatingSystemTargeting()
  {
    return $this->operatingSystemTargeting;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TechnologyTargeting::class, 'Google_Service_AdExchangeBuyerII_TechnologyTargeting');
