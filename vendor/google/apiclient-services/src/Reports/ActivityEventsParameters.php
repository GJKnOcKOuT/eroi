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

namespace Google\Service\Reports;

class ActivityEventsParameters extends \Google\Collection
{
  protected $collection_key = 'multiValue';
  public $boolValue;
  public $intValue;
  protected $messageValueType = ActivityEventsParametersMessageValue::class;
  protected $messageValueDataType = '';
  public $multiIntValue;
  protected $multiMessageValueType = ActivityEventsParametersMultiMessageValue::class;
  protected $multiMessageValueDataType = 'array';
  public $multiValue;
  public $name;
  public $value;

  public function setBoolValue($boolValue)
  {
    $this->boolValue = $boolValue;
  }
  public function getBoolValue()
  {
    return $this->boolValue;
  }
  public function setIntValue($intValue)
  {
    $this->intValue = $intValue;
  }
  public function getIntValue()
  {
    return $this->intValue;
  }
  /**
   * @param ActivityEventsParametersMessageValue
   */
  public function setMessageValue(ActivityEventsParametersMessageValue $messageValue)
  {
    $this->messageValue = $messageValue;
  }
  /**
   * @return ActivityEventsParametersMessageValue
   */
  public function getMessageValue()
  {
    return $this->messageValue;
  }
  public function setMultiIntValue($multiIntValue)
  {
    $this->multiIntValue = $multiIntValue;
  }
  public function getMultiIntValue()
  {
    return $this->multiIntValue;
  }
  /**
   * @param ActivityEventsParametersMultiMessageValue[]
   */
  public function setMultiMessageValue($multiMessageValue)
  {
    $this->multiMessageValue = $multiMessageValue;
  }
  /**
   * @return ActivityEventsParametersMultiMessageValue[]
   */
  public function getMultiMessageValue()
  {
    return $this->multiMessageValue;
  }
  public function setMultiValue($multiValue)
  {
    $this->multiValue = $multiValue;
  }
  public function getMultiValue()
  {
    return $this->multiValue;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setValue($value)
  {
    $this->value = $value;
  }
  public function getValue()
  {
    return $this->value;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ActivityEventsParameters::class, 'Google_Service_Reports_ActivityEventsParameters');
