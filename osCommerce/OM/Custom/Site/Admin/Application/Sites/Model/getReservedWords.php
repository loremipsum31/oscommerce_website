<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Sites\Model;

  class getReservedWords {
    public static function execute() {
      $words = array('abstract',
                     'and',
                     'array',
                     'as',
                     'break',
                     'case',
                     'catch',
                     'class',
                     'clone',
                     'const',
                     'continue',
                     'declare',
                     'default',
                     'do',
                     'else',
                     'elseif',
                     'enddeclare',
                     'endfor',
                     'endforeach',
                     'endif',
                     'endswitch',
                     'endwhile',
                     'extends',
                     'final',
                     'for',
                     'foreach',
                     'function',
                     'global',
                     'goto',
                     'if',
                     'implements',
                     'interface',
                     'instancof',
                     'namespace',
                     'new',
                     'or',
                     'private',
                     'protected',
                     'public',
                     'static',
                     'switch',
                     'throw',
                     'try',
                     'use',
                     'var',
                     'while',
                     'xor');

      return $words;
    }
  }
?>
