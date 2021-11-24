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
 * @var $defaultLanguage string
 * @var $widget \arter\amos\notificationmanager\widgets\NotifyContentLanguageWidget
 */
?>
<div id="<?= $widget->id ?>" class="<?= $widget->class ?>">
    <div class="row">
        <label class="control-label"><?= \arter\amos\notificationmanager\AmosNotify::tHtml('amosnotify', 'Lingua del contenuto') ?></label>
        <?php
        echo \kartik\select2\Select2::widget([
            'id' => 'notify_content_language-id',
            'name' => 'notify_content_language',
            'data' => \yii\helpers\ArrayHelper::map(\lajax\translatemanager\models\Language::find()->andWhere(['status' => 1])->all(), 'language_id', 'language'),
            'value' => $value
        ]);
        ?>
    </div>
</div>