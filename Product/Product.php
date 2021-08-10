<?php
/**
 * Product.php  09.08.21 11:45
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Product;


use Pay54ru\Common\ReceiptParam;
use Pay54ru\ReceiptParams\Tax;
use Pay54ru\ReceiptParams\CalculationMethod;
use Exception;

define('PAY54_ERROR_EMPTY_PRODUCT_NAME','Отсутствует наименование товара');
define('PAY54_ERROR_EMPTY_PRODUCT_PRICE','Отсутствует цена товара');
define('PAY54_ERROR_EMPTY_PRODUCT_COUNT','Отсутствует количество товара');
define('PAY54_ERROR_EMPTY_PRODUCT_TAX','Отсутствует тип НДС товара');

class Product extends ReceiptParam
{
	private $_name = "";
	private $_price = 0.00;
	private $_count = 0.000;
	private $_tax = 1;
	private $_productCode = "";
	private $_calculationMethod = 1;
	private $_countryOfOriginCode = "";
	private $_declarationNumber = "";
	private $_exciseTax = 0.00;

	/**
	 * Product constructor.
	 *
	 * @param string $name
	 * @param float $price
	 * @param float $count
	 * @param int    $tax
	 * @param string $productCode
	 * @param int|string    $calculationMethod "" если нет
	 * @param string $countryOfOriginCode
	 * @param string $declarationNumber
	 * @param float|string $exciseTax "" если нет
	 */
	public function __construct(string $name, float $price, float $count, int $tax, string $productCode, $calculationMethod, string $countryOfOriginCode, string $declarationNumber, $exciseTax)
	{
//		if(empty($name)) {
//			throw new Exception (PAY54_ERROR_EMPTY_PRODUCT_NAME);
//		}
//
//		if(!is_numeric($price) || $price <= 0) {
//			throw new Exception (PAY54_ERROR_EMPTY_PRODUCT_PRICE);
//		}
//
//		if(!is_numeric($count) || $count <= 0) {
//			throw new Exception (PAY54_ERROR_EMPTY_PRODUCT_COUNT);
//		}
//
//		if( !Tax::validate($tax)) {
//			throw new Exception (PAY54_ERROR_EMPTY_PRODUCT_TAX);
//		}

		$this->_name                = $name;
		$this->_price               = $price;
		$this->_count               = $count;
		$this->_tax                 = $tax;
		$this->_productCode         = $productCode;
		$this->_calculationMethod   = $calculationMethod;
		$this->_countryOfOriginCode = $countryOfOriginCode;
		$this->_declarationNumber   = $declarationNumber;
		$this->_exciseTax           = $exciseTax;

		$this->_validate();
	}

	public function getSection(){
		$this->_validate();
		$out = $this->_getParam("name",$this->_name);
		$out = array_merge($out, $this->_getParam("price",number_format($this->_price, 2, '.', '')));
		$out = array_merge($out, $this->_getParam("count",number_format($this->_count,3,'.','')));
		$out = array_merge($out, $this->_getParam("tax",$this->_tax));

		if(!empty($this->_productCode))
			$out = array_merge($out, $this->_getParam("productCode",$this->_productCode));

		if(!empty($this->_calculationMethod) || CalculationMethod::validate($this->_calculationMethod))
			$out = array_merge($out, $this->_getParam("calculationMethod",$this->_calculationMethod));

		if(!empty($this->_countryOfOriginCode))
			$out = array_merge($out, $this->_getParam("countryOfOriginCode",$this->_countryOfOriginCode));

		if(!empty($this->_declarationNumber))
			$out = array_merge($out, $this->_getParam("declarationNumber",$this->_declarationNumber));

		if(is_numeric($this->_exciseTax) && $this->_exciseTax > 0)
			$out = array_merge($out, $this->_getParam("exciseTax",number_format($this->_exciseTax,2,'.','')));

		return $out;
	}

	private function _validate (){
		if(empty($this->_name)) {
			throw new Exception(PAY54_ERROR_EMPTY_PRODUCT_NAME);
		}

		if(!is_numeric($this->_price) || $this->_price <= 0) {
			throw new Exception(PAY54_ERROR_EMPTY_PRODUCT_PRICE);
		}

		if(!is_numeric($this->_count) || $this->_count <= 0) {
			throw new Exception(PAY54_ERROR_EMPTY_PRODUCT_COUNT);
		}

		if( !Tax::validate($this->_tax)) {
			throw new Exception(PAY54_ERROR_EMPTY_PRODUCT_TAX);
		}
	}

}