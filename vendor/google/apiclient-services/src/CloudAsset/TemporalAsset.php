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

namespace Google\Service\CloudAsset;

class TemporalAsset extends \Google\Model
{
  protected $assetType = Asset::class;
  protected $assetDataType = '';
  public $deleted;
  protected $priorAssetType = Asset::class;
  protected $priorAssetDataType = '';
  public $priorAssetState;
  protected $windowType = TimeWindow::class;
  protected $windowDataType = '';

  /**
   * @param Asset
   */
  public function setAsset(Asset $asset)
  {
    $this->asset = $asset;
  }
  /**
   * @return Asset
   */
  public function getAsset()
  {
    return $this->asset;
  }
  public function setDeleted($deleted)
  {
    $this->deleted = $deleted;
  }
  public function getDeleted()
  {
    return $this->deleted;
  }
  /**
   * @param Asset
   */
  public function setPriorAsset(Asset $priorAsset)
  {
    $this->priorAsset = $priorAsset;
  }
  /**
   * @return Asset
   */
  public function getPriorAsset()
  {
    return $this->priorAsset;
  }
  public function setPriorAssetState($priorAssetState)
  {
    $this->priorAssetState = $priorAssetState;
  }
  public function getPriorAssetState()
  {
    return $this->priorAssetState;
  }
  /**
   * @param TimeWindow
   */
  public function setWindow(TimeWindow $window)
  {
    $this->window = $window;
  }
  /**
   * @return TimeWindow
   */
  public function getWindow()
  {
    return $this->window;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TemporalAsset::class, 'Google_Service_CloudAsset_TemporalAsset');
