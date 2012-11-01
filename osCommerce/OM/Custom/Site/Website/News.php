<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\OSCOM;

  class News {
    protected static $_news;

    public static function getListing() {
      return OSCOM::callDB('Website\GetNewsListing', null, 'Site');
    }

    public static function get($id, $key = null) {
      if ( !isset(static::$_news[$id]) ) {
        static::$_news[$id] = OSCOM::callDB('Website\GetNews', array('id' => $id), 'Site');
      }

      return isset($key) ? static::$_news[$id][$key] : static::$_news[$id];
    }

    public static function exists($id) {
      if ( !isset(static::$_news[$id]) ) {
        static::$_news[$id] = OSCOM::callDB('Website\GetNews', array('id' => $id), 'Site');
      }

      return isset(static::$_news[$id]) && !empty(static::$_news[$id]);
    }
  }
?>
