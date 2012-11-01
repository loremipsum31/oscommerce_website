<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Support;

  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class Controller extends \osCommerce\OM\Core\Site\Website\ApplicationAbstract {
    protected function initialize() {
      $OSCOM_Template = Registry::get('Template');

      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('support_html_page_title');

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support.jpg') ) {
        $OSCOM_Template->setValue('highlights_image', 'images/support.jpg');
      } else {
        $OSCOM_Template->setValue('highlights_image', 'images/940x285.gif');
      }

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support-partners.jpg') ) {
        $OSCOM_Template->setValue('support-partners_image', 'images/support-partners.jpg');
      } else {
        $OSCOM_Template->setValue('support-partners_image', 'images/150x100.gif');
      }

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support-support_tickets.jpg') ) {
        $OSCOM_Template->setValue('support-support_tickets_image', 'images/support-support_tickets.jpg');
      } else {
        $OSCOM_Template->setValue('support-support_tickets_image', 'images/150x100.gif');
      }

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support-hire_developers.jpg') ) {
        $OSCOM_Template->setValue('support-hire_developers_image', 'images/support-hire_developers.jpg');
      } else {
        $OSCOM_Template->setValue('support-hire_developers_image', 'images/150x100.gif');
      }

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support-forum.jpg') ) {
        $OSCOM_Template->setValue('support-forum_image', 'images/support-forum.jpg');
      } else {
        $OSCOM_Template->setValue('support-forum_image', 'images/150x100.gif');
      }

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/support-live_chat.jpg') ) {
        $OSCOM_Template->setValue('support-live_chat_image', 'images/support-live_chat.jpg');
      } else {
        $OSCOM_Template->setValue('support-live_chat_image', 'images/150x100.gif');
      }
    }
  }
?>
