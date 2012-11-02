<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class LogDownload {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      $Qfile = $OSCOM_PDO->prepare('insert into :table_website_downloads_log (id, date_added, ip_address) values (:id, now(), :ip_address)');
      $Qfile->bindInt(':id', $data['id']);
      $Qfile->bindValue(':ip_address', $data['ip_address']);
      $Qfile->execute();

      return $Qfile->rowCount();
    }
  }
?>
