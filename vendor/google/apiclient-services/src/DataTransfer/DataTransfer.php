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

namespace Google\Service\DataTransfer;

class DataTransfer extends \Google\Collection
{
  protected $collection_key = 'applicationDataTransfers';
  protected $applicationDataTransfersType = ApplicationDataTransfer::class;
  protected $applicationDataTransfersDataType = 'array';
  public $etag;
  public $id;
  public $kind;
  public $newOwnerUserId;
  public $oldOwnerUserId;
  public $overallTransferStatusCode;
  public $requestTime;

  /**
   * @param ApplicationDataTransfer[]
   */
  public function setApplicationDataTransfers($applicationDataTransfers)
  {
    $this->applicationDataTransfers = $applicationDataTransfers;
  }
  /**
   * @return ApplicationDataTransfer[]
   */
  public function getApplicationDataTransfers()
  {
    return $this->applicationDataTransfers;
  }
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  public function getEtag()
  {
    return $this->etag;
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
  public function setNewOwnerUserId($newOwnerUserId)
  {
    $this->newOwnerUserId = $newOwnerUserId;
  }
  public function getNewOwnerUserId()
  {
    return $this->newOwnerUserId;
  }
  public function setOldOwnerUserId($oldOwnerUserId)
  {
    $this->oldOwnerUserId = $oldOwnerUserId;
  }
  public function getOldOwnerUserId()
  {
    return $this->oldOwnerUserId;
  }
  public function setOverallTransferStatusCode($overallTransferStatusCode)
  {
    $this->overallTransferStatusCode = $overallTransferStatusCode;
  }
  public function getOverallTransferStatusCode()
  {
    return $this->overallTransferStatusCode;
  }
  public function setRequestTime($requestTime)
  {
    $this->requestTime = $requestTime;
  }
  public function getRequestTime()
  {
    return $this->requestTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DataTransfer::class, 'Google_Service_DataTransfer_DataTransfer');
