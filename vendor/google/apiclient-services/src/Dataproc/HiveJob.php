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

namespace Google\Service\Dataproc;

class HiveJob extends \Google\Collection
{
  protected $collection_key = 'jarFileUris';
  public $continueOnFailure;
  public $jarFileUris;
  public $properties;
  public $queryFileUri;
  protected $queryListType = QueryList::class;
  protected $queryListDataType = '';
  public $scriptVariables;

  public function setContinueOnFailure($continueOnFailure)
  {
    $this->continueOnFailure = $continueOnFailure;
  }
  public function getContinueOnFailure()
  {
    return $this->continueOnFailure;
  }
  public function setJarFileUris($jarFileUris)
  {
    $this->jarFileUris = $jarFileUris;
  }
  public function getJarFileUris()
  {
    return $this->jarFileUris;
  }
  public function setProperties($properties)
  {
    $this->properties = $properties;
  }
  public function getProperties()
  {
    return $this->properties;
  }
  public function setQueryFileUri($queryFileUri)
  {
    $this->queryFileUri = $queryFileUri;
  }
  public function getQueryFileUri()
  {
    return $this->queryFileUri;
  }
  /**
   * @param QueryList
   */
  public function setQueryList(QueryList $queryList)
  {
    $this->queryList = $queryList;
  }
  /**
   * @return QueryList
   */
  public function getQueryList()
  {
    return $this->queryList;
  }
  public function setScriptVariables($scriptVariables)
  {
    $this->scriptVariables = $scriptVariables;
  }
  public function getScriptVariables()
  {
    return $this->scriptVariables;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(HiveJob::class, 'Google_Service_Dataproc_HiveJob');
