<?php
/**
 * osCommerce Website
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Website\Modules\Template\Widgets\index_sidebar_nav;

  use osCommerce\OM\Core\HttpRequest;
  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class Controller extends \osCommerce\OM\Core\Template\WidgetAbstract {
    static public function execute() {
      $OSCOM_Template = Registry::get('Template');

      $OSCOM_Template->setValue('stats_addons', number_format(6700));
      $OSCOM_Template->setValue('stats_sites', number_format(12700));
      $OSCOM_Template->setValue('stats_community_online_users', static::getOnlineUsers());
      $OSCOM_Template->setValue('stats_community_total_users', static::getTotalUsers());
      $OSCOM_Template->setValue('stats_community_total_forum_postings', static::getTotalForumPostings());

      $file = OSCOM::BASE_DIRECTORY . 'Custom/Site/' . OSCOM::getSite() . '/Modules/Template/Widgets/index_sidebar_nav/pages/main.html';

      if ( !file_exists($file) ) {
        $file = OSCOM::BASE_DIRECTORY . 'Core/Site/' . OSCOM::getSite() . '/Modules/Template/Widgets/index_sidebar_nav/pages/main.html';
      }

      return file_get_contents($file);
    }

    static public function getOnlineUsers() {
      $OSCOM_Cache = Registry::get('Cache');

      $data = null;
      $users = 700;

      if ( OSCOM::configExists('community_api_key') ) {
        if ( $OSCOM_Cache->read('stats_community_api_fetchOnlineUsers', 60) ) {
          $data = $OSCOM_Cache->getCache();
        } else {
          $request = xmlrpc_encode_request('fetchOnlineUsers', array('api_key' => OSCOM::getConfig('community_api_key'),
                                                                     'api_module' => OSCOM::getConfig('community_api_module')));

          $data = xmlrpc_decode(HttpRequest::getResponse(array('url' => OSCOM::getConfig('community_api_address'),
                                                               'parameters' => $request)));

          if ( is_array($data) && !empty($data) && isset($data['TOTAL']) ) {
            $OSCOM_Cache->write($data);
          }
        }

        if ( isset($data) ) {
          $users = (int)str_replace(',', '', $data['TOTAL']);
        }
      }

      return number_format($users);
    }

    static public function getTotalUsers() {
      $OSCOM_Cache = Registry::get('Cache');

      $data = null;
      $users = 250000;

      if ( OSCOM::configExists('community_api_key') ) {
        if ( $OSCOM_Cache->read('stats_community_api_fetchStats', 1440) ) {
          $data = $OSCOM_Cache->getCache();
        } else {
          $request = xmlrpc_encode_request('fetchStats', array('api_key' => OSCOM::getConfig('community_api_key'),
                                                               'api_module' => OSCOM::getConfig('community_api_module')));

          $data = xmlrpc_decode(HttpRequest::getResponse(array('url' => OSCOM::getConfig('community_api_address'),
                                                               'parameters' => $request)));

          if ( is_array($data) && !empty($data) && isset($data['total_members']) ) {
            $OSCOM_Cache->write($data);
          }
        }

        if ( isset($data) ) {
          $users = (int)str_replace(',', '', $data['total_members']);
        }
      }

      return number_format($users);
    }

    static public function getTotalForumPostings() {
      $OSCOM_Cache = Registry::get('Cache');

      $data = null;
      $posts = 1500000;

      if ( OSCOM::configExists('community_api_key') ) {
        if ( $OSCOM_Cache->read('stats_community_api_fetchStats', 1440) ) {
          $data = $OSCOM_Cache->getCache();
        } else {
          $request = xmlrpc_encode_request('fetchStats', array('api_key' => OSCOM::getConfig('community_api_key'),
                                                               'api_module' => OSCOM::getConfig('community_api_module')));

          $data = xmlrpc_decode(HttpRequest::getResponse(array('url' => OSCOM::getConfig('community_api_address'),
                                                               'parameters' => $request)));

          if ( is_array($data) && !empty($data) && isset($data['total_posts']) ) {
            $OSCOM_Cache->write($data);
          }
        }

        if ( isset($data) ) {
          $posts = (int)str_replace(',', '', $data['total_posts']);
        }
      }

      return number_format($posts);
    }
  }
?>
