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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\news\AmosNews;

?>

<div class="listview-container">

    <div class="bk-listViewElement">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2><?= $model->titolo ?></h2>

                <h3><?= $model->sottotitolo ?></h3>
                <p><br><u><?= AmosNews::t('amosnews', 'Abstract') ?></u>: <i><?= $model->descrizione_breve ?></i></p>
                <p><?= $model->descrizione ?></p>

                <!--p><b>Condominio:</b> < ?= $model->networkPubblicazione ?></p-->
                <p><b><?= AmosNews::t('amosnews', 'Categoria') ?>:</b> <?= $model->newsCategorie->titolo ?></p>
                <div class="bk-elementActions">
                    <?= $buttons ?>
                </div>
                <div class="clear"></div>
            </div>

            <div class="col-lg-12 col-md-12">
                <br>
                <h3><b><?= AmosNews::t('amosnews', 'Allegati') ?></b></h3>
                <?php
                $allegati = $model->getNewsAllegatis();
                if ($allegati->count() == 0) {
                    ?>
                    <p><h3><?= AmosNews::t('amosnews', 'Nessun allegato presente') ?></h3></p>
                    <?php
                } else {
                    ?>
                    <ul>
                        <?php
                        foreach ($allegati->all() as $Allegati) {
                            ?>
                            <li>
                                <a href="/news/news/download?idfile=<?= $Allegati['filemanager_mediafile_id'] ?>">
                                    <h3 title="Download file">
                                        <i><?= $Allegati['titolo'] ?></i>
                                    </h3>
                                </a>
                                <i><?= $Allegati['descrizione'] ?></i>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>

            </div>
        </div>

        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
