<?php
/**
 * CalculationMethod.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\ReceiptParams;

use Pay54ru\Common\ReceiptParam;


/**
 * Признак типа расчета
 *
 * @package     Pay54ru\ReceiptParams
 *
 * @since       version 1.0
 */
class CalculationMethod extends ReceiptParam
{
	/**
	 * Тип расчета отсутствует
	 */
	public const CALCULATION_METHOD_NONE = "";
	/**
	 * Полная предварительная оплата до момента передачи предмета расчета
	 */
	public const CALCULATION_METHOD_FULL_PREPAYMENT = 1;

	/**
	 * Частичная предварительная оплата до момента передачи предмета расчета
	 */
	public const CALCULATION_METHOD_PARTIAL_PREPAYMENT = 2;

	/**
	 * Аванс
	 */
	public const CALCULATION_METHOD_AVANS = 3;

	/**
	 * Полная оплата, в том числе с учетом аванса (предварительной оплаты) в момент передачи предмета расчета
	 */
	public const CALCULATION_METHOD_FULL_PAYMENT = 4;

	/**
	 * Частичная оплата предмета расчета в момент его передачи с последующей оплатой в кредит
	 */
	public const CALCULATION_METHOD_PARTIAL_PAYMENT = 5;

	/**
	 * Передача предмета расчета без его оплаты в момент его передачи с последующей оплатой в кредит
	 */
	public const CALCULATION_METHOD_CREDIT_PAYMENT = 6;

	/**
	 * Оплата предмета расчета после его передачи с оплатой в кредит (оплата кредита).
	 * Может передаваться как единое значение для всего чека, так и для каждой товарной позиции.
	 * При этом значение для товарной позиции будет считаться приоритетным.
	 */
	public const CALCULATION_METHOD_CREDIT_POSTPAYMENT = 7;

	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam("calculationMethod",$value);
	}

	/**
	 * Проверка корректности параметра
	 * @param $value
	 *
	 * @return bool
	 */
	public static function validate($value) {
		if(is_numeric($value) && $value >= self::CALCULATION_METHOD_FULL_PREPAYMENT && $value <= self::CALCULATION_METHOD_CREDIT_POSTPAYMENT)
			return true;
		return false;
	}

}