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
 * @package    arter\amos\core
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\bootstrap\Alert;

$FlashMsg = Yii::$app->session->getAllFlashes();
?>

<?php if(!empty($FlashMsg)): ?>
<div class="container-messages container">
<?php endif; ?>
    <?php
    foreach ($FlashMsg as $type => $message):

        if (!is_array($message)) :
            echo Alert::widget([
                'options' => [
                    'class' => 'alert-' . $type,
                    'role' => 'alert'
                ],
                'body' => $message,
            ]);
        else:
            foreach ($message as $ty => $msg):
                echo Alert::widget([
                    'options' => [
                        'class' => 'alert-' . $type,
                        'role' => 'alert'
                    ],
                    'body' => $msg,
                ]);
            endforeach;
        endif;
    endforeach;
    ?>
<?php if(!empty($FlashMsg)): ?>
</div>
<?php endif; ?>
