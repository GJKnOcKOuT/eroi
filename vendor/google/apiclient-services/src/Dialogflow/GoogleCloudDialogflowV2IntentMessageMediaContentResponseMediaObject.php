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

namespace Google\Service\Dialogflow;

class GoogleCloudDialogflowV2IntentMessageMediaContentResponseMediaObject extends \Google\Model
{
  public $contentUrl;
  public $description;
  protected $iconType = GoogleCloudDialogflowV2IntentMessageImage::class;
  protected $iconDataType = '';
  protected $largeImageType = GoogleCloudDialogflowV2IntentMessageImage::class;
  protected $largeImageDataType = '';
  public $name;

  public function setContentUrl($contentUrl)
  {
    $this->contentUrl = $contentUrl;
  }
  public function getContentUrl()
  {
    return $this->contentUrl;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentMessageImage
   */
  public function setIcon(GoogleCloudDialogflowV2IntentMessageImage $icon)
  {
    $this->icon = $icon;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentMessageImage
   */
  public function getIcon()
  {
    return $this->icon;
  }
  /**
   * @param GoogleCloudDialogflowV2IntentMessageImage
   */
  public function setLargeImage(GoogleCloudDialogflowV2IntentMessageImage $largeImage)
  {
    $this->largeImage = $largeImage;
  }
  /**
   * @return GoogleCloudDialogflowV2IntentMessageImage
   */
  public function getLargeImage()
  {
    return $this->largeImage;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDialogflowV2IntentMessageMediaContentResponseMediaObject::class, 'Google_Service_Dialogflow_GoogleCloudDialogflowV2IntentMessageMediaContentResponseMediaObject');
