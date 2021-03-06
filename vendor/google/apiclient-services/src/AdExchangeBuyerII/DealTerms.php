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

namespace Google\Service\AdExchangeBuyerII;

class DealTerms extends \Google\Model
{
  public $brandingType;
  public $description;
  protected $estimatedGrossSpendType = Price::class;
  protected $estimatedGrossSpendDataType = '';
  public $estimatedImpressionsPerDay;
  protected $guaranteedFixedPriceTermsType = GuaranteedFixedPriceTerms::class;
  protected $guaranteedFixedPriceTermsDataType = '';
  protected $nonGuaranteedAuctionTermsType = NonGuaranteedAuctionTerms::class;
  protected $nonGuaranteedAuctionTermsDataType = '';
  protected $nonGuaranteedFixedPriceTermsType = NonGuaranteedFixedPriceTerms::class;
  protected $nonGuaranteedFixedPriceTermsDataType = '';
  public $sellerTimeZone;

  public function setBrandingType($brandingType)
  {
    $this->brandingType = $brandingType;
  }
  public function getBrandingType()
  {
    return $this->brandingType;
  }
  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  /**
   * @param Price
   */
  public function setEstimatedGrossSpend(Price $estimatedGrossSpend)
  {
    $this->estimatedGrossSpend = $estimatedGrossSpend;
  }
  /**
   * @return Price
   */
  public function getEstimatedGrossSpend()
  {
    return $this->estimatedGrossSpend;
  }
  public function setEstimatedImpressionsPerDay($estimatedImpressionsPerDay)
  {
    $this->estimatedImpressionsPerDay = $estimatedImpressionsPerDay;
  }
  public function getEstimatedImpressionsPerDay()
  {
    return $this->estimatedImpressionsPerDay;
  }
  /**
   * @param GuaranteedFixedPriceTerms
   */
  public function setGuaranteedFixedPriceTerms(GuaranteedFixedPriceTerms $guaranteedFixedPriceTerms)
  {
    $this->guaranteedFixedPriceTerms = $guaranteedFixedPriceTerms;
  }
  /**
   * @return GuaranteedFixedPriceTerms
   */
  public function getGuaranteedFixedPriceTerms()
  {
    return $this->guaranteedFixedPriceTerms;
  }
  /**
   * @param NonGuaranteedAuctionTerms
   */
  public function setNonGuaranteedAuctionTerms(NonGuaranteedAuctionTerms $nonGuaranteedAuctionTerms)
  {
    $this->nonGuaranteedAuctionTerms = $nonGuaranteedAuctionTerms;
  }
  /**
   * @return NonGuaranteedAuctionTerms
   */
  public function getNonGuaranteedAuctionTerms()
  {
    return $this->nonGuaranteedAuctionTerms;
  }
  /**
   * @param NonGuaranteedFixedPriceTerms
   */
  public function setNonGuaranteedFixedPriceTerms(NonGuaranteedFixedPriceTerms $nonGuaranteedFixedPriceTerms)
  {
    $this->nonGuaranteedFixedPriceTerms = $nonGuaranteedFixedPriceTerms;
  }
  /**
   * @return NonGuaranteedFixedPriceTerms
   */
  public function getNonGuaranteedFixedPriceTerms()
  {
    return $this->nonGuaranteedFixedPriceTerms;
  }
  public function setSellerTimeZone($sellerTimeZone)
  {
    $this->sellerTimeZone = $sellerTimeZone;
  }
  public function getSellerTimeZone()
  {
    return $this->sellerTimeZone;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DealTerms::class, 'Google_Service_AdExchangeBuyerII_DealTerms');
