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
use arter\amos\dashboard\models\AmosWidgets;

class m170919_132221_change_widget_level extends Migration
{
    const MODULE_NAME = 'tag';

    /**
     * @return bool
     */
    public function safeUp()
    {
        if ($this->checkWidgetExist(\arter\amos\tag\widgets\icons\WidgetIconTagManager::className())) {

            $this->update(AmosWidgets::tableName(),
            [
             'dashboard_visible' => 1,
              'child_of' => ''
            ],[
                'classname' => \arter\amos\tag\widgets\icons\WidgetIconTagManager::className()
                ]);
        }
        if ($this->checkWidgetExist(\arter\amos\tag\widgets\icons\WidgetIconTag::className())) {

            $this->update(AmosWidgets::tableName(),
                [
                    'dashboard_visible' => 0,
                    'status' => AmosWidgets::STATUS_DISABLED,
                ],[
                    'classname' => \arter\amos\tag\widgets\icons\WidgetIconTag::className()
                ]);
        }
        return true;
    }


    /**
     * @param $classname
     * @return mixed
     */
    private function checkWidgetExist($classname)
    {

        return AmosWidgets::find()
            ->andWhere([
                'classname' => $classname
            ])->count();
    }

    /**
     * @return bool
     */
    public function safeDown()
    {

        if ($this->checkWidgetExist(\arter\amos\tag\widgets\icons\WidgetIconTagManager::className())) {

            $this->update(AmosWidgets::tableName(),
                [
                    'dashboard_visible' => 0,
                    'child_of' => \arter\amos\tag\widgets\icons\WidgetIconTag::className()
                ],[
                    'classname' => \arter\amos\tag\widgets\icons\WidgetIconTagManager::className()
                ]);
        }
        if ($this->checkWidgetExist(\arter\amos\tag\widgets\icons\WidgetIconTag::className())) {

            $this->update(AmosWidgets::tableName(),
                [
                    'dashboard_visible' => 1,
                    'status' => AmosWidgets::STATUS_ENABLED,
                ],[
                    'classname' => \arter\amos\tag\widgets\icons\WidgetIconTag::className()
                ]);
        }

        return true;
    }
}
