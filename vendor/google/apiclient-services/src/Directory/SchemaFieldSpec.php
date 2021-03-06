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

namespace Google\Service\Directory;

class SchemaFieldSpec extends \Google\Model
{
  public $displayName;
  public $etag;
  public $fieldId;
  public $fieldName;
  public $fieldType;
  public $indexed;
  public $kind;
  public $multiValued;
  protected $numericIndexingSpecType = SchemaFieldSpecNumericIndexingSpec::class;
  protected $numericIndexingSpecDataType = '';
  public $readAccessType;

  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setEtag($etag)
  {
    $this->etag = $etag;
  }
  public function getEtag()
  {
    return $this->etag;
  }
  public function setFieldId($fieldId)
  {
    $this->fieldId = $fieldId;
  }
  public function getFieldId()
  {
    return $this->fieldId;
  }
  public function setFieldName($fieldName)
  {
    $this->fieldName = $fieldName;
  }
  public function getFieldName()
  {
    return $this->fieldName;
  }
  public function setFieldType($fieldType)
  {
    $this->fieldType = $fieldType;
  }
  public function getFieldType()
  {
    return $this->fieldType;
  }
  public function setIndexed($indexed)
  {
    $this->indexed = $indexed;
  }
  public function getIndexed()
  {
    return $this->indexed;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setMultiValued($multiValued)
  {
    $this->multiValued = $multiValued;
  }
  public function getMultiValued()
  {
    return $this->multiValued;
  }
  /**
   * @param SchemaFieldSpecNumericIndexingSpec
   */
  public function setNumericIndexingSpec(SchemaFieldSpecNumericIndexingSpec $numericIndexingSpec)
  {
    $this->numericIndexingSpec = $numericIndexingSpec;
  }
  /**
   * @return SchemaFieldSpecNumericIndexingSpec
   */
  public function getNumericIndexingSpec()
  {
    return $this->numericIndexingSpec;
  }
  public function setReadAccessType($readAccessType)
  {
    $this->readAccessType = $readAccessType;
  }
  public function getReadAccessType()
  {
    return $this->readAccessType;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(SchemaFieldSpec::class, 'Google_Service_Directory_SchemaFieldSpec');
