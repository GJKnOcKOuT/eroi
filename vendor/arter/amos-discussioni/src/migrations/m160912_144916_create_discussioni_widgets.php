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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\dashboard\models\AmosWidgets;

class m160912_144916_create_discussioni_widgets extends \arter\amos\core\migration\AmosMigrationWidgets
{
    const MODULE_NAME = 'discussioni';

    protected function initWidgetsConfs()
    {
        $this->widgets = [
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'update' => true,
                'status' => AmosWidgets::STATUS_ENABLED
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsDiscussioniInEvidenza::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'update' => true,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className()
            ]
        ];
    }
}
