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

namespace Google\Service\SecurityCommandCenter;

class Asset extends \Google\Model
{
  public $canonicalName;
  public $createTime;
  protected $iamPolicyType = IamPolicy::class;
  protected $iamPolicyDataType = '';
  public $name;
  public $resourceProperties;
  protected $securityCenterPropertiesType = SecurityCenterProperties::class;
  protected $securityCenterPropertiesDataType = '';
  protected $securityMarksType = SecurityMarks::class;
  protected $securityMarksDataType = '';
  public $updateTime;

  public function setCanonicalName($canonicalName)
  {
    $this->canonicalName = $canonicalName;
  }
  public function getCanonicalName()
  {
    return $this->canonicalName;
  }
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param IamPolicy
   */
  public function setIamPolicy(IamPolicy $iamPolicy)
  {
    $this->iamPolicy = $iamPolicy;
  }
  /**
   * @return IamPolicy
   */
  public function getIamPolicy()
  {
    return $this->iamPolicy;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setResourceProperties($resourceProperties)
  {
    $this->resourceProperties = $resourceProperties;
  }
  public function getResourceProperties()
  {
    return $this->resourceProperties;
  }
  /**
   * @param SecurityCenterProperties
   */
  public function setSecurityCenterProperties(SecurityCenterProperties $securityCenterProperties)
  {
    $this->securityCenterProperties = $securityCenterProperties;
  }
  /**
   * @return SecurityCenterProperties
   */
  public function getSecurityCenterProperties()
  {
    return $this->securityCenterProperties;
  }
  /**
   * @param SecurityMarks
   */
  public function setSecurityMarks(SecurityMarks $securityMarks)
  {
    $this->securityMarks = $securityMarks;
  }
  /**
   * @return SecurityMarks
   */
  public function getSecurityMarks()
  {
    return $this->securityMarks;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Asset::class, 'Google_Service_SecurityCommandCenter_Asset');
