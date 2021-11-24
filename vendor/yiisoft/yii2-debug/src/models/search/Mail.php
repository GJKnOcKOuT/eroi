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

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\debug\models\search;

use yii\data\ArrayDataProvider;
use yii\debug\components\search\Filter;

/**
 * Mail represents the model behind the search form about current send emails.
 *
 * @author Mark Jebri <mark.github@yandex.ru>
 * @since 2.0
 */
class Mail extends Base
{
    /**
     * @var string from attribute input search value
     */
    public $from;
    /**
     * @var string to attribute input search value
     */
    public $to;
    /**
     * @var string reply attribute input search value
     */
    public $reply;
    /**
     * @var string cc attribute input search value
     */
    public $cc;
    /**
     * @var string bcc attribute input search value
     */
    public $bcc;
    /**
     * @var string subject attribute input search value
     */
    public $subject;
    /**
     * @var string body attribute input search value
     */
    public $body;
    /**
     * @var string charset attribute input search value
     */
    public $charset;
    /**
     * @var string headers attribute input search value
     */
    public $headers;
    /**
     * @var string file attribute input search value
     */
    public $file;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'reply', 'cc', 'bcc', 'subject', 'body', 'charset'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'from' => 'From',
            'to' => 'To',
            'reply' => 'Reply',
            'cc' => 'Copy receiver',
            'bcc' => 'Hidden copy receiver',
            'subject' => 'Subject',
            'charset' => 'Charset'
        ];
    }

    /**
     * Returns data provider with filled models. Filter applied if needed.
     * @param array $params
     * @param array $models
     * @return \yii\data\ArrayDataProvider
     */
    public function search($params, $models)
    {
        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'attributes' => ['from', 'to', 'reply', 'cc', 'bcc', 'subject', 'body', 'charset'],
            ],
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $filter = new Filter();
        $this->addCondition($filter, 'from', true);
        $this->addCondition($filter, 'to', true);
        $this->addCondition($filter, 'reply', true);
        $this->addCondition($filter, 'cc', true);
        $this->addCondition($filter, 'bcc', true);
        $this->addCondition($filter, 'subject', true);
        $this->addCondition($filter, 'body', true);
        $this->addCondition($filter, 'charset', true);
        $dataProvider->allModels = $filter->filter($models);

        return $dataProvider;
    }
}
