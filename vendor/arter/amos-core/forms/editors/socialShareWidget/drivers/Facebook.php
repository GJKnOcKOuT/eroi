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
 * @link https://github.com/yiimaker/yii2-social-share
 * @copyright Copyright (c) 2017-2018 Yii Maker
 * @license BSD 3-Clause License
 */

namespace arter\amos\core\forms\editors\socialShareWidget\drivers;

use ymaker\social\share\base\AbstractDriver;

/**
 * Driver for Facebook.
 *
 * @link https://facebook.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Facebook extends AbstractDriver
{
    /**
     * @inheritdoc
     */
    /*   public function getLink()
      {
      $this->_link = 'http://www.facebook.com/sharer.php?u={url}';
      //        $this->_link =  'share?urlRedirect='.static::encodeData('http://www.facebook.com/sharer.php?u=').'{url}';


      return parent::getLink();
      } */
    public $quote;
    public $hashtag;

    protected function buildLink()
    {
        return 'http://www.facebook.com/sharer.php?u={url}&quote='.$this->description.(!empty($this->hashtag) ? '&hashtag='.$this->hashtag
                : '');
    }

    /**
     * @inheritdoc 
     */
    protected function processShareData()
    {
        $this->url         = static::encodeData($this->remove_http($this->url));
        $this->title       = static::encodeData(strip_tags($this->title));
        $this->imageUrl    = static::encodeData($this->imageUrl);
        $this->description = (!empty($this->title) ? $this->title.' - '.static::encodeData(strip_tags($this->description))
                : static::encodeData(strip_tags($this->description)));
        $this->hashtag     = static::encodeData((!empty(\Yii::$app->params['shareTag']) ? \Yii::$app->params['shareTag']
                    : ''));
        $this->quote       = static::encodeData(strip_tags($this->quote));
    }

    protected function remove_http($url)
    {
        $disallowed = array('http://', 'https://');
        foreach ($disallowed as $d) {
            if (strpos($url, $d) === 0) {
                return str_replace($d, '', $url);
            }
        }
        return $url;
    }

    protected function getMetaTags()
    {
        return [
            ['property' => 'og:url', 'content' => '{url}'],
            ['property' => 'og:type', 'content' => 'website'],
            ['property' => 'og:title', 'content' => '{title}'],
            ['property' => 'og:description', 'content' => '{description}'],
            ['property' => 'og:image', 'content' => '{imageUrl}'],
        ];
    }
}