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

namespace Google\Service\Dataflow;

class MapTask extends \Google\Collection
{
  protected $collection_key = 'instructions';
  public $counterPrefix;
  protected $instructionsType = ParallelInstruction::class;
  protected $instructionsDataType = 'array';
  public $stageName;
  public $systemName;

  public function setCounterPrefix($counterPrefix)
  {
    $this->counterPrefix = $counterPrefix;
  }
  public function getCounterPrefix()
  {
    return $this->counterPrefix;
  }
  /**
   * @param ParallelInstruction[]
   */
  public function setInstructions($instructions)
  {
    $this->instructions = $instructions;
  }
  /**
   * @return ParallelInstruction[]
   */
  public function getInstructions()
  {
    return $this->instructions;
  }
  public function setStageName($stageName)
  {
    $this->stageName = $stageName;
  }
  public function getStageName()
  {
    return $this->stageName;
  }
  public function setSystemName($systemName)
  {
    $this->systemName = $systemName;
  }
  public function getSystemName()
  {
    return $this->systemName;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(MapTask::class, 'Google_Service_Dataflow_MapTask');
