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
 * @package    arter\amos\cwh\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\cwh\models\CwhConfig;
use arter\amos\cwh\utility\CwhUtil;
use yii\db\Migration;

/**
 * Class m180802_162304_add_cwh_permissions_network_publications
 */
class m180802_162304_add_cwh_permissions_network_publications extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
//        $this->execute('CREATE TABLE ' . \arter\amos\cwh\models\CwhAuthAssignment::tableName().'_bk' . ' LIKE ' . \arter\amos\cwh\models\CwhAuthAssignment::tableName());
//        $this->execute('INSERT INTO ' . \arter\amos\cwh\models\CwhAuthAssignment::tableName().'_bk'. ' (SELECT * FROM ' . \arter\amos\cwh\models\CwhAuthAssignment::tableName(). ')');
        /** @var arter\amos\cwh\AmosCwh $moduleCwh */
        $moduleCwh = Yii::$app->getModule('cwh');
        if (!empty($moduleCwh)) {
            $cwhConfigs = CwhConfig::find()->andWhere(['not', ['tablename' => 'user']])->all();
            foreach ($cwhConfigs as $cwhConfig) {
                $networkObject = Yii::createObject($cwhConfig->classname);
                $mmObjectClassname = $networkObject->getMmClassName();
                echo "Adding cwh permission for network type: " . $networkObject->formName() . "\n";
                $networks = $networkObject->find()->all();
                foreach ($networks as $network) {
                    echo $cwhConfig->tablename . " " . $network->id . ": ";
                    $userNetworkMms = $mmObjectClassname::find()->andWhere([$networkObject->getMmNetworkIdFieldName() => $network->id])->all();
                    $membersCount = count($userNetworkMms);
                    echo $membersCount . " members\n";
                    foreach ($userNetworkMms as $userNetworkMm) {
                        CwhUtil::setCwhAuthAssignments($network, $userNetworkMm);
                    }
                }
            }
            return true;
        } else {
            echo "cwh module not found";
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m180802_162304_add_cwh_permissions_network_publications data will not be reverted\n";
        return true;
    }
}
