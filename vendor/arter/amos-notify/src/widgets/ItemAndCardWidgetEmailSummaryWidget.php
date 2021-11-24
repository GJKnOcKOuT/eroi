<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\notificationmanager\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\widgets;

use arter\amos\core\forms\ItemAndCardHeaderWidget;

/**
 * Class ItemAndCardWidgetEmailSummaryWidget
 * @package arter\amos\notificationmanager\widgets
 */
class ItemAndCardWidgetEmailSummaryWidget extends ItemAndCardHeaderWidget
{
    /**
     * @var string $layout Widget view
     */
    public $layout = "@vendor/arter/amos-notify/src/views/email/item_and_card_header_widget_mail.php";
    
    /**
     * @var bool $showPrevalentPartnershipAndTargets
     */
    public $showPrevalentPartnershipAndTargets = false;
    
    /**
     * @var bool $absoluteUrlAvatar
     */
    public $absoluteUrlAvatar = true;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setPublicationDateNotPresent(true);
        parent::init();
    }
}
