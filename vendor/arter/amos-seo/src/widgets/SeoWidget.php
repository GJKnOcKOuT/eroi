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
//use arter\amos\seo\models\SeoMetadati;
use arter\amos\seo\models\SeoData;


class SeoWidget extends Widget
{

    public $contentModel;

    public function run()
    {        
        $seoData = SeoData::findOne([
                    'classname' => $this->contentModel->className(),
                    'content_id' => $this->contentModel->id
        ]);
        if (is_null($seoData)) {
            $seoData = new SeoData();
        } else {
           $seoData->prepareSeoData();
        }
        //pr($seoData->toArray(), 'SeoWidget - $seoData SONO RIMASTA QUI');//exit;
        //print 'Pikkioooo. ...';exit;
        return $this->render('seo-data', [
            'modelClass' => AmosSeo::getModel(),
            'model' => $seoData,
            'contentModel' => $this->contentModel
        ]);
    }

}