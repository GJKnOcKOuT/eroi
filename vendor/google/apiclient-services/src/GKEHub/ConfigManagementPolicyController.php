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

namespace Google\Service\GKEHub;

class ConfigManagementPolicyController extends \Google\Collection
{
  protected $collection_key = 'exemptableNamespaces';
  public $auditIntervalSeconds;
  public $enabled;
  public $exemptableNamespaces;
  public $logDeniesEnabled;
  public $referentialRulesEnabled;
  public $templateLibraryInstalled;

  public function setAuditIntervalSeconds($auditIntervalSeconds)
  {
    $this->auditIntervalSeconds = $auditIntervalSeconds;
  }
  public function getAuditIntervalSeconds()
  {
    return $this->auditIntervalSeconds;
  }
  public function setEnabled($enabled)
  {
    $this->enabled = $enabled;
  }
  public function getEnabled()
  {
    return $this->enabled;
  }
  public function setExemptableNamespaces($exemptableNamespaces)
  {
    $this->exemptableNamespaces = $exemptableNamespaces;
  }
  public function getExemptableNamespaces()
  {
    return $this->exemptableNamespaces;
  }
  public function setLogDeniesEnabled($logDeniesEnabled)
  {
    $this->logDeniesEnabled = $logDeniesEnabled;
  }
  public function getLogDeniesEnabled()
  {
    return $this->logDeniesEnabled;
  }
  public function setReferentialRulesEnabled($referentialRulesEnabled)
  {
    $this->referentialRulesEnabled = $referentialRulesEnabled;
  }
  public function getReferentialRulesEnabled()
  {
    return $this->referentialRulesEnabled;
  }
  public function setTemplateLibraryInstalled($templateLibraryInstalled)
  {
    $this->templateLibraryInstalled = $templateLibraryInstalled;
  }
  public function getTemplateLibraryInstalled()
  {
    return $this->templateLibraryInstalled;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(ConfigManagementPolicyController::class, 'Google_Service_GKEHub_ConfigManagementPolicyController');
