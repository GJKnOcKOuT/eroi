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
 * @package    arter\amos\admin\views\user-profile\help
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\utilities\ModalUtility;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 * @var bool $spediscicredenzialienable
 */

$modalId = 'send-recovery-password-modal-id';

$spedisciCredenzialiLink = [
    '/admin/security/spedisci-credenziali',
    'id' => $model->id
];

$baseModalContent = Html::tag('div',
    AmosAdmin::t('amosadmin', 'Sei sicuro di voler inviare le credenziali? Sarà inviata una mail contenente un link per modificare le credenziali. Vuoi continuare?'),
    ['class' => 'send-recovery-password pull-right m-15-0']
);

$footerText = Html::tag('div',
    Html::a(
        Html::tag('span', null,
            ['class' => 'glyphicon glyphicon-ban-circle']
        ) .
        AmosAdmin::t('amosadmin', 'Annulla'),
        null,
        [
            'id' => 'undo',
            'class' => 'btn btn-secondary',
            'data-dismiss' => 'modal'
        ]) .
    Html::a(
        Html::tag('span', null,
            ['class' => 'glyphicon glyphicon-ok']
        ) .
        AmosAdmin::t('amosadmin', 'Ok'),
        $spedisciCredenzialiLink,
        [
            'id' => 'confirm',
            'class' => 'btn btn-navigation-primary'
        ]
    )
);

ModalUtility::amosModal([
    'id' => $modalId,
    'headerText' => AmosAdmin::t('amosadmin', "Conferma"),
    'modalBodyContent' => $baseModalContent,
    'footerText' => $footerText,
    'containerOptions' => ['class' => 'modal-utility bootstrap-dialog type-warning fade']
]);

?>

<?= Html::a(
    AmosIcons::show('email') . AmosAdmin::t('amosadmin', 'Spedisci credenziali'),
    $spedisciCredenzialiLink,
    [
        'class' => 'btn btn-navigation-primary btn-spedisci-credenziali ',
        'data-toggle' => 'modal',
        'data-target' => '#' . $modalId
    ]
); ?>
