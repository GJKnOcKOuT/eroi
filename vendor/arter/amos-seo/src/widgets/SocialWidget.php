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
 * @package    arter\amos\seo
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo\widgets;

use yii\base\Widget;
use yii\helpers\ArrayHelper;
use arter\amos\seo\AmosSeo;


class SocialWidget extends Widget
{

    public $model;
    public $modelClass;
    public $contentModel;
    public $ogTypeList;
    protected $form = null;

    
    public function init()
    {
        parent::init();
        
        $this->setOgTypeList();
    }

    public function run()
    {        
        
        return $this->render('social-tag', [
            'form' => $this->getForm(),
            'model' => $this->model,
            'modelClass' => $this->modelClass,
            'ogTypeList' => $this->ogTypeList,
            'contentModel' => $this->contentModel
        ]);
    }

    /**
     * @return null
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param null $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    public function setOgTypeList()
    {
        $this->ogTypeList = [
                'article' => 'article: article on a website', 
                'book' => 'book: book or publication', 
                'place' => 'place: represents a place, such as a venue, a business, a landmark or any other location',
                'product' => 'product: this includes both virtual and physical products', 
                'profile' => 'profile: represents a person', 
                'video.other' => 'video.other: represents a generic video', 
                'website' => 'website', 
            ];
    }

    

}