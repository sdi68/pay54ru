<?php
/**
 * Tax.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Pay54ru\Common\ReceiptParam;


/**
 * @package     pay54ru\ReceiptParams
 *
 * @since       version
 */
class Tax extends ReceiptParam
{
	/**
	 * 	без НДС
	 */
	public const TAX_VAT_NONE = 1;

	/**
	 * 	НДС по ставке 0%;
	 */
	public const TAX_VAT_0 = 2;

	/**
	 * 	НДС чека по ставке 10%;
	 */
	public const TAX_VAT_10 = 3;

	/**
	 * 	НДС чека по ставке 20%;
	 */
	public const TAX_VAT_CALCULATED = 4;

	/**
	 * 	НДС чека по расчетной ставке 10/110;
	 */
	public const TAX_VAT_10_110 = 5;

	/**
	 * 	НДС чека по расчетной ставке 20/120.
	 */
	public const TAX_VAT_20_120 = 6;

	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam("tax", $value);
	}

	public static function validate($value) {
		if(is_numeric($value) && $value >= self::TAX_VAT_NONE && $value <= self::TAX_VAT_20_120)
			return true;
		return false;
	}
}