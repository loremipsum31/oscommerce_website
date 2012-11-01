<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website;

  use osCommerce\OM\Core\OSCOM;

  class Partner {
    protected static $_partner;
    protected static $_partners;
    protected static $_categories;
    protected static $_promotions;

    public static function get($code, $key = null) {
      if ( !isset(static::$_partner[$code]) ) {
        static::$_partner[$code] = OSCOM::callDB('Website\GetPartner', array('code' => $code), 'Site');
      }

      return isset($key) ? static::$_partner[$code][$key] : static::$_partner[$code];
    }

    public static function getAll() {
      return OSCOM::callDB('Website\GetPartnersAll', null, 'Site');
    }

    public static function getInCategory($code) {
      if ( !isset(static::$_partners[$code]) ) {
        static::$_partners[$code] = OSCOM::callDB('Website\GetPartners', array('code' => $code), 'Site');
      }

      return static::$_partners[$code];
    }

    public static function exists($code, $category) {
      if ( !isset(static::$_partners[$category]) ) {
        static::$_partners[$category] = OSCOM::callDB('Website\GetPartners', array('code' => $category), 'Site');
      }

      foreach ( static::$_partners[$category] as $p ) {
        if ( $p['code'] == $code ) {
          return true;
        }
      }

      return false;
    }

    public static function getCategory($code, $key = null) {
      if ( !isset(static::$_categories) ) {
        static::getCategories();
      }

      foreach ( static::$_categories as $c ) {
        if ( $c['code'] == $code ) {
          return isset($key) ? $c[$key] : $c;
        }
      }

      return false;
    }

    public static function getCategories() {
      if ( !isset(static::$_categories) ) {
        static::$_categories = OSCOM::callDB('Website\GetPartnerCategories', null, 'Site');
      }

      return static::$_categories;
    }

    public static function categoryExists($code) {
      if ( !isset(static::$_categories) ) {
        static::getCategories();
      }

      foreach ( static::$_categories as $c ) {
        if ( $c['code'] == $code ) {
          return true;
        }
      }

      return false;
    }

    public static function getPromotions() {
      if ( !isset(static::$_promotions) ) {
        static::$_promotions = OSCOM::callDB('Website\GetPartnerPromotions', null, 'Site');
      }

      return static::$_promotions;
    }
  }
