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

namespace Google\Service\ShoppingContent;

class AccountStatusItemLevelIssue extends \Google\Model
{
  public $attributeName;
  public $code;
  public $description;
  public $detail;
  public $documentation;
  public $numItems;
  public $resolution;
  public $servability;

  public function setAttributeName($attributeName)
  {
    $this->attributeName = $attributeName;
  }
  public function getAttributeName()
  {
    return $this->attributeName;
  }
  public function setCode($code)
  {
    $this->code = $code;
  }
  public function getCode()
  {
    return $this->code;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setDetail($detail)
  {
    $this->detail = $detail;
  }
  public function getDetail()
  {
    return $this->detail;
  }
  public function setDocumentation($documentation)
  {
    $this->documentation = $documentation;
  }
  public function getDocumentation()
  {
    return $this->documentation;
  }
  public function setNumItems($numItems)
  {
    $this->numItems = $numItems;
  }
  public function getNumItems()
  {
    return $this->numItems;
  }
  public function setResolution($resolution)
  {
    $this->resolution = $resolution;
  }
  public function getResolution()
  {
    return $this->resolution;
  }
  public function setServability($servability)
  {
    $this->servability = $servability;
  }
  public function getServability()
  {
    return $this->servability;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AccountStatusItemLevelIssue::class, 'Google_Service_ShoppingContent_AccountStatusItemLevelIssue');
