<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\cmsapi\frontend\utility\cmspageblock;

use app\modules\cmsapi\frontend\models\PostCmsCreatePage;
use yii\helpers\ArrayHelper;

class CmsTextEditorFormPageBlock extends CmsTextEditorPageBlock
{

    protected function parserTextEditor(string &$text,
                                        PostCmsCreatePage $postCmsPage)
    {
        $ret    = false;
        $count  = 0;
        $values = ArrayHelper::toArray($postCmsPage->form_landing);
        $this->flatArray($values);
        foreach ($values as $keys => $value) {
            $text = str_replace("{{".$keys."}}", $value, $text, $count);
            if (!$ret && $count > 0) {
                $ret = true;
            }
        }
        return $ret;
    }
}