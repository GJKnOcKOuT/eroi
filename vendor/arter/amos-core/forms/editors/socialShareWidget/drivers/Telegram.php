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
 * Driver for Telegram messenger.
 *
 * @link https://telegram.org
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class Telegram extends AbstractDriver
{
    /**
     * @var bool|string
     */
    public $message = false;

    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        $this->url         = static::encodeData($this->url);
        $title             = static::encodeData(strip_tags($this->title));
        $this->description = (!empty($title) ? static::encodeData(strip_tags($this->title)).' - '.static::encodeData(strip_tags($this->description))
                : static::encodeData(strip_tags($this->description)));
        if (strlen($this->description) > 3000) {
            $this->description = substr($this->description, 0, 3000).'...';
        }
        if (\is_string($this->message)) {
            $this->appendToData('message', $this->message);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        $link = 'https://telegram.me/share/url?url={url}&text={description}';

        if ($this->message) {
            $this->addUrlParam($link, 'text', '{message}');
        }

        return $link;
    }
}