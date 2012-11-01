<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\SQL\ANSI;

  use osCommerce\OM\Core\Registry;

  class GetPartners {
    public static function execute($data) {
      $OSCOM_PDO = Registry::get('PDO');

      $Qpartners = $OSCOM_PDO->prepare('select p.title, p.code, p.desc_short, p.image_small from :table_website_partner p, :table_website_partner_transaction t, :table_website_partner_package pp, :table_website_partner_category c where t.date_start <= now() and t.date_end >= now() and t.package_id = pp.id and pp.status = 1 and t.partner_id = p.id and p.category_id = c.id and c.code = :category_code group by p.id order by sum(t.cost) desc, p.title');
      $Qpartners->bindParam(':category_code', $data['code']);
      $Qpartners->setCache('website_partners-' . $data['code'], 720);
      $Qpartners->execute();

      return $Qpartners->fetchAll();
    }
  }
?>
