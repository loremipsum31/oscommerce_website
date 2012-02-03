<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Index;

  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class Controller extends \osCommerce\OM\Core\Site\Setup\ApplicationAbstract {
    protected function initialize() {
      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('html_page_title');

      $OSCOM_Template = Registry::get('Template');

      $OSCOM_Template->setValue('stats_addons', number_format(6700));
      $OSCOM_Template->setValue('stats_sites', number_format(12700));
      $OSCOM_Template->setValue('stats_members', number_format(258000));
      $OSCOM_Template->setValue('stats_members_online', number_format(700));
    }
  }
?>
