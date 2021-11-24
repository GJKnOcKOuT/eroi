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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\widgets;

use arter\amos\community\models\Community;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\news\models\News;
use Yii;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use arter\amos\core\widget\WidgetAbstract;

/**
 * Class PublishedContentsWidget
 * @package arter\amos\core\forms
 */
class CommunityPublishedContentsWidget extends Widget
{

    /**
     * @var string classname of the model of the listed objects
     */
    public $modelCommunity;
    /**
     * @var string classname of the model of the listed objects
     */
    public $modelContent;

    /**
     * @var string label for the model of the listed objects
     */
    public $modelLabel;


    public $frameworkIcons = AmosIcons::DASH;

    public $iconsContents = [
        'arter\amos\news\models\News' => 'feed',
        'arter\amos\events\models\Event' => 'feed',
        'arter\amos\discussioni\models\DiscussioniTopic' => 'comment',
        'arter\amos\documenti\models\Documenti' => 'file-text-o',
        'arter\amos\partnershipprofiles\models\PartnershipProfiles' => 'lightbulb-o',
        'arter\amos\risultati\models\Risultati' => 'gears',
        'arter\amos\showcaseprojects\models\ShowcaseProjectProposal' => 'gears',
        'arter\amos\sondaggi\models\Sondaggi' => 'sondaggi'
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {

        if(!empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS){
            $this->frameworkIcons = AmosIcons::IC;

            $this->iconsContents = [
                'arter\amos\news\models\News' => 'news',
                'arter\amos\events\models\Event' => 'eventi',
                'arter\amos\discussioni\models\DiscussioniTopic' => 'disc',
                'arter\amos\documenti\models\Documenti' => 'fatture',
                'arter\amos\partnershipprofiles\models\PartnershipProfiles' => 'propostecollaborazione',
                'amos\results\models\Result' => 'risultati',
                'arter\amos\showcaseprojects\models\Initiative' => 'iniziative',
                'arter\amos\sondaggi\models\Sondaggi' => 'sondaggi',
            ];
        }

        /** @var \arter\amos\cwh\AmosCwh $moduleCwh */
        $object = Yii::createObject($this->modelContent);
        $this->modelLabel = $object->getGrammar()->getModelLabel();

    }


    /**
     * @inheritdoc
     */
    public function run()
    {
        $moduleCwh = \Yii::$app->getModule('cwh');
        $count = 0;

        /** @var \arter\amos\cwh\query\CwhActiveQuery $cwhActiveQuery */
        $cwhActiveQuery = null;

        if (isset($moduleCwh)) {
            $query = new \arter\amos\cwh\query\CwhActiveQuery($this->modelContent);
            $query->filterByPublicationNetwork(Community::getCwhConfigId(), $this->modelCommunity->id);
            $count = $query->count();

            if(empty(\Yii::$app->params['dashboardEngine']) && \Yii::$app->params['dashboardEngine'] != WidgetAbstract::ENGINE_ROWS){
                $count = '(' . $count . ')';
            }
        }

        $icons = !empty($this->iconsContents[$this->modelContent]) ? AmosIcons::show($this->iconsContents[$this->modelContent], [], $this->frameworkIcons) : '';
        return  Html::tag('div',
                $icons .
                Html::tag('span', $count, ['class' => 'counter']) .
                Html::tag('span', $this->modelLabel, ['class' => 'model-label']),
                ['class' => 'content-widget-item']);
    }


}