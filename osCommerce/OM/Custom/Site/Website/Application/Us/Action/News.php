<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Us\Action;

  use osCommerce\OM\Core\ApplicationAbstract;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;
  use osCommerce\OM\Core\Site\Website\News as NewsClass;

  class News {
    public static function execute(ApplicationAbstract $application) {
      $OSCOM_Template = Registry::get('Template');

      if ( !empty($_GET['News']) && is_numeric($_GET['News']) && NewsClass::exists($_GET['News']) ) {
        $application->setPageContent('news_entry.html');
        $application->setPageTitle(OSCOM::getDef('news_entry_html_page_title', array(':news_title' => NewsClass::get($_GET['News'], 'title'))));

        $OSCOM_Template->setValue('news_entry', NewsClass::get($_GET['News']));
      } else {
        $application->setPageContent('news.html');
        $application->setPageTitle(OSCOM::getDef('news_html_page_title'));

        $OSCOM_Template->setValue('news_listing', NewsClass::getListing());
      }
    }
  }
?>
