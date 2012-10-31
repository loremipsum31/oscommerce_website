<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetPartner {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      $Qpartner = $OSCOM_PDO->prepare('select * from :table_website_partner where code = :code');
      $Qpartner->bindParam(':code', $data['code']);
      $Qpartner->setCache('website_partner-' . $data['code']);
      $Qpartner->execute();

      return $Qpartner->fetch();
    }
  }
?>
