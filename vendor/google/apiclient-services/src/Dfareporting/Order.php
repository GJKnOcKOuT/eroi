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

class Order extends \Google\Collection
{
  protected $collection_key = 'siteNames';
  public $accountId;
  public $advertiserId;
  public $approverUserProfileIds;
  public $buyerInvoiceId;
  public $buyerOrganizationName;
  public $comments;
  protected $contactsType = OrderContact::class;
  protected $contactsDataType = 'array';
  public $id;
  public $kind;
  protected $lastModifiedInfoType = LastModifiedInfo::class;
  protected $lastModifiedInfoDataType = '';
  public $name;
  public $notes;
  public $planningTermId;
  public $projectId;
  public $sellerOrderId;
  public $sellerOrganizationName;
  public $siteId;
  public $siteNames;
  public $subaccountId;
  public $termsAndConditions;

  public function setAccountId($accountId)
  {
    $this->accountId = $accountId;
  }
  public function getAccountId()
  {
    return $this->accountId;
  }
  public function setAdvertiserId($advertiserId)
  {
    $this->advertiserId = $advertiserId;
  }
  public function getAdvertiserId()
  {
    return $this->advertiserId;
  }
  public function setApproverUserProfileIds($approverUserProfileIds)
  {
    $this->approverUserProfileIds = $approverUserProfileIds;
  }
  public function getApproverUserProfileIds()
  {
    return $this->approverUserProfileIds;
  }
  public function setBuyerInvoiceId($buyerInvoiceId)
  {
    $this->buyerInvoiceId = $buyerInvoiceId;
  }
  public function getBuyerInvoiceId()
  {
    return $this->buyerInvoiceId;
  }
  public function setBuyerOrganizationName($buyerOrganizationName)
  {
    $this->buyerOrganizationName = $buyerOrganizationName;
  }
  public function getBuyerOrganizationName()
  {
    return $this->buyerOrganizationName;
  }
  public function setComments($comments)
  {
    $this->comments = $comments;
  }
  public function getComments()
  {
    return $this->comments;
  }
  /**
   * @param OrderContact[]
   */
  public function setContacts($contacts)
  {
    $this->contacts = $contacts;
  }
  /**
   * @return OrderContact[]
   */
  public function getContacts()
  {
    return $this->contacts;
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
  /**
   * @param LastModifiedInfo
   */
  public function setLastModifiedInfo(LastModifiedInfo $lastModifiedInfo)
  {
    $this->lastModifiedInfo = $lastModifiedInfo;
  }
  /**
   * @return LastModifiedInfo
   */
  public function getLastModifiedInfo()
  {
    return $this->lastModifiedInfo;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setNotes($notes)
  {
    $this->notes = $notes;
  }
  public function getNotes()
  {
    return $this->notes;
  }
  public function setPlanningTermId($planningTermId)
  {
    $this->planningTermId = $planningTermId;
  }
  public function getPlanningTermId()
  {
    return $this->planningTermId;
  }
  public function setProjectId($projectId)
  {
    $this->projectId = $projectId;
  }
  public function getProjectId()
  {
    return $this->projectId;
  }
  public function setSellerOrderId($sellerOrderId)
  {
    $this->sellerOrderId = $sellerOrderId;
  }
  public function getSellerOrderId()
  {
    return $this->sellerOrderId;
  }
  public function setSellerOrganizationName($sellerOrganizationName)
  {
    $this->sellerOrganizationName = $sellerOrganizationName;
  }
  public function getSellerOrganizationName()
  {
    return $this->sellerOrganizationName;
  }
  public function setSiteId($siteId)
  {
    $this->siteId = $siteId;
  }
  public function getSiteId()
  {
    return $this->siteId;
  }
  public function setSiteNames($siteNames)
  {
    $this->siteNames = $siteNames;
  }
  public function getSiteNames()
  {
    return $this->siteNames;
  }
  public function setSubaccountId($subaccountId)
  {
    $this->subaccountId = $subaccountId;
  }
  public function getSubaccountId()
  {
    return $this->subaccountId;
  }
  public function setTermsAndConditions($termsAndConditions)
  {
    $this->termsAndConditions = $termsAndConditions;
  }
  public function getTermsAndConditions()
  {
    return $this->termsAndConditions;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Order::class, 'Google_Service_Dfareporting_Order');
