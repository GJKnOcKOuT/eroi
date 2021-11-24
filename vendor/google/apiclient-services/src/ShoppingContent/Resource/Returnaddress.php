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

namespace Google\Service\ShoppingContent\Resource;

use Google\Service\ShoppingContent\ReturnAddress as ReturnAddressModel;
use Google\Service\ShoppingContent\ReturnaddressCustomBatchRequest;
use Google\Service\ShoppingContent\ReturnaddressCustomBatchResponse;
use Google\Service\ShoppingContent\ReturnaddressListResponse;

/**
 * The "returnaddress" collection of methods.
 * Typical usage is:
 *  <code>
 *   $contentService = new Google\Service\ShoppingContent(...);
 *   $returnaddress = $contentService->returnaddress;
 *  </code>
 */
class Returnaddress extends \Google\Service\Resource
{
  /**
   * Batches multiple return address related calls in a single request.
   * (returnaddress.custombatch)
   *
   * @param ReturnaddressCustomBatchRequest $postBody
   * @param array $optParams Optional parameters.
   * @return ReturnaddressCustomBatchResponse
   */
  public function custombatch(ReturnaddressCustomBatchRequest $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('custombatch', [$params], ReturnaddressCustomBatchResponse::class);
  }
  /**
   * Deletes a return address for the given Merchant Center account.
   * (returnaddress.delete)
   *
   * @param string $merchantId The Merchant Center account from which to delete
   * the given return address.
   * @param string $returnAddressId Return address ID generated by Google.
   * @param array $optParams Optional parameters.
   */
  public function delete($merchantId, $returnAddressId, $optParams = [])
  {
    $params = ['merchantId' => $merchantId, 'returnAddressId' => $returnAddressId];
    $params = array_merge($params, $optParams);
    return $this->call('delete', [$params]);
  }
  /**
   * Gets a return address of the Merchant Center account. (returnaddress.get)
   *
   * @param string $merchantId The Merchant Center account to get a return address
   * for.
   * @param string $returnAddressId Return address ID generated by Google.
   * @param array $optParams Optional parameters.
   * @return ReturnAddressModel
   */
  public function get($merchantId, $returnAddressId, $optParams = [])
  {
    $params = ['merchantId' => $merchantId, 'returnAddressId' => $returnAddressId];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], ReturnAddressModel::class);
  }
  /**
   * Inserts a return address for the Merchant Center account.
   * (returnaddress.insert)
   *
   * @param string $merchantId The Merchant Center account to insert a return
   * address for.
   * @param ReturnAddressModel $postBody
   * @param array $optParams Optional parameters.
   * @return ReturnAddressModel
   */
  public function insert($merchantId, ReturnAddressModel $postBody, $optParams = [])
  {
    $params = ['merchantId' => $merchantId, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('insert', [$params], ReturnAddressModel::class);
  }
  /**
   * Lists the return addresses of the Merchant Center account.
   * (returnaddress.listReturnaddress)
   *
   * @param string $merchantId The Merchant Center account to list return
   * addresses for.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string country List only return addresses applicable to the given
   * country of sale. When omitted, all return addresses are listed.
   * @opt_param string maxResults The maximum number of addresses in the response,
   * used for paging.
   * @opt_param string pageToken The token returned by the previous request.
   * @return ReturnaddressListResponse
   */
  public function listReturnaddress($merchantId, $optParams = [])
  {
    $params = ['merchantId' => $merchantId];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ReturnaddressListResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Returnaddress::class, 'Google_Service_ShoppingContent_Resource_Returnaddress');
