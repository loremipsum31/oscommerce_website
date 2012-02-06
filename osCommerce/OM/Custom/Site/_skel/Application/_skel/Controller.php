<?php
  namespace osCommerce\OM\Core\Site\SITE_ID\Application\APPLICATION_ID;

  use osCommerce\OM\Core\OSCOM;

  class Controller extends \osCommerce\OM\Core\Site\SITE_ID\ApplicationAbstract {
    protected function initialize() {
      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('page_title');
    }
  }
?>
