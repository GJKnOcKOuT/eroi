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


namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class FinalForm extends Model implements \arter\amos\wizflow\WizflowModelInterface
{
    public $rate;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['rate'], 'required'],
        ];
    }

    public function summary()
    {
        return 'this is : ' . $this->rate;
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'rate' => 'Did you like your wizflow experience ?',
        ];
    }
}
