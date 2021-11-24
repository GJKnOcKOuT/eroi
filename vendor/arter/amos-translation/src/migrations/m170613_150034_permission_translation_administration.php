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
 * @package    arter\amos\translation\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * Class m170613_150034_permission_translation_administration
 */
class m170613_150034_permission_translation_administration extends \yii\db\Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $roleAdmin = Yii::$app->authManager->getRole('ADMIN');
        $permTranslAdm = Yii::$app->authManager->getPermission('TRANSLATION_ADMINISTRATOR');
        if (!(Yii::$app->authManager->hasChild($roleAdmin, $permTranslAdm))) {
            Yii::$app->authManager->addChild($roleAdmin, $permTranslAdm);
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $roleAdmin = Yii::$app->authManager->getRole('ADMIN');
        $permTranslAdm = Yii::$app->authManager->getPermission('TRANSLATION_ADMINISTRATOR');
        Yii::$app->authManager->removeChild($roleAdmin, $permTranslAdm);
    }
}
