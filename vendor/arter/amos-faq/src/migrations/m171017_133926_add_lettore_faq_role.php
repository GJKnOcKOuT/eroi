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
 * @package    arter\amos\faq\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m171017_133926_add_lettore_faq_role
 */
class m171017_133926_add_lettore_faq_role extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'LETTORE_FAQ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Ruolo di lettore delle FAQ',
                'parent' => ['AMMINISTRATORE_FAQ', 'BASIC_USER'],
                'children' => [
                    \arter\amos\faq\widgets\icons\WidgetIconFaqDashboard::className(),
                    \arter\amos\faq\widgets\icons\WidgetIconFaq::className(),
                    'FAQ_READ',
                    'FAQCATEGORIES_READ',
                    'FAQSTATO_READ'
                ]
            ]
        ];
    }
}
