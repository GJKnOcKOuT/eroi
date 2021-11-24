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

/**
 * Class m210519_183100_update_language_source_message
 */
class m210519_183100_update_language_source_message extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $language_source = (new \yii\db\Query())
        ->select(['id'])
        ->from('language_source')
        ->andWhere(['message' => '#registration_rejected_mail_text_1'])
        ->andWhere(['category' => 'amoscommunity'])
        ->one();


        $this->update('language_translate',
            [
                'translation' => 'non ha validato la tua richiesta di iscrizione per '
            ],
            [
                'id' => $language_source['id'], 
                'language' => 'it-IT'
            ]);

        $language_source2 = (new \yii\db\Query())
            ->select(['id'])
            ->from('language_source')
            ->andWhere(['message' => '#registration_rejected_mail_title'])
            ->andWhere(['category' => 'amoscommunity'])
            ->one();


        $this->update('language_translate',
            [
                'translation' => ' Registrazione non validata'
            ],
            [
                'id' => $language_source2['id'],
                'language' => 'it-IT'
            ]);

        $language_source3 = (new \yii\db\Query())
            ->select(['id'])
            ->from('language_source')
            ->andWhere(['message' => '#registration_rejected_mail_text_1'])
            ->andWhere(['category' => 'amosorganizzazioni'])
            ->one();


        $this->update('language_translate',
            [
                'translation' => ' ha respinto la tua richiesta di partecipare al '
            ],
            [
                'id' => $language_source3['id'],
                'language' => 'it-IT'
            ]);
        $language_source4 = (new \yii\db\Query())
            ->select(['id'])
            ->from('language_source')
            ->andWhere(['message' => 'Discussion rejected!'])
            ->andWhere(['category' => 'amosdiscussioni'])
            ->one();


        $this->update('language_translate',
            [
                'translation' => 'Discussione non validata'
            ],
            [
                'id' => $language_source4['id'],
                'language' => 'it-IT'
            ]);

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {


        return true;
    }

}
