<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\Cache;
  use osCommerce\OM\Core\MessageStack;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\PDO;
  use osCommerce\OM\Core\Registry;

  class Controller implements \osCommerce\OM\Core\SiteInterface {
    protected static $_default_application = 'Index';

    public static function initialize() {
      Registry::set('MessageStack', new MessageStack());
      Registry::set('Cache', new Cache());
      Registry::set('PDO', PDO::initialize());
      Registry::set('Language', new Language());
      Registry::set('Template', new Template());

      $application = 'osCommerce\\OM\\Core\\Site\\Website\\Application\\' . OSCOM::getSiteApplication() . '\\Controller';
      Registry::set('Application', new $application());

      $OSCOM_Template = Registry::get('Template');

      $OSCOM_Template->setApplication(Registry::get('Application'));

      $OSCOM_Language = Registry::get('Language');

      $OSCOM_Template->setValue('html_text_direction', $OSCOM_Language->getTextDirection());
      $OSCOM_Template->setValue('html_lang', OSCOM::getDef('html_lang_code')); // HPDL A better solution is to define the ISO 639-1 value at the language level
      $OSCOM_Template->setValue('html_character_set', $OSCOM_Language->getCharacterSet());
      $OSCOM_Template->setValue('html_page_title', $OSCOM_Template->getPageTitle());
      $OSCOM_Template->setValue('html_page_contents_file', $OSCOM_Template->getPageContentsFile());
      $OSCOM_Template->setValue('current_site_application', OSCOM::getSiteApplication());
      $OSCOM_Template->setValue('current_site_application_action', Registry::get('Application')->getCurrentAction());
      $OSCOM_Template->setValue('site_version', OSCOM::getVersion(OSCOM::getSite()));
    }

    public static function getDefaultApplication() {
      return self::$_default_application;
    }

    public static function hasAccess($application) {
      return true;
    }
  }
?>
