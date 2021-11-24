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


namespace schmunk42\giiant\generators\crud\callbacks\dmstr;

use dmstr\modules\pages\models\Tree;
use kartik\tree\TreeViewInput;

class Pages
{
    public static function dropdown()
    {
        return function () {
            $input = TreeViewInput::className();
            $tree = Tree::className();

            return <<<CODE
\$form->field(\$model, 'request_param')->widget(
    {$input}::className(),
    [
        // single query fetch to render the tree
        'query'          => {$tree}::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Pages'],
        'model'          => \$model,         // input model
        'attribute'      => 'request_param', // input attribute
        'value'          => \$model->route,
        'asDropdown'     => true,           // will render the tree input widget as a dropdown.
        'multiple'       => false,          // set to false if you do not need multiple selection
        'fontAwesome'    => true,           // render font awesome icons
        'rootOptions'    => [
            'label' => '<i class="fa fa-tree"></i>',
            'class' => 'text-success',
        ],
        'options'        => [
            #'data-route' => (\$treeNode !== null) ? \$treeNode->route : null,
        ],
    ]
);
CODE;
        };
    }
}
