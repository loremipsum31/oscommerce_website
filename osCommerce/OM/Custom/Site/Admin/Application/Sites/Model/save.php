<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Sites\Model;

  use osCommerce\OM\Core\Exception\MessageStackException;
  use osCommerce\OM\Core\OSCOM;

  class save {
    public static function execute($data) {
      try {
        if ( !preg_match('/[A-Z][A-Za-z0-9-_]*/', $data['site']) ) {
          throw new MessageStackException('error_invalid_site_name');
        }

        if ( OSCOM::siteExists($data['site']) ) {
          throw new MessageStackException('error_site_already_exists');
        }

        if ( !preg_match('/[A-Z][A-Za-z0-9-_]*/', $data['application']) ) {
          throw new MessageStackException('error_invalid_application_name');
        }

        if ( file_exists(OSCOM::BASE_DIRECTORY . 'Custom/Site') && !is_writable(OSCOM::BASE_DIRECTORY . 'Custom/Site') ) {
          throw new MessageStackException('error_site_directory_not_writable');
        } elseif ( !is_writable(OSCOM::BASE_DIRECTORY . 'Custom') ) {
          throw new MessageStackException('error_custom_directory_not_writable');
        }

        if ( file_exists(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site']) ) {
          throw new MessageStackException('error_public_site_directory_already_exists');
        }

        if ( !is_writable(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites') ) {
          throw new MessageStackException('error_public_sites_directory_not_writable');
        }

        if ( !is_writable(OSCOM::BASE_DIRECTORY . 'Config/settings.ini') ) {
          throw new MessageStackException('error_settings_file_not_writable');
        }

        $ini = parse_ini_file(OSCOM::BASE_DIRECTORY . 'Config/settings.ini', true);

        $ini[$data['site']] = array('enable_ssl' => OSCOM::getConfig('enable_ssl', OSCOM::getDefaultSite()),
                                    'http_server' => OSCOM::getConfig('http_server', OSCOM::getDefaultSite()),
                                    'https_server' => OSCOM::getConfig('https_server', OSCOM::getDefaultSite()),
                                    'http_cookie_domain' => OSCOM::getConfig('http_cookie_domain', OSCOM::getDefaultSite()),
                                    'https_cookie_domain' => OSCOM::getConfig('https_cookie_domain', OSCOM::getDefaultSite()),
                                    'http_cookie_path' => OSCOM::getConfig('http_cookie_path', OSCOM::getDefaultSite()),
                                    'https_cookie_path' => OSCOM::getConfig('https_cookie_path', OSCOM::getDefaultSite()),
                                    'dir_ws_http_server' => OSCOM::getConfig('dir_ws_http_server', OSCOM::getDefaultSite()),
                                    'dir_ws_https_server' => OSCOM::getConfig('dir_ws_https_server', OSCOM::getDefaultSite()),
                                    'db_server' => OSCOM::getConfig('db_server', OSCOM::getDefaultSite()),
                                    'db_server_username' => OSCOM::getConfig('db_server_username', OSCOM::getDefaultSite()),
                                    'db_server_password' => OSCOM::getConfig('db_server_password', OSCOM::getDefaultSite()),
                                    'db_server_port' => OSCOM::getConfig('db_server_port', OSCOM::getDefaultSite()),
                                    'db_database' => OSCOM::getConfig('db_database', OSCOM::getDefaultSite()),
                                    'db_driver' => OSCOM::getConfig('db_driver', OSCOM::getDefaultSite()),
                                    'db_table_prefix' => OSCOM::getConfig('db_table_prefix', OSCOM::getDefaultSite()),
                                    'db_server_persistent_connections' => OSCOM::getConfig('db_server_persistent_connections', OSCOM::getDefaultSite()),
                                    'store_sessions' => OSCOM::getConfig('store_sessions', OSCOM::getDefaultSite()));

        $new_ini = '';

        foreach ( $ini as $k => $v ) {
          $new_ini .= '[' . $k . ']' . "\n";

          foreach ( $v as $x => $y ) {
            $new_ini .= $x . ' = "' . $y . '"' . "\n";
          }

          $new_ini .= "\n";
        }

        $new_ini = trim($new_ini);

        file_put_contents(OSCOM::BASE_DIRECTORY . 'Config/settings.ini', $new_ini);

        if ( !file_exists(OSCOM::BASE_DIRECTORY . 'Custom/Site') ) {
          mkdir(OSCOM::BASE_DIRECTORY . 'Custom/Site', 0777);
        }

        mkdir(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application', 0777, true);
// mkdir() does not seem to set 0777 permissions so we set them again with chmod()
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'], 0777);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application', 0777);

        mkdir(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/languages/en_US', 0777, true);
// mkdir() does not seem to set 0777 permissions so we set them again with chmod()
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/languages', 0777);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/languages/en_US', 0777);

        mkdir(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/templates', 0777);
// mkdir() does not seem to set 0777 permissions so we set them again with chmod()
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/templates', 0777);

        $site_controller = file_get_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/Controller.php');
        $site_controller = str_replace(array('SITE_ID', 'APPLICATION_ID'), array($data['site'], $data['application']), $site_controller);
        file_put_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Controller.php', $site_controller);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Controller.php', 0777);
        unset($site_controller);

        $site_aa = file_get_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/ApplicationAbstract.php');
        $site_aa = str_replace('SITE_ID', $data['site'], $site_aa);
        file_put_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/ApplicationAbstract.php', $site_aa);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/ApplicationAbstract.php', 0777);
        unset($site_aa);

        copy(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/templates/default.php', OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/templates/default.php');
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/templates/default.php', 0777);

        copy(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/languages/en_US.php', OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/languages/en_US.php');
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/languages/en_US.php', 0777);

        mkdir(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates/default/stylesheets', 0777, true);
// mkdir() does not seem to set 0777 permissions so we set them again with chmod()
        chmod(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'], 0777);
        chmod(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates', 0777);
        chmod(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates/default', 0777);
        chmod(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates/default/stylesheets', 0777);

        copy(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/public/templates/default/stylesheets/general.css', OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates/default/stylesheets/general.css');
        chmod(OSCOM::getConfig('dir_fs_public', 'OSCOM') . 'sites/' . $data['site'] . '/templates/default/stylesheets/general.css', 0777);

        $d = array('site' => $data['site'],
                   'name' => $data['application']);

        saveApplication::execute($d);

        return true;
      } catch ( \Exception $e ) {
        if ( !($e instanceof MessageStackException) ) {
          trigger_error($e->getMessage());
        }
      }

      return false;
    }
  }
?>
