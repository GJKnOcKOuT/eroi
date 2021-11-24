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

/**
 * m191028_105817_add_admin_attach_dash_email_organizzazioni_models_classname
 *
 * Add these models in to models_classname table for b.c. scopes
 * - admin
 * - attachments-
 * - dashboard
 * - email
 * - organizzazioni
 * 
 */

class m191107_110317_add_admin_attach_dash_email_organizzazioni_models_classname extends \yii\db\Migration
{
    /**
     * Somewhere something was changed
     * @var type 
     */
    protected  $tableName;

    /**
     * @inheritdoc
     */
    public function init() {
        $this->tableName = '{{%models_classname}}';
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->insert($this->tableName, [
            'classname' => 'arter\amos\admin\models\UserProfile',
            'module' => 'admin',
            'label' => 'Admin'
        ]);
        
        $this->insert($this->tableName, [
            'classname' => 'arter\amos\organizzazioni\models\Profilo',
            'module' => 'organizzazioni',
            'label' => 'Organizzazioni'
        ]);
        
        $this->insert($this->tableName, [
            'classname' => 'openinnovation\organizations\models\Organizations',
            'module' => 'organizations',
            'label' => 'organizations'
        ]);
        
        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->delete($this->tableName, [
            'classname' => \arter\amos\admin\models\UserProfile::classname(),
            'module' => arter\amos\admin\AmosAdmin::getModuleName(),
            'label' => 'Admin'
        ]);
        
        $this->delete($this->tableName, [
            'classname' => \arter\amos\organizzazioni\models\Profilo::classname(),
            'module' => arter\amos\organizzazioni\Module::getModuleName(),
            'label' => 'Organizzazioni'
        ]);
        
        return true;
    }
}
