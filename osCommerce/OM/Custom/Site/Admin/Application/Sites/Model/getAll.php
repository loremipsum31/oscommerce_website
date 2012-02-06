<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Sites\Model;

  use osCommerce\OM\Core\DirectoryListing;
  use osCommerce\OM\Core\OSCOM;

  class getAll {
    public static function execute() {
      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Core/Site');
      $DL->setIncludeFiles(false);
      $DL->setExcludeEntries('_skel');

      $sites_raw = array();

      foreach ( $DL->getFiles(false) as $file ) {
        if ( preg_match('/^[A-Z][A-Za-z0-9-_]*$/', $file['name']) ) {
          $sites_raw[] = $file['name'];
        }
      }

      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Custom/Site');
      $DL->setIncludeFiles(false);
      $DL->setExcludeEntries('_skel');

      foreach ( $DL->getFiles(false) as $file ) {
        if ( preg_match('/^[A-Z][A-Za-z0-9-_]*$/', $file['name']) ) {
          $sites_raw[] = $file['name'];
        }
      }

      $sites_raw = array_unique($sites_raw);

      sort($sites_raw);

      $sites = array();

      foreach ( $sites_raw as $site ) {
        $sites[] = array('id' => $site);
      }

      $result = array('entries' => $sites,
                      'total' => count($sites));

      return $result;
    }
  }
?>
