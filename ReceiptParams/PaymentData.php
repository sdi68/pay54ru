<?php
/**
 * PaymentData.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Pay54ru\Common\ReceiptParam;


/**
 * Тип платежного средства
 *
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version
 */
class PaymentData extends ReceiptParam
{
	/**
	 * Наличными
	 */
	public const PAYMENT_DATA_CASHE = 1;

	/**
	 * Электронными
	 */
	public const PAYMENT_DATA_ELECTRON = 2;

	/**
	 * Предоплатой (зачетом аванса)
	 */
	public const PAYMENT_DATA_PREPAYMENT = 3;

	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam("paymentData",$value);
	}
}