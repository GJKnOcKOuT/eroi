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

namespace Google\Service\DataCatalog;

class GoogleCloudDatacatalogV1FieldType extends \Google\Model
{
  protected $enumTypeType = GoogleCloudDatacatalogV1FieldTypeEnumType::class;
  protected $enumTypeDataType = '';
  public $primitiveType;

  /**
   * @param GoogleCloudDatacatalogV1FieldTypeEnumType
   */
  public function setEnumType(GoogleCloudDatacatalogV1FieldTypeEnumType $enumType)
  {
    $this->enumType = $enumType;
  }
  /**
   * @return GoogleCloudDatacatalogV1FieldTypeEnumType
   */
  public function getEnumType()
  {
    return $this->enumType;
  }
  public function setPrimitiveType($primitiveType)
  {
    $this->primitiveType = $primitiveType;
  }
  public function getPrimitiveType()
  {
    return $this->primitiveType;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudDatacatalogV1FieldType::class, 'Google_Service_DataCatalog_GoogleCloudDatacatalogV1FieldType');
