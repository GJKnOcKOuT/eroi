<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\rbac\DbManagerCached;
use yii\db\Migration;

/**
 * Class m200207_170256_revoke_validator_permissions
 */
class m200207_170256_revoke_validator_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        /** @var DbManagerCached $authManager */
        $authManager = Yii::$app->authManager;
        $validatoreNewsRole = $authManager->getRole('VALIDATORE_NEWS');
        $validatorRole = $authManager->getRole('VALIDATOR');
        $authManager->revoke($validatorRole, 1);
        $authManager->revoke($validatorRole, 127);
        $authManager->revoke($validatoreNewsRole, 1);
        $authManager->revoke($validatoreNewsRole, 5);
        $authManager->revoke($validatoreNewsRole, 32);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200207_170256_revoke_validator_permissions cannot be reverted.\n";
        return false;
    }
}
