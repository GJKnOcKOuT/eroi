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

namespace Google\Service\AdSenseHost;

class AdUnit extends \Google\Model
{
  public $code;
  protected $contentAdsSettingsType = AdUnitContentAdsSettings::class;
  protected $contentAdsSettingsDataType = '';
  protected $customStyleType = AdStyle::class;
  protected $customStyleDataType = '';
  public $id;
  public $kind;
  protected $mobileContentAdsSettingsType = AdUnitMobileContentAdsSettings::class;
  protected $mobileContentAdsSettingsDataType = '';
  public $name;
  public $status;

  public function setCode($code)
  {
    $this->code = $code;
  }
  public function getCode()
  {
    return $this->code;
  }
  /**
   * @param AdUnitContentAdsSettings
   */
  public function setContentAdsSettings(AdUnitContentAdsSettings $contentAdsSettings)
  {
    $this->contentAdsSettings = $contentAdsSettings;
  }
  /**
   * @return AdUnitContentAdsSettings
   */
  public function getContentAdsSettings()
  {
    return $this->contentAdsSettings;
  }
  /**
   * @param AdStyle
   */
  public function setCustomStyle(AdStyle $customStyle)
  {
    $this->customStyle = $customStyle;
  }
  /**
   * @return AdStyle
   */
  public function getCustomStyle()
  {
    return $this->customStyle;
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
   * @param AdUnitMobileContentAdsSettings
   */
  public function setMobileContentAdsSettings(AdUnitMobileContentAdsSettings $mobileContentAdsSettings)
  {
    $this->mobileContentAdsSettings = $mobileContentAdsSettings;
  }
  /**
   * @return AdUnitMobileContentAdsSettings
   */
  public function getMobileContentAdsSettings()
  {
    return $this->mobileContentAdsSettings;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setStatus($status)
  {
    $this->status = $status;
  }
  public function getStatus()
  {
    return $this->status;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(AdUnit::class, 'Google_Service_AdSenseHost_AdUnit');
