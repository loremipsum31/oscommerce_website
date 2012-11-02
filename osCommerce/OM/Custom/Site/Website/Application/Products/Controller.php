<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Products;

  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class Controller extends \osCommerce\OM\Core\Site\Website\ApplicationAbstract {
    protected function initialize() {
      $OSCOM_Template = Registry::get('Template');

      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('products_html_page_title');

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/products.jpg') ) {
        $OSCOM_Template->setValue('highlights_image', 'images/products.jpg');
      } else {
        $OSCOM_Template->setValue('highlights_image', 'images/940x285.gif');
      }
    }
  }
?>
