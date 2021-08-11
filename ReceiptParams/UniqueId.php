<?php
/**
 * UniqueId.php  09.08.21 11:26
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Exception;
use Pay54ru\Common\ReceiptParam;

define('PAY54_ERROR_EMPTY_UNIQUE_ID','Некорректное значение идентификатора чека');

/**
 * ID чека в системе
 *
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version
 */
class UniqueId extends ReceiptParam
{
	/**
	 * Формирование секции параметра
	 *
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		self::_validate($value);
		return self::_getParam("uniqueId",$value);
	}

	private static function _validate($value){
		if(empty($value)) {
			throw new Exception(PAY54_ERROR_EMPTY_UNIQUE_ID);
		}
	}
}