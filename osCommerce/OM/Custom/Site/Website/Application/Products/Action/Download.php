<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Application\Products\Action;

  use osCommerce\OM\Core\ApplicationAbstract;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Site\Website\Download as DownloadClass;

  class Download {
    public static function execute(ApplicationAbstract $application) {
      $file = null;

      if ( !empty($_GET['Download']) && is_numeric($_GET['Download']) && ($_GET['Download'] > 0) ) {
        $file = $_GET['Download'];
      } elseif ( isset($_POST['get']) && !empty($_POST['get']) && is_numeric($_POST['get']) && ($_POST['get'] > 0) ) {
        $file = $_POST['get'];
      }

      if ( isset($file) && DownloadClass::exists($file) ) {
        DownloadClass::incrementDownloadCounter($file);
        DownloadClass::logDownload($file);

        header('Location: http://www.oscommerce.com/files/' . rawurlencode(basename(DownloadClass::get($file, 'filename'))));
        exit;
      }

      OSCOM::redirect(OSCOM::getLink());
    }
  }
?>
