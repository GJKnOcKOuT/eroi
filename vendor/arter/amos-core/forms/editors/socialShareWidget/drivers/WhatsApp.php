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
 * Driver for WhatsApp messenger.
 *
 * @link https://www.whatsapp.com
 *
 * WARNING: This driver works only in mobile devices
 * with installed WhatsApp client.
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @since 1.0
 */
class WhatsApp extends AbstractDriver
{

    /**
     * {@inheritdoc}
     */
    protected function processShareData()
    {
        //  $this->url         = static::encodeData($this->url);
        $title             = static::encodeData(strip_tags($this->title));
        $this->description = (!empty($title) ? strip_tags($this->title).' - '.strip_tags($this->description)
                : strip_tags($this->description));

        $this->url = static::encodeData($this->url).' - '.$this->description;
        if (strlen($this->url) > 3000) {
            $this->url = substr($this->url, 0, 3000).'...';
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildLink()
    {
        return 'whatsapp://send?text={url}';
    }
}