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
 * @package    arter\amos\comments\views\comment\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\cwh\base\ModelContentInterface;

?>
<div style="border:1px solid #cccccc;padding:10px;margin-bottom: 10px;background-color: #ffffff;margin-top:20px">
    <div style="color:#000000;">
        <h2 style="font-size:2em;line-height: 1;margin:0;padding:10px 0;">
            <?= Html::a(\arter\amos\documenti\AmosDocumenti::t('amosdocumenti', "É stato caricato il documento '"). $modelDocument->title . "'", Yii::$app->getUrlManager()->createAbsoluteUrl(['/documenti/documenti/view', 'id' => $modelDocument->id]), ['style' => 'color: green;']) ?>
        </h2>
    </div>

    <div style="box-sizing:border-box;font-size:13px;font-weight:normal;">
        <?php
        echo $modelDocument->descrizione;
        ?>
    </div>
    <div style="box-sizing:border-box;padding-bottom: 5px;color:#000000;">
        <div style="margin-top:20px;">
            <div style="display: flex;width: 100%;">
                <div style="width: 50px; height: 50px; overflow: hidden;-webkit-border-radius: 50%; -moz-border-radius: 50%; border-radius: 50%;float: left;">
                    <?php
                    $layout = '{publisher}';
                    ?>
                    <?php if ($modelCreator != null): ?>
                        <?= \arter\amos\admin\widgets\UserCardWidget::widget([
                            'model' => $modelCreator,
                            'onlyAvatar' => true,
                            'absoluteUrl' => true
                        ])
                        ?>
                    <?php endif; ?>
                </div>

                <div style="margin-left: 20px;">
                    <?= \arter\amos\core\forms\PublishedByWidget::widget([
                        'model' => $modelCreator,
                        'layout' => $layout,
                    ]) ?>
                    <span style="font-weight:normal;"><?php echo $modelDocument->titolo ?></span>

                </div>
            </div>
        </div>
    </div>
</div>
