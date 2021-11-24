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
 * @package    arter\amos\attachments\components\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\assets\ModuleAttachmentsAsset;
use arter\amos\attachments\FileModule;
use himiklab\colorbox\Colorbox;

/**
 * @var array $filesList
 * @var bool $viewFilesCounter
 * @var int $filesQuantity
 */

ModuleAttachmentsAsset::register($this);

if ($viewFilesCounter) {
    $this->registerJs(<<<JS

    var filesQuantity = "$filesQuantity";

    var section_title = $("#section-attachments").find("h2");

    section_title.append(" (" + filesQuantity + ")");
    if(filesQuantity == 0){
        section_title.addClass("section-disabled");
    }

JS
    );
}

$confirm = FileModule::t('amosattachments', 'Are you sure you want to delete this item?');
$deleteUrl = '/' . FileModule::getModuleName() . '/file/delete';

$this->registerJs(<<<JS
    $('.attachments-list-delete').on('click', function(e) {
        e.preventDefault();
        var id = encodeURI($(this).data('id'));
        var item_id = encodeURI($(this).data('item_id'));
        var model = encodeURI($(this).data('model'));
        var attribute = encodeURI($(this).data('attribute'));
        krajeeDialog.confirm("{$confirm}", function (result) {
            if (result) { // ok button was pressed
                $.ajax({
                    url: '{$deleteUrl}?id='+id+'&item_id='+item_id+'&model='+model+'&attribute='+attribute,
                    type: 'post',
                    success: function () {
                        $('#attachment-list-item-'+id).remove();
                    }
                });
            }
        });

    });
JS
);

?>

<div class="attachments-list col-xs-12 nop">

    <?php if ($filesList) : ?>

        <label><?= FileModule::t('amosattachments', '#attach_list_title'); ?></label>

    <?php else: ?>

        <label class="text-uppercase"><?= FileModule::t('amosattachments', '#attach'); ?></label>
        <div class="no-items text-muted"><?= FileModule::t('amosattachments', '#no_attach'); ?></div>


    <?php endif; ?>


    <?php foreach ($filesList as $file) : ?>

        <div id="attachment-list-item-<?=$file['file_id']?>" class="attachment-list-item col-xs-12 nop">
            <div class="attachment-list-item-name">
                <?= $file['filename']; ?>
            </div>
            <div class="attachment-list-item-action">
                <?= $file['preview']; ?>
                <?= $file['downloadButton']; ?>
                <?= $file['sortButtons']; ?>
                <?= $file['deleteButton']; ?>
            </div>
        </div>

        <?= Colorbox::widget([
            'targets' => [
                '.att' . $file['id'] => [
                    'rel' => '.att' . $file['id'],
                    'photo' => true,
                    'scalePhotos' => true,
                    'width' => '100%',
                    'height' => '100%',
                    'maxWidth' => 800,
                    'maxHeight' => 600,
                ],
            ],
            'coreStyle' => 4,
        ]); ?>

    <?php endforeach; ?>

</div>
