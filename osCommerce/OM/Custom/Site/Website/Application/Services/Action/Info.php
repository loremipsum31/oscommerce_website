<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Services\Action;

  use osCommerce\OM\Core\ApplicationAbstract;
  use osCommerce\OM\Core\OSCOM;

  class Info {
    public static function execute(ApplicationAbstract $application) {
      $application->setPageContent('info.html');
      $application->setPageTitle(OSCOM::getDef('info_html_page_title'));
    }
  }
?>
