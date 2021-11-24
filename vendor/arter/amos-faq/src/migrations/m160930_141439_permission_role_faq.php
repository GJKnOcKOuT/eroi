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
 * @package    arter\amos\faq
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use \arter\amos\core\migration\AmosMigration;
use yii\rbac\Permission;

class m160930_141439_permission_role_faq extends AmosMigration
{
    /**
     * Use this instead of function up().
     * @see \Yii\db\Migration::safeUp() for more info.
     */
    public function safeUp()
    {
        return $this->addAuthorizations();
    }

    /**
     * Use this instead of function down().
     * @see \Yii\db\Migration::safeDown() for more info.
     */
    public function safeDown()
    {
        return $this->removeAuthorizations();
    }

    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => 'AMMINISTRATORE_FAQ',
                'type' => Permission::TYPE_ROLE,
                'description' => 'Ruolo di amministratore del plugin FAQ',
                'ruleName' => null,     // This is a string
                'parent' => ['ADMIN']
            ],
            [
                'name' => \arter\amos\faq\widgets\icons\WidgetIconFaq::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso sul widget IconFaq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => \arter\amos\faq\widgets\icons\WidgetIconFaqCategorie::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso sul widget IconFaq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => \arter\amos\faq\widgets\icons\WidgetIconFaqStati::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso sul widget IconFaq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso sul widget IconFaq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQ_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model Faq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQ_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model Faq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQ_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model Faq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQ_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model Faq',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ', 'UTENTE_BASE']
            ],

            [
                'name' => 'FAQCATEGORIES_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model FaqCategories',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQCATEGORIES_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model FaqCategories',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQCATEGORIES_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model FaqCategories',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQCATEGORIES_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model FaqCategories',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ', 'UTENTE_BASE']
            ],

            [
                'name' => 'FAQSTATO_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model FaqStato',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQSTATO_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model FaqStato',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQSTATO_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model FaqStato',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ']
            ],
            [
                'name' => 'FAQSTATO_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model FaqStato',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_FAQ','UTENTE_BASE']
            ],

        ];
    }
}
