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

namespace Google\Service\CloudBillingBudget;

class GoogleCloudBillingBudgetsV1Budget extends \Google\Collection
{
  protected $collection_key = 'thresholdRules';
  protected $amountType = GoogleCloudBillingBudgetsV1BudgetAmount::class;
  protected $amountDataType = '';
  protected $budgetFilterType = GoogleCloudBillingBudgetsV1Filter::class;
  protected $budgetFilterDataType = '';
  public $displayName;
  public $etag;
  public $name;
  protected $notificationsRuleType = GoogleCloudBillingBudgetsV1NotificationsRule::class;
  protected $notificationsRuleDataType = '';
  protected $thresholdRulesType = GoogleCloudBillingBudgetsV1ThresholdRule::class;
  protected $thresholdRulesDataType = 'array';

  /**
   * @param GoogleCloudBillingBudgetsV1BudgetAmount
   */
  public function setAmount(GoogleCloudBillingBudgetsV1BudgetAmount $amount)
  {
    $this->amount = $amount;
  }
  /**
   * @return GoogleCloudBillingBudgetsV1BudgetAmount
   */
  public function getAmount()
  {
    return $this->amount;
  }
  /**
   * @param GoogleCloudBillingBudgetsV1Filter
   */
  public function setBudgetFilter(GoogleCloudBillingBudgetsV1Filter $budgetFilter)
  {
    $this->budgetFilter = $budgetFilter;
  }
  /**
   * @return GoogleCloudBillingBudgetsV1Filter
   */
  public function getBudgetFilter()
  {
    return $this->budgetFilter;
  }
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
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param GoogleCloudBillingBudgetsV1NotificationsRule
   */
  public function setNotificationsRule(GoogleCloudBillingBudgetsV1NotificationsRule $notificationsRule)
  {
    $this->notificationsRule = $notificationsRule;
  }
  /**
   * @return GoogleCloudBillingBudgetsV1NotificationsRule
   */
  public function getNotificationsRule()
  {
    return $this->notificationsRule;
  }
  /**
   * @param GoogleCloudBillingBudgetsV1ThresholdRule[]
   */
  public function setThresholdRules($thresholdRules)
  {
    $this->thresholdRules = $thresholdRules;
  }
  /**
   * @return GoogleCloudBillingBudgetsV1ThresholdRule[]
   */
  public function getThresholdRules()
  {
    return $this->thresholdRules;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(GoogleCloudBillingBudgetsV1Budget::class, 'Google_Service_CloudBillingBudget_GoogleCloudBillingBudgetsV1Budget');
