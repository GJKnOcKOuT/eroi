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
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps\controls;

use dosamigos\google\maps\ObjectAbstract;
use dosamigos\google\maps\OptionsTrait;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;

/**
 * ScaleControlOptions
 *
 * Options for the rendering of the scale control.
 *
 * For further information please visit its
 * [documentation](https://developers.google.com/maps/documentation/javascript/reference#ScaleControlOptions) at
 * Google.
 *
 * @property string style Style id. Used to select what style of scale control to display.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class ScaleControlOptions extends ObjectAbstract
{

    use OptionsTrait;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->options = ArrayHelper::merge(
            [
                'style' => null
            ],
            $this->options
        );
    }

    /**
     * Sets the style and checks whether is a valid [ScaleControlStyle] constant.
     *
     * @param $value
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function setStyle($value)
    {
        if (!ScaleControlStyle::getIsValid($value)) {
            throw new InvalidConfigException('Unknown "style" value');
        }

        $this->options['style'] = new JsExpression($value);
    }

} 