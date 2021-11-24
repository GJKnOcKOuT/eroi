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


use arter\amos\core\migration\AmosMigrationWidgets;
use arter\amos\dashboard\models\AmosWidgets;

/**
 * Class m170221_165937_update_widgets_discussioni
 */
class m170221_165937_update_widgets_discussioni extends AmosMigrationWidgets
{
    const MODULE_NAME = 'discussioni';

    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = array_merge(
            $this->initIconWidgetsConf(),
            $this->initGraphicWidgetsConf()
        );
    }

    /**
     * Init the icon widgets configurations
     * @return array
     */
    private function initIconWidgetsConf()
    {
        return [
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'default_order' => 1,
                'update' => true
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 10,
                'update' => true
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 30,
                'update' => true
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 40,
                'update' => true
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare::className(),
                'type' => AmosWidgets::TYPE_ICON,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 50,
                'update' => true
            ]
        ];
    }

    /**
     * Init the graphic widgets configurations
     * @return array
     */
    private function initGraphicWidgetsConf()
    {
        return [
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsDiscussioniInEvidenza::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 1,
                'update' => true
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni::className(),
                'type' => AmosWidgets::TYPE_GRAPHIC,
                'module' => self::MODULE_NAME,
                'status' => AmosWidgets::STATUS_ENABLED,
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni::className(),
                'default_order' => 1,
                'update' => true
            ]
        ];
    }
}
