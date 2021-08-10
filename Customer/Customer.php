<?php
/**
 * Customer.php  09.08.21 11:58
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Customer;



use Exception;
use Pay54ru\Common\ReceiptParam;

/**
 *
 */
define('PAY54_ERROR_EMPTY_CUSTOMER_CONTACTS',"Не указаны контактов  покупателя");

/**
 * @package     pay54ru\Customer
 *
 * @since       version
 */
class Customer extends ReceiptParam
{
	/**
	 * телефон покупателя
	 * @var string
	 * @since version 1.0
	 */
	private $_customerPhone = "";
	/**
	 * email покупателя
	 * @var string
	 * @since version 1.0
	 */
	private $_customerEmail = "";
	/**
	 * INN покупателя
	 * @var string
	 * @since version 1.0
	 */
	private $_INNPokupatelja ="";
	/**
	 * Наименование организации или ФИО Покупателя
	 * @var string
	 * @since version 1.0
	 */
	private $_Pokupatel = "";


	/**
	 * Customer constructor.
	 *
	 * @param string $customerPhone телефон покупателя
	 * @param string $customerEmail email покупателя
	 * @param string $INNPokupatelja INN покупателя
	 * @param string $Pokupatel Наименование организации или ФИО Покупателя
	 */
	public function __construct(string $customerPhone, string $customerEmail, string $INNPokupatelja, string $Pokupatel)
	{
		$this->_customerPhone  = $customerPhone;
		$this->_customerEmail  = $customerEmail;
		$this->_INNPokupatelja = $INNPokupatelja;
		$this->_Pokupatel      = $Pokupatel;
		$this->_validate();
	}

	/**
	 * Формирует секцию покупателя для чека
	 * @return array параметры покупателя для чека
	 *
	 * @since version 1.0
	 */
	public function getSection(){
		$this->_validate();
		$out = (empty($this->_customerPhone)) ? array() : $this->_getParam("customerPhone",$this->_customerPhone);
		if(!empty($this->_customerEmail))
			$out = array_merge($out,$this->_getParam("customerEmail",$this->_customerEmail));
		if(!empty($this->_INNPokupatelja))
			$out = array_merge($out,$this->_getParam("INNPokupatelja",$this->_INNPokupatelja));
		if(!empty($this->_Pokupatel))
			$out = array_merge($out,$this->_getParam( "Pokupatel",$this->_Pokupatel));
		return $out;
	}

	private function _validate() {
		if(empty($this->_customerPhone) && empty($this->_customerEmail) ) {
			throw new Exception(PAY54_ERROR_EMPTY_CUSTOMER_CONTACTS);
		}
	}

}