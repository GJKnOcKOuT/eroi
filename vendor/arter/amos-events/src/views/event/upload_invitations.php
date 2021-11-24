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
 * @package    arter\amos\events\views\event
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\ActiveForm;
use arter\amos\core\helpers\Html;
use arter\amos\events\AmosEvents;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\Event $event
 * @var arter\amos\events\models\EventInvitationsUpload $upload
 * @var yii\widgets\ActiveForm $form
 * @var string $fid
 */

$this->title = AmosEvents::txt('#upload_invitations_header');
$this->params['breadcrumbs'][] = ['label' => Yii::$app->session->get('previousTitle'), 'url' => Yii::$app->session->get('previousUrl')];
$this->params['breadcrumbs'][] = $event->title;

?>
<div class="upload-invitations-modal">
<?php
$form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data' // important
    ]
]);
?>

<div class="event-form">
    <h2><?= $event->title ?></h2>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($upload, 'excelFile')->fileInput()->hint(AmosEvents::txt('#invitations_excel_file_hint')) ?>
        </div>
    </div>
    <div>
        <?= Html::submitButton('Importa', ['class' => 'btn']) ?>
    </div>
</div>

<?php
ActiveForm::end();
?>
</div>
