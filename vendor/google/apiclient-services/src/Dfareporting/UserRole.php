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

namespace Google\Service\Dfareporting;

class UserRole extends \Google\Collection
{
  protected $collection_key = 'permissions';
  public $accountId;
  public $defaultUserRole;
  public $id;
  public $kind;
  public $name;
  public $parentUserRoleId;
  protected $permissionsType = UserRolePermission::class;
  protected $permissionsDataType = 'array';
  public $subaccountId;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  public function setDefaultUserRole($defaultUserRole)
  {
    $this->defaultUserRole = $defaultUserRole;
  }
  public function getDefaultUserRole()
  {
    return $this->defaultUserRole;
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
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setParentUserRoleId($parentUserRoleId)
  {
    $this->parentUserRoleId = $parentUserRoleId;
  }
  public function getParentUserRoleId()
  {
    return $this->parentUserRoleId;
  }
  /**
   * @param UserRolePermission[]
   */
  public function setPermissions($permissions)
  {
    $this->permissions = $permissions;
  }
  /**
   * @return UserRolePermission[]
   */
  public function getPermissions()
  {
    return $this->permissions;
  }
  public function setSubaccountId($subaccountId)
  {
    $this->subaccountId = $subaccountId;
  }
  public function getSubaccountId()
  {
    return $this->subaccountId;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(UserRole::class, 'Google_Service_Dfareporting_UserRole');
