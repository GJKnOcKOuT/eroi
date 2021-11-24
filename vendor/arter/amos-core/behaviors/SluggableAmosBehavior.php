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
 * @package    arter\amos\core\behaviors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\behaviors;

use Yii;
use yii\base\Behavior;
use yii\base\Event;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\Json;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Inflector;

/**
 * Class SluggableAmosBehavior
 * @package arter\amos\core\behaviors
 */
class SluggableAmosBehavior extends SluggableBehavior
{
    /**
     * @var bool You can force new slug generation
     */
    public $forceNewSlug = false;

    /**
     * This method is called by [[getValue]] to generate the slug.
     * You may override it to customize slug generation.
     * The default implementation calls [[\yii\helpers\Inflector::slug()]] on the input strings
     * concatenated by dashes (`-`).
     * @param array $slugParts an array of strings that should be concatenated and converted to generate the slug value.
     * @return string the conversion result.
     */
    protected function generateSlug($slugParts)
    {
        return Inflector::slug(implode('_', $slugParts), '_');
    }

    /**
     * Generates slug using configured callback or increment of iteration.
     * @param string $baseSlug base slug value
     * @param integer $iteration iteration number
     * @return string new slug value
     * @throws \yii\base\InvalidConfigException
     */
    protected function generateUniqueSlug($baseSlug, $iteration)
    {
        $result = parent::generateUniqueSlug($baseSlug, $iteration);

        return str_replace('-','_', $result);
    }

    /**
     * Force slug generation
     * @return bool
     */
    protected function isNewSlugNeeded()
    {
        if($this->forceNewSlug) {
            return true;
        } else {
            return parent::isNewSlugNeeded();
        }
    }
}