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


use arter\amos\core\migration\AmosMigration;
use arter\amos\sondaggi\models\Sondaggi;
use yii\rbac\Permission;

class m161209_102125_sondaggi_role_widget extends AmosMigration {

    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp() {
        return $this->addAuthorizations();
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown() {
        return $this->removeAuthorizations();
    }

    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations() {
        $this->authorizations = array_merge(
                $this->setWidgetsPermissions()
        );
    }

    /**
     * Plugin widgets permissions
     *
     * @return array
     */
    private function setWidgetsPermissions() {
        return [
                [
                'name' => arter\amos\sondaggi\widgets\icons\WidgetIconPubblicaSondaggi::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconPubblicaSondaggi',
                'ruleName' => null,
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
                [
                'name' => arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconCompilaSondaggi',
                'ruleName' => null,
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
                [
                'name' => arter\amos\sondaggi\widgets\icons\WidgetIconSondaggi::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso per il widget WidgetIconSondaggi',
                'ruleName' => null,
                'parent' => ['AMMINISTRAZIONE_SONDAGGI']
            ],
        ];
    }

}
