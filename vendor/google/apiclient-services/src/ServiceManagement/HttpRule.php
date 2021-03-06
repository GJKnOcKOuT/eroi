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

namespace Google\Service\ServiceManagement;

class HttpRule extends \Google\Collection
{
  protected $collection_key = 'additionalBindings';
  protected $additionalBindingsType = HttpRule::class;
  protected $additionalBindingsDataType = 'array';
  public $body;
  protected $customType = CustomHttpPattern::class;
  protected $customDataType = '';
  public $delete;
  public $get;
  public $patch;
  public $post;
  public $put;
  public $responseBody;
  public $selector;

  /**
   * @param HttpRule[]
   */
  public function setAdditionalBindings($additionalBindings)
  {
    $this->additionalBindings = $additionalBindings;
  }
  /**
   * @return HttpRule[]
   */
  public function getAdditionalBindings()
  {
    return $this->additionalBindings;
  }
  public function setBody($body)
  {
    $this->body = $body;
  }
  public function getBody()
  {
    return $this->body;
  }
  /**
   * @param CustomHttpPattern
   */
  public function setCustom(CustomHttpPattern $custom)
  {
    $this->custom = $custom;
  }
  /**
   * @return CustomHttpPattern
   */
  public function getCustom()
  {
    return $this->custom;
  }
  public function setDelete($delete)
  {
    $this->delete = $delete;
  }
  public function getDelete()
  {
    return $this->delete;
  }
  public function setGet($get)
  {
    $this->get = $get;
  }
  public function getGet()
  {
    return $this->get;
  }
  public function setPatch($patch)
  {
    $this->patch = $patch;
  }
  public function getPatch()
  {
    return $this->patch;
  }
  public function setPost($post)
  {
    $this->post = $post;
  }
  public function getPost()
  {
    return $this->post;
  }
  public function setPut($put)
  {
    $this->put = $put;
  }
  public function getPut()
  {
    return $this->put;
  }
  public function setResponseBody($responseBody)
  {
    $this->responseBody = $responseBody;
  }
  public function getResponseBody()
  {
    return $this->responseBody;
  }
  public function setSelector($selector)
  {
    $this->selector = $selector;
  }
  public function getSelector()
  {
    return $this->selector;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HttpRule::class, 'Google_Service_ServiceManagement_HttpRule');
