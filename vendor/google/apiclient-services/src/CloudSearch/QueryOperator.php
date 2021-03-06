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

namespace Google\Service\CloudSearch;

class QueryOperator extends \Google\Collection
{
  protected $collection_key = 'enumValues';
  public $displayName;
  public $enumValues;
  public $greaterThanOperatorName;
  public $isFacetable;
  public $isRepeatable;
  public $isReturnable;
  public $isSortable;
  public $isSuggestable;
  public $lessThanOperatorName;
  public $objectType;
  public $operatorName;
  public $type;

  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setEnumValues($enumValues)
  {
    $this->enumValues = $enumValues;
  }
  public function getEnumValues()
  {
    return $this->enumValues;
  }
  public function setGreaterThanOperatorName($greaterThanOperatorName)
  {
    $this->greaterThanOperatorName = $greaterThanOperatorName;
  }
  public function getGreaterThanOperatorName()
  {
    return $this->greaterThanOperatorName;
  }
  public function setIsFacetable($isFacetable)
  {
    $this->isFacetable = $isFacetable;
  }
  public function getIsFacetable()
  {
    return $this->isFacetable;
  }
  public function setIsRepeatable($isRepeatable)
  {
    $this->isRepeatable = $isRepeatable;
  }
  public function getIsRepeatable()
  {
    return $this->isRepeatable;
  }
  public function setIsReturnable($isReturnable)
  {
    $this->isReturnable = $isReturnable;
  }
  public function getIsReturnable()
  {
    return $this->isReturnable;
  }
  public function setIsSortable($isSortable)
  {
    $this->isSortable = $isSortable;
  }
  public function getIsSortable()
  {
    return $this->isSortable;
  }
  public function setIsSuggestable($isSuggestable)
  {
    $this->isSuggestable = $isSuggestable;
  }
  public function getIsSuggestable()
  {
    return $this->isSuggestable;
  }
  public function setLessThanOperatorName($lessThanOperatorName)
  {
    $this->lessThanOperatorName = $lessThanOperatorName;
  }
  public function getLessThanOperatorName()
  {
    return $this->lessThanOperatorName;
  }
  public function setObjectType($objectType)
  {
    $this->objectType = $objectType;
  }
  public function getObjectType()
  {
    return $this->objectType;
  }
  public function setOperatorName($operatorName)
  {
    $this->operatorName = $operatorName;
  }
  public function getOperatorName()
  {
    return $this->operatorName;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(QueryOperator::class, 'Google_Service_CloudSearch_QueryOperator');
