<?php
/**
 * AgentType.php  08.08.21 20:55
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
class AgentType extends ReceiptParam
{

	/**
	 * 	Банковский платежный агент (БПА)
	 */
	public const AGENT_BPA = 1;

	/**
	 * Банковский платежный субагент (БПСА)
	 */
	public const AGENT_BPSA = 2;

	/**
	 * Платежный агент (ПА)
	 */
	public const AGENT_PA = 3;

	/**
	 * Платежный субагент (ПСА)
	 */
	public const AGENT_PSA = 4;

	/**
	 * Поверенный (П)
	 */
	public const AGENT_P = 5;

	/**
	 * Комиссионер (К)
	 */
	public const AGENT_K = 6;

	/**
	 * Агент (А)
	 */
	public const AGENT_A = 7;

	/**
	 * Формирование секции параметра
	 * @param $value
	 *
	 * @return array
	 *
	 * @since version 1.0
	 */
	public static function getSection($value){
		return self::_getParam('priznakAgentaPoPredmetuRascheta', $value);
	}

	public static function validate ($value){
		return ($value >= self::AGENT_BPA && $value <= self::AGENT_A) || $value == "";
	}

}