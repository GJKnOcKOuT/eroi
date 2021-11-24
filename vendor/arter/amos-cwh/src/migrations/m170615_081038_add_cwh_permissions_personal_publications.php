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
use arter\amos\core\user\User;
use arter\amos\cwh\models\CwhAuthAssignment;

/**
 * For each platform user add cwh permissions to create contents in personal scope; redactor user will be the validator of all these contents
 *
 * Class m170615_081038_add_cwh_permissions_personal_publications
 */
class m170615_081038_add_cwh_permissions_personal_publications extends Migration
{
    public function safeUp()
    {
        /** @var arter\amos\cwh\AmosCwh $moduleCwh */
        $moduleCwh = Yii::$app->getModule('cwh');
        if(!empty($moduleCwh)){
            $userIds = User::find()->select('id')->all();
            foreach ($userIds as $userId){
                $cwhNodiId = 'user-'.$userId->id;
                foreach ($moduleCwh->modelsEnabled as $contentModel){
                    $permissionCreateArray = [
                        'item_name' => $moduleCwh->permissionPrefix . "_CREATE_".$contentModel,
                        'user_id' => $userId->id,
                        'cwh_nodi_id' => $cwhNodiId
                    ];
                    $cwhAssignCreate = CwhAuthAssignment::findOne($permissionCreateArray);
                    if(empty($cwhAssignCreate)){
                        $cwhAssignCreate = new CwhAuthAssignment($permissionCreateArray);
                        $cwhAssignCreate->detachBehaviors();
                        $cwhAssignCreate->save(false);
                    }
                }
            }
            return true;
        } else {
            echo "cwh module not found";
            return false;
        }

    }

    public function safeDown()
    {
        echo "m170615_081038_add_cwh_permissions_personal_pubblications cannot be reverted.\n";

        return false;
    }
}
