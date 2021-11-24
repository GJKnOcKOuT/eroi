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

use raoul2000\workflow\validation\WorkflowScenario;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class Step1Form extends Model implements \arter\amos\wizflow\WizflowModelInterface
{
    public $favoriteColor;
    public $status;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['favoriteColor'], 'required'],

            [['favoriteColor'], 'compare', 'compareValue' => 'blue', 'operator' => '==',
                'on' => WorkflowScenario::enterStatus('Wizflow/blue')],

            [['favoriteColor'], 'compare', 'compareValue' => 'green', 'operator' => '==',
                'on' => WorkflowScenario::enterStatus('Wizflow/green')],
        ];
    }

    public function summary()
    {
        return 'your favorite color is ' . $this->favoriteColor;
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'favoriteColor' => 'your favorite color',
        ];
    }
}
