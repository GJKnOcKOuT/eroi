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

namespace Google\Service\Directory;

class OrgUnit extends \Google\Model
{
  public $blockInheritance;
  public $description;
  public $etag;
  public $kind;
  public $name;
  public $orgUnitId;
  public $orgUnitPath;
  public $parentOrgUnitId;
  public $parentOrgUnitPath;

  public function setBlockInheritance($blockInheritance)
  {
    $this->blockInheritance = $blockInheritance;
  }
  public function getBlockInheritance()
  {
    return $this->blockInheritance;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  public function getEtag()
  {
    return $this->etag;
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
  public function setOrgUnitId($orgUnitId)
  {
    $this->orgUnitId = $orgUnitId;
  }
  public function getOrgUnitId()
  {
    return $this->orgUnitId;
  }
  public function setOrgUnitPath($orgUnitPath)
  {
    $this->orgUnitPath = $orgUnitPath;
  }
  public function getOrgUnitPath()
  {
    return $this->orgUnitPath;
  }
  public function setParentOrgUnitId($parentOrgUnitId)
  {
    $this->parentOrgUnitId = $parentOrgUnitId;
  }
  public function getParentOrgUnitId()
  {
    return $this->parentOrgUnitId;
  }
  public function setParentOrgUnitPath($parentOrgUnitPath)
  {
    $this->parentOrgUnitPath = $parentOrgUnitPath;
  }
  public function getParentOrgUnitPath()
  {
    return $this->parentOrgUnitPath;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(OrgUnit::class, 'Google_Service_Directory_OrgUnit');
