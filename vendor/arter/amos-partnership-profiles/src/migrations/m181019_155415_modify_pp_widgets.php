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


use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `een_partnership_proposal`.
 */
class m181019_155415_modify_pp_widgets extends Migration
{
    const TABLE = "amos_widgets";
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(self::TABLE, ['child_of' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral'], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral'], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestAllAdmin', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral'], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral'], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAllAdmin', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboardGeneral'], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard', 'module' => 'partnershipprofiles']);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->update(self::TABLE, ['child_of' => null], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnerProfExprOfIntDashboard', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => null], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestAllAdmin', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => null], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconExpressionsOfInterestDashboard', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => null ], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesAllAdmin', 'module' => 'partnershipprofiles']);
        $this->update(self::TABLE, ['child_of' => null], ['classname' => 'arter\amos\partnershipprofiles\widgets\icons\WidgetIconPartnershipProfilesDashboard', 'module' => 'partnershipprofiles']);


    }
}
