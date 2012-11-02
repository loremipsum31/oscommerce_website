<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\OSCOM;

  class Download {
    protected static $_files;

    public static function get($id, $key = null) {
      if ( !isset(static::$_files[$id]) ) {
        static::$_files[$id] = OSCOM::callDB('Website\GetDownload', array('id' => $id), 'Site');
      }

      return isset($key) ? static::$_files[$id][$key] : static::$_files[$id];
    }

    public static function exists($id) {
      if ( !isset(static::$_files[$id]) ) {
        static::$_files[$id] = OSCOM::callDB('Website\GetDownload', array('id' => $id), 'Site');
      }

      return isset(static::$_files[$id]) && !empty(static::$_files[$id]);
    }

    public static function incrementDownloadCounter($id) {
      return OSCOM::callDB('Website\IncrementDownloadCounter', array('id' => $id), 'Site');
    }

    public static function logDownload($id) {
      return OSCOM::callDB('Website\LogDownload', array('id' => $id, 'ip_address' => sprintf('%u', ip2long(OSCOM::getIPAddress()))), 'Site');
    }
  }
?>
