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
  use osCommerce\OM\Core\Site\Website\Partner;

  class Controller extends \osCommerce\OM\Core\Site\Website\ApplicationAbstract {
    protected function initialize() {
      $OSCOM_Cache = Registry::get('Cache');
      $OSCOM_Template = Registry::get('Template');

      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('html_page_title');

      if ( $OSCOM_Cache->read('website_partners-frontpage_promotions', 15) ) {
        $partners = $OSCOM_Cache->getCache();
      } else {
        $partners = Partner::getPromotions();

        shuffle($partners);

        if ( count($partners) > 4 ) {
          $partners = array_slice($partners, 0, 4);
        }

        $OSCOM_Cache->write($partners, 'website_partners-frontpage_promotions');
      }

      $OSCOM_Template->setValue('random_partner_promotions', $partners);

      if ( $OSCOM_Cache->read('website_partners-frontpage', 15) ) {
        $partners = $OSCOM_Cache->getCache();
      } else {
        $partners = Partner::getAll();

        shuffle($partners);

        if ( count($partners) > 6 ) {
          $partners = array_slice($partners, 0, 6);
        }

        $OSCOM_Cache->write($partners, 'website_partners-frontpage');
      }

      $OSCOM_Template->setValue('random_partners', $partners);
    }
  }
?>
