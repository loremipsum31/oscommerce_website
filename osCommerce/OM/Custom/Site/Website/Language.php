<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\OSCOM;

  class Language extends \osCommerce\OM\Core\Site\Admin\Language {
    public function __construct() {
      parent::__construct();
    }

    public function set($code = null) {
      $this->_code = $code;

      if ( empty($this->_code) ) {
        if ( isset($_COOKIE[OSCOM::getSite()]['language']) ) {
          $this->_code = $_COOKIE[OSCOM::getSite()]['language'];
        } else {
          $this->_code = $this->getBrowserSetting();
        }
      }

      if ( empty($this->_code) || !$this->exists($this->_code) ) {
        $this->_code = 'en_US';
      }

      if ( !isset($_COOKIE[OSCOM::getSite()]['language']) || ($_COOKIE[OSCOM::getSite()]['language'] != $this->_code) ) {
        OSCOM::setCookie(OSCOM::getSite() . '[language]', $this->_code, time()+60*60*24*90);
      }
    }
  }
?>
