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
use arter\design\assets\BootstrapItaliaDesignAsset;
$bootstrapItaliaAsset = BootstrapItaliaDesignAsset::register($this);

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

?>

<div class="attachments-list row nop">

    <?php if ($filesList) : ?>

        <label><?= FileModule::t('amosattachments', '#attach_list_title'); ?></label>

    <?php else: ?>

        <div class="no-items"><?= FileModule::t('amosattachments', '#attach_list_no_items'); ?></div>

    <?php endif; ?>


    <?php foreach ($filesList as $file) : ?>
        <div class="attachment-item card-wrapper mb-4 card-teaser card-one-block col-lg-4 col-md-6">
            <div class="card card-teaser card-one-block  shadow p-4">
                <svg class="icon icon-primary">
                    <use xlink:href=" <?=$bootstrapItaliaAsset->baseUrl ?>/node_modules/bootstrap-italia/dist/svg/sprite.svg#it-clip"></use>
                </svg>
                <div class="card-body">
                    <?= $file['filename']; ?> 
                    <?= $file['preview']; ?>
                    <?= $file['downloadButton']; ?>
                    <?= $file['sortButtons']; ?>
                    <?= $file['deleteButton']; ?>             
                </div>
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
