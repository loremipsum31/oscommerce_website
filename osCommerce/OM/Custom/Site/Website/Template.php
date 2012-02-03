<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\OSCOM;

  class Template extends \osCommerce\OM\Core\Template {
    protected $_values = array();

    public function __construct() {
      $this->set('default');
    }

    public static function getTemplates() {
      return array(array('id' => 0,
                         'code' => 'default'));
    }

    public function set($code = null) {
      if ( !isset($_SESSION[OSCOM::getSite()]['template']) ) {
        $data = array();

        foreach ( $this->getTemplates() as $template ) {
          $data = array('id' => $template['id'],
                        'code' => $template['code']);
        }

        $_SESSION[OSCOM::getSite()]['template'] = $data;
      }

      $this->_template_id = $_SESSION[OSCOM::getSite()]['template']['id'];
      $this->_template = $_SESSION[OSCOM::getSite()]['template']['code'];
    }

    public function getContent() {
// The following is only needed for the other sites until their content pages no longer contain PHP
/*
      $rick_astley = array('GLOBALS', '_GET', '_POST', '_COOKIE', '_SESSION', '_FILES', '_SERVER');
      $never_gonna_give_you_up = array();

      foreach ( array_keys($GLOBALS) as $k ) {
        if ( !in_array($k, $rick_astley) ) {
          $never_gonna_give_you_up[$k] = $GLOBALS[$k];
        }
      }

      extract($never_gonna_give_you_up);
*/
      ob_start();

      require($this->getTemplateFile());

      $content = ob_get_clean();

      return $this->parseContent($content);
    }

    public function parseContent($content) {
      static $loaded_tags = array();

      $pattern = '/{([[:alpha:]][[:alnum:]]*)\b}(.*?){\1}/';

      $template_file = $this->getTemplateFile();

      $le = function ($matches) use (&$le, &$pattern, &$template_file) {
        $string = $matches[2];

        if ( preg_match($pattern, $string) > 0 ) {
          $string = preg_replace_callback($pattern, $le, $string);
        }

        if ( class_exists('osCommerce\\OM\\Core\\Template\\Tags\\' . $matches[1]) ) {
          if ( (isset($loaded_tags[$matches[1]]) && ($loaded_tags[$matches[1]] === true) ) || is_subclass_of('osCommerce\\OM\\Core\\Template\\Tags\\' . $matches[1], 'osCommerce\\OM\\Core\\Template\\TagAbstract') ) {
            if ( !isset($loaded_tags[$matches[1]]) ) {
              $loaded_tags[$matches[1]] = true;
            }

            $output = call_user_func(array('osCommerce\\OM\\Core\\Template\\Tags\\' . $matches[1], 'execute'), $string);

            if ( call_user_func(array('osCommerce\\OM\\Core\\Template\\Tags\\' . $matches[1], 'parseResult')) === true ) {
              $output = preg_replace_callback($pattern, $le, $output);
            }

            return $output;
          } else {
            if ( !isset($loaded_tags[$matches[1]]) ) {
              $loaded_tags[$matches[1]] = false;
            }

            trigger_error('Template Tag {' . $matches[1] . '} module does not implement TagInterface');
          }
        } else {
          trigger_error('Template Tag {' . $matches[1] . '} module not found in ' . $template_file);

          return $matches[0];
        }
      };

      return preg_replace_callback($pattern, $le, $content);
    }

    public function getValue($key) {
      if ( !$this->valueExists($key) ) {
        trigger_error('OSCOM_Template::getValue - ' . $key . ' is not set');

        return false;
      }

      return $this->_values[$key];
    }

    public function setValue($key, $value, $force = false) {
      if ( $this->valueExists($key) && ($force !== true) ) {
        trigger_error('OSCOM_Template::setValue - ' . $key . ' already set and is not forced to be replaced');

        return false;
      }

      $this->_values[$key] = $value;
    }

    public function valueExists($key) {
      return array_key_exists($key, $this->_values);
    }
  }
?>
