<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetPartnerCategories {
    public static function execute() {
      $OSCOM_PDO = Registry::get('PDO');

      $Qgroups = $OSCOM_PDO->prepare('select c.id, c.title, c.code from :table_website_partner_category c, :table_website_partner_transaction t, :table_website_partner p, :table_website_partner_package pp where t.date_start <= now() and t.date_end >= now() and t.package_id = pp.id and pp.status = 1 and t.partner_id = p.id and p.category_id = c.id group by c.id order by c.sort_order, c.title');
      $Qgroups->setCache('website_partner_categories', 720);
      $Qgroups->execute();

      return $Qgroups->fetchAll();
    }
  }
?>
