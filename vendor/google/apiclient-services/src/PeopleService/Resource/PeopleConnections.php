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

namespace Google\Service\PeopleService\Resource;

use Google\Service\PeopleService\ListConnectionsResponse;

/**
 * The "connections" collection of methods.
 * Typical usage is:
 *  <code>
 *   $peopleService = new Google\Service\PeopleService(...);
 *   $connections = $peopleService->connections;
 *  </code>
 */
class PeopleConnections extends \Google\Service\Resource
{
  /**
   * Provides a list of the authenticated user's contacts. The request returns a
   * 400 error if `personFields` is not specified. The request returns a 410 error
   * if `sync_token` is specified and is expired. Sync tokens expire after 7 days
   * to prevent data drift between clients and the server. To handle a sync token
   * expired error, a request should be sent without `sync_token` to get all
   * contacts. (connections.listPeopleConnections)
   *
   * @param string $resourceName Required. The resource name to return connections
   * for. Only `people/me` is valid.
   * @param array $optParams Optional parameters.
   *
   * @opt_param int pageSize Optional. The number of connections to include in the
   * response. Valid values are between 1 and 1000, inclusive. Defaults to 100 if
   * not set or set to 0.
   * @opt_param string pageToken Optional. A page token, received from a previous
   * `ListConnections` call. Provide this to retrieve the subsequent page. When
   * paginating, all other parameters provided to `ListConnections` must match the
   * call that provided the page token.
   * @opt_param string personFields Required. A field mask to restrict which
   * fields on each person are returned. Multiple fields can be specified by
   * separating them with commas. Valid values are: * addresses * ageRanges *
   * biographies * birthdays * calendarUrls * clientData * coverPhotos *
   * emailAddresses * events * externalIds * genders * imClients * interests *
   * locales * locations * memberships * metadata * miscKeywords * names *
   * nicknames * occupations * organizations * phoneNumbers * photos * relations *
   * sipAddresses * skills * urls * userDefined
   * @opt_param string requestMask.includeField Required. Comma-separated list of
   * person fields to be included in the response. Each path should start with
   * `person.`: for example, `person.names` or `person.photos`.
   * @opt_param bool requestSyncToken Optional. Whether the response should
   * include `next_sync_token` on the last page, which can be used to get all
   * changes since the last request. For subsequent sync requests use the
   * `sync_token` param instead. Initial full sync requests that specify
   * `request_sync_token` and do not specify `sync_token` have an additional rate
   * limit per user. Each client should generally only be doing a full sync once
   * every few days per user and so should not hit this limit.
   * @opt_param string sortOrder Optional. The order in which the connections
   * should be sorted. Defaults to `LAST_MODIFIED_ASCENDING`.
   * @opt_param string sources Optional. A mask of what source types to return.
   * Defaults to READ_SOURCE_TYPE_CONTACT and READ_SOURCE_TYPE_PROFILE if not set.
   * @opt_param string syncToken Optional. A sync token, received from a previous
   * `ListConnections` call. Provide this to retrieve only the resources changed
   * since the last request. When the `syncToken` is specified, resources deleted
   * since the last sync will be returned as a person with [`PersonMetadata.delete
   * d`](/people/api/rest/v1/people#Person.PersonMetadata.FIELDS.deleted) set to
   * true. When the `syncToken` is specified, all other parameters provided to
   * `ListConnections` except `page_size` and `page_token` must match the initial
   * call that provided the sync token. Sync tokens expire after seven days, after
   * which a full sync request without a `sync_token` should be made.
   * @return ListConnectionsResponse
   */
  public function listPeopleConnections($resourceName, $optParams = [])
  {
    $params = ['resourceName' => $resourceName];
    $params = array_merge($params, $optParams);
    return $this->call('list', [$params], ListConnectionsResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(PeopleConnections::class, 'Google_Service_PeopleService_Resource_PeopleConnections');
