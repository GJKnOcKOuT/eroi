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

namespace Google\Service\Container\Resource;

use Google\Service\Container\ServerConfig;

/**
 * The "locations" collection of methods.
 * Typical usage is:
 *  <code>
 *   $containerService = new Google\Service\Container(...);
 *   $locations = $containerService->locations;
 *  </code>
 */
class ProjectsLocations extends \Google\Service\Resource
{
  /**
   * Returns configuration info about the Google Kubernetes Engine service.
   * (locations.getServerConfig)
   *
   * @param string $name The name (project and location) of the server config to
   * get, specified in the format `projects/locations`.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string projectId Deprecated. The Google Developers Console
   * [project ID or project
   * number](https://support.google.com/cloud/answer/6158840). This field has been
   * deprecated and replaced by the name field.
   * @opt_param string zone Deprecated. The name of the Google Compute Engine
   * [zone](https://cloud.google.com/compute/docs/zones#available) to return
   * operations for. This field has been deprecated and replaced by the name
   * field.
   * @return ServerConfig
   */
  public function getServerConfig($name, $optParams = [])
  {
    $params = ['name' => $name];
    $params = array_merge($params, $optParams);
    return $this->call('getServerConfig', [$params], ServerConfig::class);
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ProjectsLocations::class, 'Google_Service_Container_Resource_ProjectsLocations');
