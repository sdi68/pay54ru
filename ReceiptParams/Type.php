<?php
/**
 * Type.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Pay54ru\Common\ReceiptParam;


/**
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version 1.0
 */
class Type extends ReceiptParam
{
	/**
	* чек прихода
	 */
	public const TYPE_SALES = 1;

	/**
	 * чек возврата
	 */
	public const TYPE_RETURN = 2;

	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam("type", $value);
	}
}