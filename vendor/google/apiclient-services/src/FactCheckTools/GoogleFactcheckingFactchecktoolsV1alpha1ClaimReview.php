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

namespace Google\Service\FactCheckTools;

class GoogleFactcheckingFactchecktoolsV1alpha1ClaimReview extends \Google\Model
{
  public $languageCode;
  protected $publisherType = GoogleFactcheckingFactchecktoolsV1alpha1Publisher::class;
  protected $publisherDataType = '';
  public $reviewDate;
  public $textualRating;
  public $title;
  public $url;

  public function setLanguageCode($languageCode)
  {
    $this->languageCode = $languageCode;
  }
  public function getLanguageCode()
  {
    return $this->languageCode;
  }
  /**
   * @param GoogleFactcheckingFactchecktoolsV1alpha1Publisher
   */
  public function setPublisher(GoogleFactcheckingFactchecktoolsV1alpha1Publisher $publisher)
  {
    $this->publisher = $publisher;
  }
  /**
   * @return GoogleFactcheckingFactchecktoolsV1alpha1Publisher
   */
  public function getPublisher()
  {
    return $this->publisher;
  }
  public function setReviewDate($reviewDate)
  {
    $this->reviewDate = $reviewDate;
  }
  public function getReviewDate()
  {
    return $this->reviewDate;
  }
  public function setTextualRating($textualRating)
  {
    $this->textualRating = $textualRating;
  }
  public function getTextualRating()
  {
    return $this->textualRating;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function setUrl($url)
  {
    $this->url = $url;
  }
  public function getUrl()
  {
    return $this->url;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleFactcheckingFactchecktoolsV1alpha1ClaimReview::class, 'Google_Service_FactCheckTools_GoogleFactcheckingFactchecktoolsV1alpha1ClaimReview');
