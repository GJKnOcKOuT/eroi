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

namespace Google\Service\MyBusinessPlaceActions;

class PlaceActionLink extends \Google\Model
{
  public $createTime;
  public $isEditable;
  public $isPreferred;
  public $name;
  public $placeActionType;
  public $providerType;
  public $updateTime;
  public $uri;

  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  public function setIsEditable($isEditable)
  {
    $this->isEditable = $isEditable;
  }
  public function getIsEditable()
  {
    return $this->isEditable;
  }
  public function setIsPreferred($isPreferred)
  {
    $this->isPreferred = $isPreferred;
  }
  public function getIsPreferred()
  {
    return $this->isPreferred;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setPlaceActionType($placeActionType)
  {
    $this->placeActionType = $placeActionType;
  }
  public function getPlaceActionType()
  {
    return $this->placeActionType;
  }
  public function setProviderType($providerType)
  {
    $this->providerType = $providerType;
  }
  public function getProviderType()
  {
    return $this->providerType;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
  public function setUri($uri)
  {
    $this->uri = $uri;
  }
  public function getUri()
  {
    return $this->uri;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PlaceActionLink::class, 'Google_Service_MyBusinessPlaceActions_PlaceActionLink');
