<?php
/**
 * osCommerce Online Merchant
 * 
 * @copyright Copyright (c) 2012 osCommerce; http://www.oscommerce.com
 * @license BSD License; http://www.oscommerce.com/bsdlicense.txt
 */

  namespace osCommerce\OM\Core\Exception;

  use osCommerce\OM\Core\OSCOM;
  use osCommerce\OM\Core\Registry;

  class MessageStackException extends \Exception {
    public function __construct($message = null, $code = 0, \Exception $previous = null) {
      if ( Registry::exists('MessageStack') ) {
        $OSCOM_MessageStack = Registry::get('MessageStack');

        $OSCOM_MessageStack->add(null, OSCOM::getDef($message), 'error');
      } else {
        trigger_error(OSCOM::getDef($message));
      }

      parent::__construct($message, $code, $previous);
    }
  }
?>
