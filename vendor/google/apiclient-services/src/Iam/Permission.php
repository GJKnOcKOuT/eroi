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

namespace Google\Service\Iam;

class Permission extends \Google\Model
{
  public $apiDisabled;
  public $customRolesSupportLevel;
  public $description;
  public $name;
  public $onlyInPredefinedRoles;
  public $primaryPermission;
  public $stage;
  public $title;

  public function setApiDisabled($apiDisabled)
  {
    $this->apiDisabled = $apiDisabled;
  }
  public function getApiDisabled()
  {
    return $this->apiDisabled;
  }
  public function setCustomRolesSupportLevel($customRolesSupportLevel)
  {
    $this->customRolesSupportLevel = $customRolesSupportLevel;
  }
  public function getCustomRolesSupportLevel()
  {
    return $this->customRolesSupportLevel;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setOnlyInPredefinedRoles($onlyInPredefinedRoles)
  {
    $this->onlyInPredefinedRoles = $onlyInPredefinedRoles;
  }
  public function getOnlyInPredefinedRoles()
  {
    return $this->onlyInPredefinedRoles;
  }
  public function setPrimaryPermission($primaryPermission)
  {
    $this->primaryPermission = $primaryPermission;
  }
  public function getPrimaryPermission()
  {
    return $this->primaryPermission;
  }
  public function setStage($stage)
  {
    $this->stage = $stage;
  }
  public function getStage()
  {
    return $this->stage;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getTitle()
  {
    return $this->title;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Permission::class, 'Google_Service_Iam_Permission');
