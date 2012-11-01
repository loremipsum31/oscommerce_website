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

  class Legal {
    public static function execute(ApplicationAbstract $application) {
      $application->setPageContent('legal.html');
      $application->setPageTitle(OSCOM::getDef('legal_html_page_title'));
    }
  }
?>
