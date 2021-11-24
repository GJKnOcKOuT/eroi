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
 * Driver for Twitter.
 *
 * @link https://facebook.com
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Twitter extends AbstractDriver
{
    /**
     * @var bool|string
     */
    public $account = false;
    public $hashtags;

    /**
     * {@inheritdoc}
     */
    /* protected function processShareData()
      {
      $title = preg_replace("/[\n\r]/", "", strip_tags($this->title));
      if (strpos($title, '{{') !== false && strpos($title, '}}') !== false) {
      $start = strpos($title, '{{');
      $end   = strpos($title, '}}');
      if ($start > 0) {
      $quote = substr($title, $start + 2, $end - 2);
      } else {
      $quote = substr($title, 2, $end - 2);
      }
      $this->url         = static::encodeData($this->url);
      $this->description = static::encodeData($quote);
      } else {
      $this->url         = static::encodeData($this->url);
      $this->description = static::encodeData($this->description);
      }

      if (\is_string($this->account)) {
      $this->appendToData('account', $this->account);
      }
      } */

    protected function processShareData()
    {
        $title             = static::encodeData(strip_tags($this->title));
        $this->url         = static::encodeData($this->url);
        $this->description = (!empty($title) ? static::encodeData(strip_tags($this->title)).' - '.static::encodeData(strip_tags($this->description))
                : static::encodeData(strip_tags($this->description)));
        if (strlen($this->description) > 95) {
            $this->description = substr($this->description, 0, 95).'...';
        }
        $this->hashtags = static::encodeData((!empty(\Yii::$app->params['shareTag']) ? str_replace('#', '',
                    str_replace(' ', ',', \Yii::$app->params['shareTag'])) : ''));
        if (\is_string($this->account)) {
            $this->appendToData('account', $this->account);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        $link = 'http://twitter.com/share?url={url}&text={description}'.(!empty($this->hashtags) ? '&hashtags='.$this->hashtags
                : '');

        if ($this->account) {
            $this->addUrlParam($link, 'via', '{account}');
        }

        return $link;
    }

    /**
     * {@inheritdoc}
     */
    protected function getMetaTags()
    {
        return [
            ['name' => 'twitter:card', 'content' => 'summary_large_image'],
            ['name' => 'twitter:title', 'content' => '{title}'],
            ['name' => 'twitter:description', 'content' => '{description}'],
            ['name' => 'twitter:image', 'content' => '{imageUrl}'],
        ];
    }
}