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

namespace Google\Service\ToolResults;

class GraphicsStats extends \Google\Collection
{
  protected $collection_key = 'buckets';
  protected $bucketsType = GraphicsStatsBucket::class;
  protected $bucketsDataType = 'array';
  public $highInputLatencyCount;
  public $jankyFrames;
  public $missedVsyncCount;
  public $p50Millis;
  public $p90Millis;
  public $p95Millis;
  public $p99Millis;
  public $slowBitmapUploadCount;
  public $slowDrawCount;
  public $slowUiThreadCount;
  public $totalFrames;

  /**
   * @param GraphicsStatsBucket[]
   */
  public function setBuckets($buckets)
  {
    $this->buckets = $buckets;
  }
  /**
   * @return GraphicsStatsBucket[]
   */
  public function getBuckets()
  {
    return $this->buckets;
  }
  public function setHighInputLatencyCount($highInputLatencyCount)
  {
    $this->highInputLatencyCount = $highInputLatencyCount;
  }
  public function getHighInputLatencyCount()
  {
    return $this->highInputLatencyCount;
  }
  public function setJankyFrames($jankyFrames)
  {
    $this->jankyFrames = $jankyFrames;
  }
  public function getJankyFrames()
  {
    return $this->jankyFrames;
  }
  public function setMissedVsyncCount($missedVsyncCount)
  {
    $this->missedVsyncCount = $missedVsyncCount;
  }
  public function getMissedVsyncCount()
  {
    return $this->missedVsyncCount;
  }
  public function setP50Millis($p50Millis)
  {
    $this->p50Millis = $p50Millis;
  }
  public function getP50Millis()
  {
    return $this->p50Millis;
  }
  public function setP90Millis($p90Millis)
  {
    $this->p90Millis = $p90Millis;
  }
  public function getP90Millis()
  {
    return $this->p90Millis;
  }
  public function setP95Millis($p95Millis)
  {
    $this->p95Millis = $p95Millis;
  }
  public function getP95Millis()
  {
    return $this->p95Millis;
  }
  public function setP99Millis($p99Millis)
  {
    $this->p99Millis = $p99Millis;
  }
  public function getP99Millis()
  {
    return $this->p99Millis;
  }
  public function setSlowBitmapUploadCount($slowBitmapUploadCount)
  {
    $this->slowBitmapUploadCount = $slowBitmapUploadCount;
  }
  public function getSlowBitmapUploadCount()
  {
    return $this->slowBitmapUploadCount;
  }
  public function setSlowDrawCount($slowDrawCount)
  {
    $this->slowDrawCount = $slowDrawCount;
  }
  public function getSlowDrawCount()
  {
    return $this->slowDrawCount;
  }
  public function setSlowUiThreadCount($slowUiThreadCount)
  {
    $this->slowUiThreadCount = $slowUiThreadCount;
  }
  public function getSlowUiThreadCount()
  {
    return $this->slowUiThreadCount;
  }
  public function setTotalFrames($totalFrames)
  {
    $this->totalFrames = $totalFrames;
  }
  public function getTotalFrames()
  {
    return $this->totalFrames;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GraphicsStats::class, 'Google_Service_ToolResults_GraphicsStats');
