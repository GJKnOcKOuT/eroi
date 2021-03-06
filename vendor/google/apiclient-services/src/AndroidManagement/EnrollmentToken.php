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

class EnrollmentToken extends \Google\Model
{
  public $additionalData;
  public $allowPersonalUsage;
  public $duration;
  public $expirationTimestamp;
  public $name;
  public $oneTimeOnly;
  public $policyName;
  public $qrCode;
  protected $userType = User::class;
  protected $userDataType = '';
  public $value;

  public function setAdditionalData($additionalData)
  {
    $this->additionalData = $additionalData;
  }
  public function getAdditionalData()
  {
    return $this->additionalData;
  }
  public function setAllowPersonalUsage($allowPersonalUsage)
  {
    $this->allowPersonalUsage = $allowPersonalUsage;
  }
  public function getAllowPersonalUsage()
  {
    return $this->allowPersonalUsage;
  }
  public function setDuration($duration)
  {
    $this->duration = $duration;
  }
  public function getDuration()
  {
    return $this->duration;
  }
  public function setExpirationTimestamp($expirationTimestamp)
  {
    $this->expirationTimestamp = $expirationTimestamp;
  }
  public function getExpirationTimestamp()
  {
    return $this->expirationTimestamp;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setOneTimeOnly($oneTimeOnly)
  {
    $this->oneTimeOnly = $oneTimeOnly;
  }
  public function getOneTimeOnly()
  {
    return $this->oneTimeOnly;
  }
  public function setPolicyName($policyName)
  {
    $this->policyName = $policyName;
  }
  public function getPolicyName()
  {
    return $this->policyName;
  }
  public function setQrCode($qrCode)
  {
    $this->qrCode = $qrCode;
  }
  public function getQrCode()
  {
    return $this->qrCode;
  }
  /**
   * @param User
   */
  public function setUser(User $user)
  {
    $this->user = $user;
  }
  /**
   * @return User
   */
  public function getUser()
  {
    return $this->user;
  }
  public function setValue($value)
  {
    $this->value = $value;
  }
  public function getValue()
  {
    return $this->value;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(EnrollmentToken::class, 'Google_Service_AndroidManagement_EnrollmentToken');
