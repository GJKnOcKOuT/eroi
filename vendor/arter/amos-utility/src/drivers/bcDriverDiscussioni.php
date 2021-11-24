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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\utility\drivers\base\bcDriver;
use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\discussioni\models\search\DiscussioniTopicSearch;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioni;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAdminAll;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy;
use arter\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare;

/**
 * 
 */
class bcDriverDiscussioni extends bcDriver
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->modelClassName  = DiscussioniTopic::className(); // put here your model
        $this->module          = 'discussioni'; // raw fix db incongruence
        $this->widgetIconNames = [
//            WidgetIconDiscussioni::getWidgetIconName() => WidgetIconDiscussioni::classname(),
            WidgetIconDiscussioniTopic::getWidgetIconName() => WidgetIconDiscussioniTopic::classname(),
//            WidgetIconDiscussioniTopicAdminAll::getWidgetIconName() => WidgetIconDiscussioniTopicAdminAll::classname(),
            WidgetIconDiscussioniTopicAll::getWidgetIconName() => WidgetIconDiscussioniTopicAll::classname(),
//            WidgetIconDiscussioniTopicCreatedBy::getWidgetIconName() => WidgetIconDiscussioniTopicCreatedBy::classname(),
//            WidgetIconDiscussioniTopicDaValidare::getWidgetIconName() => WidgetIconDiscussioniTopicDaValidare::classname()
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDiscussioniTopicAdminAll()
    {
        $search      = new DiscussioniTopicSearch();
        $this->query = $search->buildQuery('admin-all', []);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDiscussioniTopicDaValidare()
    {
        $search      = new DiscussioniTopicSearch();
        $this->query = $search->buildQuery('to-validate', []);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDiscussioniTopic()
    {

        $search      = new DiscussioniTopicSearch();
        $this->query = $search->buildQuery('own-interest', []);
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconDiscussioniTopicAll()
    {

        $search      = new DiscussioniTopicSearch();
        $this->query = $search->buildQuery('all', []);
    }
}