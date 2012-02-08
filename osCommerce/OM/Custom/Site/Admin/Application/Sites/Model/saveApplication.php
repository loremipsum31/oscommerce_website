<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Site\Admin\Application\Sites\Model;

  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Exception\MessageStackException;

  class saveApplication {
    public static function execute($data) {
      try {
        if ( !preg_match('/[A-Z][A-Za-z0-9-_]*/', $data['site']) || !OSCOM::siteExists($data['site']) ) {
          throw new MessageStackException('error_invalid_site_name');
        }

        if ( !preg_match('/[A-Z][A-Za-z0-9-_]*/', $data['name']) ) {
          throw new MessageStackException('error_invalid_application_name');
        }

        if ( file_exists(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name']) ) {
          throw new MessageStackException('error_application_already_exists');
        }

        if ( !is_writable(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application') ) {
          throw new MessageStackException('error_application_directory_not_writable');
        }

        mkdir(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/pages', 0777, true);
// mkdir() does not seem to set 0777 permissions so we set them again with chmod()
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'], 0777);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/pages', 0777);

        $app_controller = file_get_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/Application/_skel/Controller.php');

        $app_controller = str_replace(array('SITE_ID', 'APPLICATION_ID'), array($data['site'], $data['name']), $app_controller);

        file_put_contents(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/Controller.php', $app_controller);
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/Controller.php', 0777);

        unset($app_controller);

        copy(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/Application/_skel/pages/main.html', OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/pages/main.html');
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Application/' . $data['name'] . '/pages/main.html', 0777);

        copy(OSCOM::BASE_DIRECTORY . 'Custom/Site/_skel/Languages/en_US/_skel.php', OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Languages/en_US/' . $data['name'] . '.php');
        chmod(OSCOM::BASE_DIRECTORY . 'Custom/Site/' . $data['site'] . '/Languages/en_US/' . $data['name'] . '.php', 0777);

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
