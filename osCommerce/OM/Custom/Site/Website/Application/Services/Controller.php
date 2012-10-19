<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Services;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class Controller extends \osCommerce\OM\Core\Site\Website\ApplicationAbstract {
    protected function initialize() {
      $OSCOM_Template = Registry::get('Template');

      $OSCOM_Template->setValue('services_action', '');

      $action = null;
      $action_index = 1;
      $subaction = null;

      if ( count($_GET) > 1 ) {
        $requested_action = HTML::sanitize(basename(key(array_slice($_GET, 1, 1, true))));

        if ( $requested_action == OSCOM::getSiteApplication() ) {
          $requested_action = null;

          if ( count($_GET) > 2 ) {
            $requested_action = HTML::sanitize(basename(key(array_slice($_GET, 2, 1, true))));

            $action_index = 2;
          }
        }

        if ( !empty($requested_action) && in_array($requested_action, static::getServiceCategories()) ) {
          $action = $requested_action;
        }
      }

      if ( isset($action) ) {
        $action_index++;

        if ( $action_index < count($_GET) ) {
          $subaction = HTML::sanitize(basename(key(array_slice($_GET, $action_index, 1, true))));
        }

        if ( in_array($subaction, static::getServicePartners($action)) ) {
          $this->_page_contents = 'info.html';
          $this->page_title = OSCOM::getDef('info_html_page_title');
        } else {
          $this->_page_contents = 'list.html';
          $this->page_title = OSCOM::getDef(strtolower($action) . '_html_page_title');
        }

        $OSCOM_Template->setValue('services_action', $action, true);
      } else {
        $this->_page_contents = 'main.html';
        $this->_page_title = OSCOM::getDef('services_html_page_title');
      }
    }

    protected static function getServiceCategories() {
      return array('Hosting', 'Developers', 'Payment', 'Templates', 'Security', 'Marketing');
    }

    protected static function getServicePartners($category) {
      return array('Info');
    }
  }
?>
