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


use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190227_143522_create_sondaggi_model_content
 */
class m190905_121722_widgets_sondaggi extends Migration
{
    const TABLE = '{{%sondaggi}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->update('amos_widgets', ['child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiAll',
                'module' => 'sondaggi'
            ]);
        $this->update('amos_widgets', ['child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiOwnInterest',
                'module' => 'sondaggi'
            ]);
        $this->update('amos_widgets', ['child_of' => null],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi',
                'module' => 'sondaggi'
            ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->update('amos_widgets', ['child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi'],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiAll',
                'module' => 'sondaggi'
            ]);
        $this->update('amos_widgets', ['child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi'],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggiOwnInterest',
                'module' => 'sondaggi'
            ]);
        $this->update('amos_widgets', ['child_of' => 'arter\amos\sondaggi\widgets\icons\WidgetIconSondaggiGeneral'],
            [
                'classname' => 'arter\amos\sondaggi\widgets\icons\WidgetIconCompilaSondaggi',
                'module' => 'sondaggi'
            ]);

    }

}
