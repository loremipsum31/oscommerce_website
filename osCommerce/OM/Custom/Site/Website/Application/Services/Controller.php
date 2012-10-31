<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Services;

  use osCommerce\OM\Core\HTML;
  use osCommerce\OM\Core\HttpRequest;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;
  use osCommerce\OM\Core\Site\Website\Partner;

  class Controller extends \osCommerce\OM\Core\Site\Website\ApplicationAbstract {
    protected function initialize() {
      $OSCOM_Template = Registry::get('Template');

      $this->_page_contents = 'main.html';
      $this->_page_title = OSCOM::getDef('services_html_page_title');

      if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . OSCOM::getSite() . '/images/services.jpg') ) {
        $OSCOM_Template->setValue('highlights_image', 'images/services.jpg');
      } else {
        $OSCOM_Template->setValue('highlights_image', 'images/940x285.gif');
      }

      $OSCOM_Template->setValue('services_action', '');
      $OSCOM_Template->setValue('partner_categories', Partner::getCategories());
    }

    public function runActions() {
      $OSCOM_Template = Registry::get('Template');

      parent::runActions();

      if ( is_null($this->getCurrentAction()) ) {
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

          if ( !empty($requested_action) ) {
            $requested_action = strtolower($requested_action);

            if ( Partner::categoryExists($requested_action) ) {
              $action = $requested_action;
            } else {
              HttpRequest::setResponseCode(404);
            }
          }
        }

        if ( isset($action) ) {
          $action_index++;

          if ( $action_index < count($_GET) ) {
            $subaction = strtolower(HTML::sanitize(basename(key(array_slice($_GET, $action_index, 1, true)))));
          }

          if ( isset($subaction) && Partner::exists($subaction, $action) ) {
            $this->_page_contents = 'info.html';
            $this->_page_title = OSCOM::getDef('partner_html_page_title', array(':partner_title' => Partner::get($subaction, 'title')));

            $partner = Partner::get($subaction);

            $OSCOM_Template->setValue('partner', $partner);
            $OSCOM_Template->setValue('partner_header', (empty($partner['image_big']) ? HTML::image(OSCOM::getPublicSiteLink($OSCOM_Template->getValue('highlights_image')), null, 940, 285) : '<a href="' . HTML::outputProtected($partner['url']) . '" target="_blank">' . HTML::image(OSCOM::getPublicSiteLink('images/partners/' . $partner['image_big']), null, 940, 285) . '</a>'));
          } else {
            if ( isset($subaction) ) {
              HttpRequest::setResponseCode(404);
            }

            $this->_page_contents = 'list.html';
            $this->_page_title = OSCOM::getDef('listing_html_page_title', array(':category_title' => Partner::getCategory($action, 'title')));

            $OSCOM_Template->setValue('page_title', Partner::getCategory($action, 'title'));
            $OSCOM_Template->setValue('category_partners', Partner::getInCategory($action));
          }

          $OSCOM_Template->setValue('services_action', $action, true);
        } else {
          $OSCOM_Template->setValue('partner_promotions', Partner::getPromotions());
        }
      }
    }
  }
?>
