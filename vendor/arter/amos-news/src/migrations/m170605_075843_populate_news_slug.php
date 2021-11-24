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

class m170605_075843_populate_news_slug extends Migration
{
    public function safeUp()
    {

        foreach (\arter\amos\news\models\News::find()
                     ->andWhere([
                         'slug' => null
                     ])
                     ->orderBy(['id' => SORT_ASC])
                     ->all() as $news) {


            /**@var $news \arter\amos\news\models\News */
            $news->detachBehaviors();

            $news->attachBehavior('slug', [
                'class' => \yii\behaviors\SluggableBehavior::className(),
                'attribute' => 'titolo',
                'slugAttribute' => 'slug',
                'ensureUnique' => true
            ]);

            $news->validate(['slug']);
            $news->save(false);

            \yii\helpers\Console::stdout("SLUG: {$news->slug}\n\n");
        }

        return true;
    }

    public function safeDown()
    {

        return true;
    }
}
