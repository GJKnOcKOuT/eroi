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
 * XHTML 1.1 List Module, defines list-oriented elements. Core Module.
 */
class HTMLPurifier_HTMLModule_List extends HTMLPurifier_HTMLModule
{
    /**
     * @type string
     */
    public $name = 'List';

    // According to the abstract schema, the List content set is a fully formed
    // one or more expr, but it invariably occurs in an optional declaration
    // so we're not going to do that subtlety. It might cause trouble
    // if a user defines "List" and expects that multiple lists are
    // allowed to be specified, but then again, that's not very intuitive.
    // Furthermore, the actual XML Schema may disagree. Regardless,
    // we don't have support for such nested expressions without using
    // the incredibly inefficient and draconic Custom ChildDef.

    /**
     * @type array
     */
    public $content_sets = array('Flow' => 'List');

    /**
     * @param HTMLPurifier_Config $config
     */
    public function setup($config)
    {
        $ol = $this->addElement('ol', 'List', new HTMLPurifier_ChildDef_List(), 'Common');
        $ul = $this->addElement('ul', 'List', new HTMLPurifier_ChildDef_List(), 'Common');
        // XXX The wrap attribute is handled by MakeWellFormed.  This is all
        // quite unsatisfactory, because we generated this
        // *specifically* for lists, and now a big chunk of the handling
        // is done properly by the List ChildDef.  So actually, we just
        // want enough information to make autoclosing work properly,
        // and then hand off the tricky stuff to the ChildDef.
        $ol->wrap = 'li';
        $ul->wrap = 'li';
        $this->addElement('dl', 'List', 'Required: dt | dd', 'Common');

        $this->addElement('li', false, 'Flow', 'Common');

        $this->addElement('dd', false, 'Flow', 'Common');
        $this->addElement('dt', false, 'Inline', 'Common');
    }
}

// vim: et sw=4 sts=4
