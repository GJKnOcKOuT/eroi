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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\partnershipprofiles\models\ExpressionsOfInterest;
use yii\db\Migration;

/**
 * Class m180119_084537_add_expressions_of_interest_field_user_network_reference_id
 */
class m180119_084537_add_expressions_of_interest_field_user_network_reference_id extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(ExpressionsOfInterest::tableName(), 'user_network_reference_classname', $this->string()->null()->defaultValue(null)->after('partnership_profile_id')->comment('User Network Reference Classname'));
        $this->addColumn(ExpressionsOfInterest::tableName(), 'user_network_reference_id', $this->integer()->null()->defaultValue(null)->after('user_network_reference_classname')->comment('User Network Reference Id'));
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(ExpressionsOfInterest::tableName(), 'user_network_reference_classname');
        $this->dropColumn(ExpressionsOfInterest::tableName(), 'user_network_reference_id');
        return true;
    }
}
