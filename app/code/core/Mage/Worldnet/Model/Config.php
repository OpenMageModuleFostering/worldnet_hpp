<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category   Mage
 * @package    Mage_Worldnet
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Worldnet Configuration Model
 *
 * @category   Mage
 * @package    Mage_Worldnet
 * @name       Mage_Worldnet_Model_Config
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Mage_Worldnet_Model_Config extends Varien_Object
{
    const MODE_SIMULATOR    = 'SIMULATOR';
    const MODE_TEST         = 'TEST';
    const MODE_LIVE         = 'LIVE';

    const PAYMENT_TYPE_PAYMENT      = 'PAYMENT';
    const PAYMENT_TYPE_DEFERRED     = 'DEFERRED';
    const PAYMENT_TYPE_AUTHENTICATE = 'AUTHENTICATE';
    const PAYMENT_TYPE_AUTHORISE    = 'AUTHORISE';


    /**
     *  Return config var
     *
     *  @param    string Var key
     *  @param    string Default value for non-existing key
     *  @return	  mixed
     */
    public function getConfigData($key, $default=false)
    {
        if (!$this->hasData($key)) {
             $value = Mage::getStoreConfig('payment/worldnet_standard/'.$key);
             if (is_null($value) || false===$value) {
                 $value = $default;
             }
            $this->setData($key, $value);
        }
        return $this->getData($key);
    }

    /**
     *  Return Protocol version
     *
     *  @return	  string Protocol version
     */
    public function getVersion ()
    {
        return '2.22';
    }

    /**
     *  Return Store description sent to Worldnet
     *
     *  @return	  string Description
     */
    public function getDescription ()
    {
        return $this->getConfigData('description');
    }

    /**
     *  Return Worldnet registered merchant account name
     *
     *  @return	  string Merchant account name
     */
    public function getVendorName ()
    {
        return $this->getConfigData('vendor_name');
    }

    /**
     *  Return Worldnet merchant password
     *
     *  @return	  string Merchant password
     */
    public function getVendorPassword ()
    {
        return $this->getConfigData('vendor_password');
    }

    /**
     *  Return preferred payment type (see SELF::PAYMENT_TYPE_* constants)
     *
     *  @return	  string payment type
     */
    public function getPaymentType ()
    {
        return $this->getConfigData('payment_action');
    }

    /**
     *  Return working mode (see SELF::MODE_* constants)
     *
     *  @return	  string Working mode
     */
    public function getMode ()
    {
        return $this->getConfigData('mode');
    }

    /**
     *  Return new order status
     *
     *  @return	  string New order status
     */
    public function getNewOrderStatus ()
    {
        return $this->getConfigData('order_status');
    }

    /**
     *  Return debug flag
     *
     *  @return	  boolean Debug flag (0/1)
     */
    public function getDebug ()
    {
        return $this->getConfigData('debug_flag');
    }

    /**
     *  Return currency code
     *
     *  @return	  3 digit currency code
     */
    public function getCurrency ()
    {
        return $this->getConfigData('currency');
    }

    /**
     *  Return terminal id
     *
     *  @return	  3 digit currency code
     */
    public function getTerminalid ()
    {
        return $this->getConfigData('terminalid');
    }

    /**
     *  Return shared secret
     *
     *  @return	  shared secret between worldnet & merchant
     */
    public function getSharedsecret ()
    {
        return $this->getConfigData('sharedsecret');
    }

    /**
     *  Return key for simple XOR crypt, using Vendor encrypted password by Worldnet
     *
     *  @return	  string Key for simple XOR crypt
     */
    public function getCryptKey ()
    {
        return $this->getVendorPassword();
    }
}