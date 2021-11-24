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

namespace Google\Service\Doubleclicksearch\Resource;

use Google\Service\Doubleclicksearch\ConversionList;
use Google\Service\Doubleclicksearch\UpdateAvailabilityRequest;
use Google\Service\Doubleclicksearch\UpdateAvailabilityResponse;

/**
 * The "conversion" collection of methods.
 * Typical usage is:
 *  <code>
 *   $doubleclicksearchService = new Google\Service\Doubleclicksearch(...);
 *   $conversion = $doubleclicksearchService->conversion;
 *  </code>
 */
class Conversion extends \Google\Service\Resource
{
  /**
   * Retrieves a list of conversions from a DoubleClick Search engine account.
   * (conversion.get)
   *
   * @param string $agencyId Numeric ID of the agency.
   * @param string $advertiserId Numeric ID of the advertiser.
   * @param string $engineAccountId Numeric ID of the engine account.
   * @param int $endDate Last date (inclusive) on which to retrieve conversions.
   * Format is yyyymmdd.
   * @param int $rowCount The number of conversions to return per call.
   * @param int $startDate First date (inclusive) on which to retrieve
   * conversions. Format is yyyymmdd.
   * @param string $startRow The 0-based starting index for retrieving conversions
   * results.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string adGroupId Numeric ID of the ad group.
   * @opt_param string adId Numeric ID of the ad.
   * @opt_param string campaignId Numeric ID of the campaign.
   * @opt_param string criterionId Numeric ID of the criterion.
   * @return ConversionList
   */
  public function get($agencyId, $advertiserId, $engineAccountId, $endDate, $rowCount, $startDate, $startRow, $optParams = [])
  {
    $params = ['agencyId' => $agencyId, 'advertiserId' => $advertiserId, 'engineAccountId' => $engineAccountId, 'endDate' => $endDate, 'rowCount' => $rowCount, 'startDate' => $startDate, 'startRow' => $startRow];
    $params = array_merge($params, $optParams);
    return $this->call('get', [$params], ConversionList::class);
  }
  /**
   * Inserts a batch of new conversions into DoubleClick Search.
   * (conversion.insert)
   *
   * @param ConversionList $postBody
   * @param array $optParams Optional parameters.
   * @return ConversionList
   */
  public function insert(ConversionList $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('insert', [$params], ConversionList::class);
  }
  /**
   * Updates a batch of conversions in DoubleClick Search. (conversion.update)
   *
   * @param ConversionList $postBody
   * @param array $optParams Optional parameters.
   * @return ConversionList
   */
  public function update(ConversionList $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('update', [$params], ConversionList::class);
  }
  /**
   * Updates the availabilities of a batch of floodlight activities in DoubleClick
   * Search. (conversion.updateAvailability)
   *
   * @param UpdateAvailabilityRequest $postBody
   * @param array $optParams Optional parameters.
   * @return UpdateAvailabilityResponse
   */
  public function updateAvailability(UpdateAvailabilityRequest $postBody, $optParams = [])
  {
    $params = ['postBody' => $postBody];
    $params = array_merge($params, $optParams);
    return $this->call('updateAvailability', [$params], UpdateAvailabilityResponse::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Conversion::class, 'Google_Service_Doubleclicksearch_Resource_Conversion');
