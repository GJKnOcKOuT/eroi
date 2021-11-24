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

namespace Google\Service\CloudLifeSciences;

class Metadata extends \Google\Collection
{
  protected $collection_key = 'events';
  public $createTime;
  public $endTime;
  protected $eventsType = Event::class;
  protected $eventsDataType = 'array';
  public $labels;
  protected $pipelineType = Pipeline::class;
  protected $pipelineDataType = '';
  public $pubSubTopic;
  public $startTime;

  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  public function setEndTime($endTime)
  {
    $this->endTime = $endTime;
  }
  public function getEndTime()
  {
    return $this->endTime;
  }
  /**
   * @param Event[]
   */
  public function setEvents($events)
  {
    $this->events = $events;
  }
  /**
   * @return Event[]
   */
  public function getEvents()
  {
    return $this->events;
  }
  public function setLabels($labels)
  {
    $this->labels = $labels;
  }
  public function getLabels()
  {
    return $this->labels;
  }
  /**
   * @param Pipeline
   */
  public function setPipeline(Pipeline $pipeline)
  {
    $this->pipeline = $pipeline;
  }
  /**
   * @return Pipeline
   */
  public function getPipeline()
  {
    return $this->pipeline;
  }
  public function setPubSubTopic($pubSubTopic)
  {
    $this->pubSubTopic = $pubSubTopic;
  }
  public function getPubSubTopic()
  {
    return $this->pubSubTopic;
  }
  public function setStartTime($startTime)
  {
    $this->startTime = $startTime;
  }
  public function getStartTime()
  {
    return $this->startTime;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Metadata::class, 'Google_Service_CloudLifeSciences_Metadata');
