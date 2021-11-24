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


class MetaWidget extends Widget
{

    public $model;
    public $modelClass;
    public $contentModel;
    protected $form = null;
    
    public function run()
    {
        //pr($this->model->toArray(), '$this->model');exit;
        //print 'Pikkio. ...';exit;
        return $this->render('meta-tag', [
            'form' => $this->getForm(),
            'model' => $this->model,
            'modelClass' => $this->modelClass,
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

}