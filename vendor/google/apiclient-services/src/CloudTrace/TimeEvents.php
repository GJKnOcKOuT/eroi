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

namespace Google\Service\CloudTrace;

class TimeEvents extends \Google\Collection
{
  protected $collection_key = 'timeEvent';
  public $droppedAnnotationsCount;
  public $droppedMessageEventsCount;
  protected $timeEventType = TimeEvent::class;
  protected $timeEventDataType = 'array';

  public function setDroppedAnnotationsCount($droppedAnnotationsCount)
  {
    $this->droppedAnnotationsCount = $droppedAnnotationsCount;
  }
  public function getDroppedAnnotationsCount()
  {
    return $this->droppedAnnotationsCount;
  }
  public function setDroppedMessageEventsCount($droppedMessageEventsCount)
  {
    $this->droppedMessageEventsCount = $droppedMessageEventsCount;
  }
  public function getDroppedMessageEventsCount()
  {
    return $this->droppedMessageEventsCount;
  }
  /**
   * @param TimeEvent[]
   */
  public function setTimeEvent($timeEvent)
  {
    $this->timeEvent = $timeEvent;
  }
  /**
   * @return TimeEvent[]
   */
  public function getTimeEvent()
  {
    return $this->timeEvent;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(TimeEvents::class, 'Google_Service_CloudTrace_TimeEvents');
