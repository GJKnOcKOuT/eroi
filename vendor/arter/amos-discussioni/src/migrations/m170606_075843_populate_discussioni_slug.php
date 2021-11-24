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


use arter\amos\discussioni\models\DiscussioniTopic;

use yii\db\Migration;

class m170606_075843_populate_discussioni_slug extends Migration
{
    public function safeUp()
    {

        $topics = DiscussioniTopic::find()
                     ->andWhere(['slug' => null])
                     ->orderBy(['id' => SORT_ASC])
                     ->all();
        
        foreach ($topics as $topic) {
            /**@var $topic \arter\amos\discussioni\models\DiscussioniTopic */
            $topic->detachBehaviors();

            $topic->attachBehavior(
                'slug', 
                [
                    'class' => \yii\behaviors\SluggableBehavior::className(),
                    'attribute' => 'titolo',
                    'slugAttribute' => 'slug',
                    'ensureUnique' => true
                ]
            );

            $topic->validate(['slug']);
            $topic->save(false);

            \yii\helpers\Console::stdout("SLUG: {$topic->slug}\n\n");
        }

        return true;
    }

    public function safeDown()
    {

        return true;
    }
}
