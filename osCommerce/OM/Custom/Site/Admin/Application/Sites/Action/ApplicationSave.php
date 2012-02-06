<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Sites\Action;

  use osCommerce\OM\Core\ApplicationAbstract;

  class ApplicationSave {
    public static function execute(ApplicationAbstract $application) {
      $application->setPageContent('applications_new.php');
    }
  }
?>
