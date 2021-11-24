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

class GeoTargeting extends \Google\Collection
{
  protected $collection_key = 'regions';
  protected $citiesType = City::class;
  protected $citiesDataType = 'array';
  protected $countriesType = Country::class;
  protected $countriesDataType = 'array';
  public $excludeCountries;
  protected $metrosType = Metro::class;
  protected $metrosDataType = 'array';
  protected $postalCodesType = PostalCode::class;
  protected $postalCodesDataType = 'array';
  protected $regionsType = Region::class;
  protected $regionsDataType = 'array';

  /**
   * @param City[]
   */
  public function setCities($cities)
  {
    $this->cities = $cities;
  }
  /**
   * @return City[]
   */
  public function getCities()
  {
    return $this->cities;
  }
  /**
   * @param Country[]
   */
  public function setCountries($countries)
  {
    $this->countries = $countries;
  }
  /**
   * @return Country[]
   */
  public function getCountries()
  {
    return $this->countries;
  }
  public function setExcludeCountries($excludeCountries)
  {
    $this->excludeCountries = $excludeCountries;
  }
  public function getExcludeCountries()
  {
    return $this->excludeCountries;
  }
  /**
   * @param Metro[]
   */
  public function setMetros($metros)
  {
    $this->metros = $metros;
  }
  /**
   * @return Metro[]
   */
  public function getMetros()
  {
    return $this->metros;
  }
  /**
   * @param PostalCode[]
   */
  public function setPostalCodes($postalCodes)
  {
    $this->postalCodes = $postalCodes;
  }
  /**
   * @return PostalCode[]
   */
  public function getPostalCodes()
  {
    return $this->postalCodes;
  }
  /**
   * @param Region[]
   */
  public function setRegions($regions)
  {
    $this->regions = $regions;
  }
  /**
   * @return Region[]
   */
  public function getRegions()
  {
    return $this->regions;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GeoTargeting::class, 'Google_Service_Dfareporting_GeoTargeting');
