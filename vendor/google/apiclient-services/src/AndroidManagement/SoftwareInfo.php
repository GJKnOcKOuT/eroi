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

namespace Google\Service\AndroidManagement;

class SoftwareInfo extends \Google\Model
{
  public $androidBuildNumber;
  public $androidBuildTime;
  public $androidDevicePolicyVersionCode;
  public $androidDevicePolicyVersionName;
  public $androidVersion;
  public $bootloaderVersion;
  public $deviceBuildSignature;
  public $deviceKernelVersion;
  public $primaryLanguageCode;
  public $securityPatchLevel;
  protected $systemUpdateInfoType = SystemUpdateInfo::class;
  protected $systemUpdateInfoDataType = '';

  public function setAndroidBuildNumber($androidBuildNumber)
  {
    $this->androidBuildNumber = $androidBuildNumber;
  }
  public function getAndroidBuildNumber()
  {
    return $this->androidBuildNumber;
  }
  public function setAndroidBuildTime($androidBuildTime)
  {
    $this->androidBuildTime = $androidBuildTime;
  }
  public function getAndroidBuildTime()
  {
    return $this->androidBuildTime;
  }
  public function setAndroidDevicePolicyVersionCode($androidDevicePolicyVersionCode)
  {
    $this->androidDevicePolicyVersionCode = $androidDevicePolicyVersionCode;
  }
  public function getAndroidDevicePolicyVersionCode()
  {
    return $this->androidDevicePolicyVersionCode;
  }
  public function setAndroidDevicePolicyVersionName($androidDevicePolicyVersionName)
  {
    $this->androidDevicePolicyVersionName = $androidDevicePolicyVersionName;
  }
  public function getAndroidDevicePolicyVersionName()
  {
    return $this->androidDevicePolicyVersionName;
  }
  public function setAndroidVersion($androidVersion)
  {
    $this->androidVersion = $androidVersion;
  }
  public function getAndroidVersion()
  {
    return $this->androidVersion;
  }
  public function setBootloaderVersion($bootloaderVersion)
  {
    $this->bootloaderVersion = $bootloaderVersion;
  }
  public function getBootloaderVersion()
  {
    return $this->bootloaderVersion;
  }
  public function setDeviceBuildSignature($deviceBuildSignature)
  {
    $this->deviceBuildSignature = $deviceBuildSignature;
  }
  public function getDeviceBuildSignature()
  {
    return $this->deviceBuildSignature;
  }
  public function setDeviceKernelVersion($deviceKernelVersion)
  {
    $this->deviceKernelVersion = $deviceKernelVersion;
  }
  public function getDeviceKernelVersion()
  {
    return $this->deviceKernelVersion;
  }
  public function setPrimaryLanguageCode($primaryLanguageCode)
  {
    $this->primaryLanguageCode = $primaryLanguageCode;
  }
  public function getPrimaryLanguageCode()
  {
    return $this->primaryLanguageCode;
  }
  public function setSecurityPatchLevel($securityPatchLevel)
  {
    $this->securityPatchLevel = $securityPatchLevel;
  }
  public function getSecurityPatchLevel()
  {
    return $this->securityPatchLevel;
  }
  /**
   * @param SystemUpdateInfo
   */
  public function setSystemUpdateInfo(SystemUpdateInfo $systemUpdateInfo)
  {
    $this->systemUpdateInfo = $systemUpdateInfo;
  }
  /**
   * @return SystemUpdateInfo
   */
  public function getSystemUpdateInfo()
  {
    return $this->systemUpdateInfo;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SoftwareInfo::class, 'Google_Service_AndroidManagement_SoftwareInfo');
