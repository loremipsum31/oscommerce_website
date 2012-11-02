<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class IncrementDownloadCounter {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      $Qfile = $OSCOM_PDO->prepare('update :table_website_downloads set counter = counter+1 where id = :id');
      $Qfile->bindInt(':id', $data['id']);
      $Qfile->execute();

      return $Qfile->rowCount();
    }
  }
?>
