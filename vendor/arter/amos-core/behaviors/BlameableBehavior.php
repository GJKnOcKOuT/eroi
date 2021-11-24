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

/**
 * Class BlameableBehavior
 * @package arter\amos\core\behaviors
 */
class BlameableBehavior extends \yii\behaviors\BlameableBehavior
{
    /**
     * @inheritdoc
     *
     * In case, when the [[value]] property is `null`, the value of `Yii::$app->user->id` will be used as the value.
     */
    protected function getValue($event)
    {
        if (!empty($this->attributes[$event->name]) && is_array($this->attributes[$event->name]) && in_array($this->createdByAttribute, $this->attributes[$event->name])) {
            if ($this->owner->{$this->createdByAttribute}) {
                return $this->owner->{$this->createdByAttribute};
            }
        }
        if ($this->value === null) {
            if(Yii::$app instanceof \yii\web\Application){
                $user = Yii::$app->get('user', false);
                return $user && !$user->isGuest ? $user->id : null;
            } elseif (Yii::$app instanceof \yii\console\Application) {
                return 0;
            }
        }

        return parent::getValue($event);
    }
}
