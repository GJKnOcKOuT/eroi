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

namespace Google\Service\ChromePolicy\Resource;

use Google\Service\ChromePolicy\GoogleChromePolicyV1ResolveRequest;
use Google\Service\ChromePolicy\GoogleChromePolicyV1ResolveResponse;

/**
 * The "policies" collection of methods.
 * Typical usage is:
 *  <code>
 *   $chromepolicyService = new Google\Service\ChromePolicy(...);
 *   $policies = $chromepolicyService->policies;
 *  </code>
 */
class CustomersPolicies extends \Google\Service\Resource
{
  /**
   * Gets the resolved policy values for a list of policies that match a search
   * query. (policies.resolve)
   *
   * @param string $customer ID of the G Suite account or literal "my_customer"
   * for the customer associated to the request.
   * @param GoogleChromePolicyV1ResolveRequest $postBody
   * @param array $optParams Optional parameters.
   * @return GoogleChromePolicyV1ResolveResponse
   */
  public function resolve($customer, GoogleChromePolicyV1ResolveRequest $postBody, $optParams = [])
  {
    $params = ['customer' => $customer, 'postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('resolve', [$params], GoogleChromePolicyV1ResolveResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(CustomersPolicies::class, 'Google_Service_ChromePolicy_Resource_CustomersPolicies');
