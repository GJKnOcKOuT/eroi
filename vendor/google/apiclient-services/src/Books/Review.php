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

namespace Google\Service\Books;

class Review extends \Google\Model
{
  protected $authorType = ReviewAuthor::class;
  protected $authorDataType = '';
  public $content;
  public $date;
  public $fullTextUrl;
  public $kind;
  public $rating;
  protected $sourceType = ReviewSource::class;
  protected $sourceDataType = '';
  public $title;
  public $type;
  public $volumeId;

  /**
   * @param ReviewAuthor
   */
  public function setAuthor(ReviewAuthor $author)
  {
    $this->author = $author;
  }
  /**
   * @return ReviewAuthor
   */
  public function getAuthor()
  {
    return $this->author;
  }
  public function setContent($content)
  {
    $this->content = $content;
  }
  public function getContent()
  {
    return $this->content;
  }
  public function setDate($date)
  {
    $this->date = $date;
  }
  public function getDate()
  {
    return $this->date;
  }
  public function setFullTextUrl($fullTextUrl)
  {
    $this->fullTextUrl = $fullTextUrl;
  }
  public function getFullTextUrl()
  {
    return $this->fullTextUrl;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setRating($rating)
  {
    $this->rating = $rating;
  }
  public function getRating()
  {
    return $this->rating;
  }
  /**
   * @param ReviewSource
   */
  public function setSource(ReviewSource $source)
  {
    $this->source = $source;
  }
  /**
   * @return ReviewSource
   */
  public function getSource()
  {
    return $this->source;
  }
  public function setTitle($title)
  {
    $this->title = $title;
  }
  public function getTitle()
  {
    return $this->title;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  public function setVolumeId($volumeId)
  {
    $this->volumeId = $volumeId;
  }
  public function getVolumeId()
  {
    return $this->volumeId;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Review::class, 'Google_Service_Books_Review');
