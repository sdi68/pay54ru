<?php
/**
 * Position.php  08.08.21 21:57
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Positions;


use Pay54ru\Common\ReceiptParam;
use Pay54ru\Product\Product;
use Pay54ru\Agent\PaymentAgent;


class Position  extends ReceiptParam
{
	private $_product = null;
	private $_payment_agent = null;

	/**
	 * Position constructor.
	 *
	 * @param Product $_product
	 * @param PaymentAgent $_payment_agent NULL если нет
	 */
	public function __construct(Product $_product, $_payment_agent)
	{
		$this->_product                         = $_product;
		$this->_payment_agent                   = $_payment_agent;
	}

	public function getSection(){
		$out = $this->_product->getSection();
		if(!empty($this->_payment_agent))
			$out = array_merge($out,$this->_payment_agent->getSection());
		return $out;
	}



}