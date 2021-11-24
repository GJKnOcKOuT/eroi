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
 * @package    arter-proposte-collaborazione-een
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\commands\models;

use arter\amos\tag\models\Tag;
use yii\base\Model;
use yii\helpers\Console;
use arter\amos\een\models\EenTagS3TagEenMm;
use arter\amos\een\models\EenTagEen;

class TagEen extends Model
{
    public $id;
    public $codice;
    public $nome;
    public function getIds($root_id = 3, $conversion = false)
    {
        try {

            if ($conversion == true) {
                $eenTags = EenTagEen::find()->andWhere(['id_een' => $this->codice])->all();
                if (!empty($eenTags)) {
                    $tagIds=[];
                    foreach ($eenTags as $eenTag){
                        $tagMms = EenTagS3TagEenMm::find()->andWhere(['een_tag_een_id' => $eenTag->id])->all();
                        foreach($tagMms as $tagMm){
                            if (!empty($tagMm)) {
                                $tagIds[] = $tagMm->tag_s3_id;
                            }
                        }
                    }
                    return $tagIds;
                }
            } else {
                $pad       = 0;
                $codiceTag = $this->codice;
                $lunghezza = strlen($codiceTag);
                if ($lunghezza < 3) {
                    $pad = 3;
                } elseif ($lunghezza > 3 && $lunghezza < 6) {
                    $pad = 6;
                } elseif ($lunghezza > 6 && $lunghezza < 9) {
                    $pad = 9;
                } elseif ($lunghezza > 9 && $lunghezza < 12) {
                    $pad = 12;
                }
                $codiceTag = str_pad($codiceTag, $pad, "0", STR_PAD_LEFT);



                $tagAmosQ = Tag::find()
                    ->andWhere([
                        'root' => $root_id,
                        'codice' => $codiceTag,
                        'nome_en' => $this->nome,
                    ]);
                if ($tagAmosQ->count() == 0) {
                    $codiceTag = substr($codiceTag, 1);
                    $tagAmosQ  = Tag::find()
                        ->andWhere([
                            'root' => $root_id,
                            'codice' => $codiceTag,
                            'nome_en' => $this->nome,
                        ]);
                }
                if ($tagAmosQ->count() == 1) {
                    $tagAmosObj = $tagAmosQ->asArray()->all();

                    if (isset($tagAmosObj[0]['id'])) {
                        return $tagAmosObj[0]['id'];
                    }
                }
                if ($tagAmosQ->count() > 1) {
                    Console::stdout("IL TAG {$this->codice} TROVATO {$tagAmosQ->count()} VOLTE!!");
                }
            }
        } catch (Exception $ex) {
            Console::stdout("Errore sul codice {$this->codice}: riga {$ex->getLine()} - file {$ex->getFile()} - {$ex->getMessage()}");
        }
        return null;
    }
    public function getId($root_id = 3, $conversion = false)
    {
        try {

            if ($conversion == true) {
                $eenTag = EenTagEen::find()->andWhere(['id_een' => $this->codice])->one();
                if (!empty($eenTag)) {
                    $tagMm = EenTagS3TagEenMm::find()->andWhere(['een_tag_een_id' => $eenTag->id])->one();
                    return $tagMm->tag_s3_id;
                }
            } else {
                $pad       = 0;
                $codiceTag = $this->codice;
                $lunghezza = strlen($codiceTag);
                if ($lunghezza < 3) {
                    $pad = 3;
                } elseif ($lunghezza > 3 && $lunghezza < 6) {
                    $pad = 6;
                } elseif ($lunghezza > 6 && $lunghezza < 9) {
                    $pad = 9;
                } elseif ($lunghezza > 9 && $lunghezza < 12) {
                    $pad = 12;
                }
                $codiceTag = str_pad($codiceTag, $pad, "0", STR_PAD_LEFT);



                $tagAmosQ = Tag::find()
                    ->andWhere([
                    'root' => $root_id,
                    'codice' => $codiceTag,
                    'nome_en' => $this->nome,
                ]);
                if ($tagAmosQ->count() == 0) {
                    $codiceTag = substr($codiceTag, 1);
                    $tagAmosQ  = Tag::find()
                        ->andWhere([
                        'root' => $root_id,
                        'codice' => $codiceTag,
                        'nome_en' => $this->nome,
                    ]);
                }
                if ($tagAmosQ->count() == 1) {
                    $tagAmosObj = $tagAmosQ->asArray()->all();

                    if (isset($tagAmosObj[0]['id'])) {
                        return $tagAmosObj[0]['id'];
                    }
                }
                if ($tagAmosQ->count() > 1) {
                    Console::stdout("IL TAG {$this->codice} TROVATO {$tagAmosQ->count()} VOLTE!!");
                }
            }
        } catch (Exception $ex) {
            Console::stdout("Errore sul codice {$this->codice}: riga {$ex->getLine()} - file {$ex->getFile()} - {$ex->getMessage()}");
        }
        return null;
    }

    public function setNotFound()
    {
        $tagNotFound = EenTagEen::find()->andWhere(['id_een' => $this->codice]);
        if ($tagNotFound->count() == 0) {
            $tagNotFound              = new EenTagEen();
            $tagNotFound->description = $this->nome;
            $tagNotFound->id_een      = $this->codice;
            $tagNotFound->save(false);
        } else {
            $tagNotFound->one()->save(false);
        }
    }
}