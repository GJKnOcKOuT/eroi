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

namespace Google\Service\PeopleService;

class ContactGroup extends \Google\Collection
{
  protected $collection_key = 'memberResourceNames';
  protected $clientDataType = GroupClientData::class;
  protected $clientDataDataType = 'array';
  public $etag;
  public $formattedName;
  public $groupType;
  public $memberCount;
  public $memberResourceNames;
  protected $metadataType = ContactGroupMetadata::class;
  protected $metadataDataType = '';
  public $name;
  public $resourceName;

  /**
   * @param GroupClientData[]
   */
  public function setClientData($clientData)
  {
    $this->clientData = $clientData;
  }
  /**
   * @return GroupClientData[]
   */
  public function getClientData()
  {
    return $this->clientData;
  }
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  public function getEtag()
  {
    return $this->etag;
  }
  public function setFormattedName($formattedName)
  {
    $this->formattedName = $formattedName;
  }
  public function getFormattedName()
  {
    return $this->formattedName;
  }
  public function setGroupType($groupType)
  {
    $this->groupType = $groupType;
  }
  public function getGroupType()
  {
    return $this->groupType;
  }
  public function setMemberCount($memberCount)
  {
    $this->memberCount = $memberCount;
  }
  public function getMemberCount()
  {
    return $this->memberCount;
  }
  public function setMemberResourceNames($memberResourceNames)
  {
    $this->memberResourceNames = $memberResourceNames;
  }
  public function getMemberResourceNames()
  {
    return $this->memberResourceNames;
  }
  /**
   * @param ContactGroupMetadata
   */
  public function setMetadata(ContactGroupMetadata $metadata)
  {
    $this->metadata = $metadata;
  }
  /**
   * @return ContactGroupMetadata
   */
  public function getMetadata()
  {
    return $this->metadata;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setResourceName($resourceName)
  {
    $this->resourceName = $resourceName;
  }
  public function getResourceName()
  {
    return $this->resourceName;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ContactGroup::class, 'Google_Service_PeopleService_ContactGroup');
