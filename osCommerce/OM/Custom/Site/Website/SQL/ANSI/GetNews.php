<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetNews {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      $Qnews = $OSCOM_PDO->prepare('select id, title, body, date_added, date_format(date_added, "%D %M %Y") as date_added_formatted from :table_website_news where id = :id and status = 1');
      $Qnews->bindInt(':id', $data['id']);
      $Qnews->setCache('website-news-' . $data['id']);
      $Qnews->execute();

      return $Qnews->fetch();
    }
  }
?>
