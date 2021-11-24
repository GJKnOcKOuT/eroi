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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;

/**
 * Class m170301_170446_reset_community_status
 *
 * if present in db any status not null from those defined in community workflow reset status to Draft
 */
class m170301_170446_reset_community_status extends \yii\db\Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->update(Community::tableName(), ['status' => Community::COMMUNITY_WORKFLOW_STATUS_DRAFT] , 'status is not null' );
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "No need of safe down method implementation";
        return true;
    }
}
