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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m160908_141702_add_cwh_rules extends Migration
{

    public $rules = [
        [
            'label' => 'Create',
            'name' => 'CREATE'
        ],
        [
            'label' => 'Validate',
            'name' => 'VALIDATE'
        ],
    ];

    public function safeUp()
    {
        $cwhModule = Yii::$app->getModule('cwh');

        if (!$cwhModule || !count(Yii::$app->getModule('cwh')->modelsEnabled)) {
            //throw new \yii\base\InvalidConfigException(\arter\amos\cwh\AmosCwh::t('amoscwh', 'Impossibile configurare le regole della CWH : modelsEnabled deve essere valorizzato'));
        }

        $auth = \Yii::$app->getAuthManager();
        foreach ((array) $cwhModule->modelsEnabled as $model) {
            foreach ($this->rules as $rule) {
                $permissionName = $cwhModule->permissionPrefix . "_" . $rule['name'] . "_" . $model;
                if (is_null($auth->getPermission($permissionName))) {
                    echo "\nCreating cwh rule ".$permissionName;
                    $permissionCwhModel = $auth->createPermission($permissionName);
                    $permissionCwhModel->description = "{$rule['label']} {$model}";

                    $auth->add($permissionCwhModel);
                }else{
                    echo "\nAlready exists cwh rule ".$permissionName;
                }
            }
        }
        echo "\n";
        return true;

    }

    public function safeDown()
    {
        return true;
    }


}
