<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetNewsListing {
    public static function execute() {
      $OSCOM_PDO = Registry::get('PDO');

      $Qnews = $OSCOM_PDO->prepare('select id, title, date_added, date_format(date_added, "%D %M %Y") as date_added_formatted from :table_website_news where status = 1 order by date_added desc, title');
      $Qnews->setCache('website-news-listing');
      $Qnews->execute();

      return $Qnews->fetchAll();
    }
  }
?>
