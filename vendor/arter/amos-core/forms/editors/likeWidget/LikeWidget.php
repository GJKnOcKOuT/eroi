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
 * @package    arter\amos\core\forms\editors\likeWidget
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms\editors\likeWidget;

use Yii;
use yii\base\Widget;

/**
 * Class LikeWidget
 * @package arter\amos\core\forms\editors\likeWidget
 */
class LikeWidget extends Widget
{
    const MODE_NORMAL = 'normal';

    public
        $model,
        $wrapperTag = 'div',
        $wrapperOptions = ['class' => 'container-like'],
        $linkWrapperTag = 'div',
        $linkWrapperOptions = ['class' => 'like-wrap-button'],
        $enableModalLike = true,
        $mode = self::MODE_NORMAL;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (isset(\Yii::$app->params['disableLike']) && (\Yii::$app->params['disableLike'] === true)) {
            return '';
        }

        $uid = Yii::$app->user->id;
        $cid = $this->model->id;
        $mid = \arter\amos\core\models\ModelsClassname::find()
            ->where(['classname' => $this->model->className()])
            ->one()->id;

        $tot = \arter\amos\core\models\ContentLikes::getLikesToCounter($uid, $cid, $mid);
        $lme = \arter\amos\core\models\ContentLikes::getLikeMe($uid, $cid, $mid);

        return $this->render(
            '_like',
            [
                'uid' => $uid,
                'cid' => $cid,
                'mid' => $mid,
                'tot' => $tot,
                'lme' => ($lme == 1) ? 'likeme' : 'notlikeme'
            ]);
    }
}
