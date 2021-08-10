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

use Pay54ru\Common\ReceiptParam;


/**
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version
 */
class UniqueId extends ReceiptParam
{
	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam("\"uniqueId",$value);
	}
}