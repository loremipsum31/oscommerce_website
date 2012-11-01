<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetPartnerPromotions {
    public static function execute() {
      $OSCOM_PDO = Registry::get('PDO');

      $Qpromos = $OSCOM_PDO->prepare('select p.title, p.code, p.image_promo, p.image_promo_url, c.code as category_code from :table_website_partner_transaction t, :table_website_partner p, :table_website_partner_package pp, :table_website_partner_category c where p.image_promo != "" and p.id = t.partner_id and t.date_start <= now() and t.date_end >= now() and t.package_id = pp.id and pp.status = 1 and p.category_id = c.id group by p.id order by sum(t.cost) desc, p.title');
      $Qpromos->setCache('website_partner_promotions', 720);
      $Qpromos->execute();

      return $Qpromos->fetchAll();
    }
  }
?>
