<?php
/**
 * Smarty plugin.
 *
 * @package    Smarty
 * @subpackage Vendor\Athlon\SmartyPlugins
 * @author     Kalin Stefanov <kalin@athlonsofia.com>
 * @copyright  Copyright (c) 2015, Silla.io
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

/**
 * Smarty pluralize modifier plugin.
 *
 * Type:     modifier<br>
 * Name:     pluralize<br>
 * Purpose:  pluralize words in the string
 *
 * @param string $string Input string to pluralize.
 *
 * @return string
 */
function smarty_modifier_pluralize($string)
{
    $inflector = new \Vendor\Athlon\Inflector();

    return $inflector->pluralize($string);
}
