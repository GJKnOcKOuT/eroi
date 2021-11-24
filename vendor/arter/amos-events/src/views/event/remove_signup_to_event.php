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
 * @var \arter\amos\core\user\User $user
 * @var string $confirmUrl
 * @var string $previousUrl
 * @var bool $autoRemove
 */
?>

<h3><?= $user->getUserProfile()->one()->getNomeCognome(); ?></h3>
<?php if($autoRemove) : ?>
<h3><?= \arter\amos\events\AmosEvents::txt('Vuoi davvero rimuovere la partecipazione all\'evento per te e i tuoi accompagnatori?') ?></h3>
<?php else : ?>
<h3><?= \arter\amos\events\AmosEvents::txt('Vuoi davvero rimuovere la partecipazione all\'evento per il partecipante e i suoi accompagnatori?') ?></h3>
<?php endif; ?>
<br /><br />
<?= \yii\helpers\Html::tag(
    'div',
    \yii\helpers\Html::a(
        \Yii::t('amoscore', 'No'),
        $previousUrl,
        [
            'class' => 'btn btn-secondary'
        ]
    ) . ' ' . \yii\helpers\Html::a(
        \Yii::t('amoscore', 'Yes'),
        $confirmUrl,
        [
            'class' => 'btn btn-primary'
        ]
    ),
    [
        'class' => 'pull-right'
    ]
    );
?>