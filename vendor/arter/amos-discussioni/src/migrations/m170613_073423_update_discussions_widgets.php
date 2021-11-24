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
 * @package    arter\amos\discussioni\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m170613_073423_update_discussions_widgets
 */
class m170613_073423_update_discussions_widgets extends AmosMigrationWidgets
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
     * Icon widgets configurations
     * @return array
     */
    private function initIconWidgetsConf()
    {
        return [
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ]
        ];
    }
    
    /**
     * Graphic widgets configurations
     * @return array
     */
    private function initGraphicWidgetsConf()
    {
        return [
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsDiscussioniInEvidenza::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \arter\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni::className(),
                'child_of' => \arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ]
        ];
    }
}
