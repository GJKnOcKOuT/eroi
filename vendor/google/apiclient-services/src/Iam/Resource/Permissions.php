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

namespace Google\Service\Iam\Resource;

use Google\Service\Iam\QueryTestablePermissionsRequest;
use Google\Service\Iam\QueryTestablePermissionsResponse;

/**
 * The "permissions" collection of methods.
 * Typical usage is:
 *  <code>
 *   $iamService = new Google\Service\Iam(...);
 *   $permissions = $iamService->permissions;
 *  </code>
 */
class Permissions extends \Google\Service\Resource
{
  /**
   * Lists every permission that you can test on a resource. A permission is
   * testable if you can check whether a member has that permission on the
   * resource. (permissions.queryTestablePermissions)
   *
   * @param QueryTestablePermissionsRequest $postBody
   * @param array $optParams Optional parameters.
   * @return QueryTestablePermissionsResponse
   */
  public function queryTestablePermissions(QueryTestablePermissionsRequest $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('queryTestablePermissions', [$params], QueryTestablePermissionsResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Permissions::class, 'Google_Service_Iam_Resource_Permissions');
