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

class ExecutionStageSummary extends \Google\Collection
{
  protected $collection_key = 'prerequisiteStage';
  protected $componentSourceType = ComponentSource::class;
  protected $componentSourceDataType = 'array';
  protected $componentTransformType = ComponentTransform::class;
  protected $componentTransformDataType = 'array';
  public $id;
  protected $inputSourceType = StageSource::class;
  protected $inputSourceDataType = 'array';
  public $kind;
  public $name;
  protected $outputSourceType = StageSource::class;
  protected $outputSourceDataType = 'array';
  public $prerequisiteStage;

  /**
   * @param ComponentSource[]
   */
  public function setComponentSource($componentSource)
  {
    $this->componentSource = $componentSource;
  }
  /**
   * @return ComponentSource[]
   */
  public function getComponentSource()
  {
    return $this->componentSource;
  }
  /**
   * @param ComponentTransform[]
   */
  public function setComponentTransform($componentTransform)
  {
    $this->componentTransform = $componentTransform;
  }
  /**
   * @return ComponentTransform[]
   */
  public function getComponentTransform()
  {
    return $this->componentTransform;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param StageSource[]
   */
  public function setInputSource($inputSource)
  {
    $this->inputSource = $inputSource;
  }
  /**
   * @return StageSource[]
   */
  public function getInputSource()
  {
    return $this->inputSource;
  }
  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param StageSource[]
   */
  public function setOutputSource($outputSource)
  {
    $this->outputSource = $outputSource;
  }
  /**
   * @return StageSource[]
   */
  public function getOutputSource()
  {
    return $this->outputSource;
  }
  public function setPrerequisiteStage($prerequisiteStage)
  {
    $this->prerequisiteStage = $prerequisiteStage;
  }
  public function getPrerequisiteStage()
  {
    return $this->prerequisiteStage;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ExecutionStageSummary::class, 'Google_Service_Dataflow_ExecutionStageSummary');
