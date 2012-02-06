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

  class getAllApplications {
    public static function execute($site_id) {
      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Core/Site/' . $site_id . '/Application');
      $DL->setIncludeFiles(false);

      $apps_raw = array();

      foreach ( $DL->getFiles(false) as $file ) {
        if ( preg_match('/^[A-Z][A-Za-z0-9-_]*$/', $file['name']) ) {
          $apps_raw[] = $file['name'];
        }
      }

      $DL = new DirectoryListing(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $site_id . '/Application');
      $DL->setIncludeFiles(false);

      foreach ( $DL->getFiles(false) as $file ) {
        if ( preg_match('/^[A-Z][A-Za-z0-9-_]*$/', $file['name']) ) {
          $apps_raw[] = $file['name'];
        }
      }

      $apps_raw = array_unique($apps_raw);

      sort($apps_raw);

      $apps = array();

      foreach ( $apps_raw as $app ) {
        $apps[] = array('id' => $app);
      }

      $result = array('entries' => $apps,
                      'total' => count($apps));

      return $result;
    }
  }
?>
