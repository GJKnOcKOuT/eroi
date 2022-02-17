<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Schema;

/**
 * Default migration for the relations of the Application Project
 */
class m180712_154018_aster_widget_assistenza extends \arter\amos\core\migration\AmosMigrationPermissions {

    protected function setAuthorizations()
    {
        $this->authorizations = [
            [
                'name' => \backend\modules\supercraft\widgets\icons\WidgetIconSupercraft::className(),
                'type' => \yii\rbac\Permission::TYPE_PERMISSION,
                'description' => 'Permesso invio email assistenza',
                'ruleName' => null,
                'parent' => ['ADMIN', 'BASIC_USER']
            ],
        ];
    }

}
