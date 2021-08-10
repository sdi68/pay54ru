<?php
/**
 * Positions.php  09.08.21 11:31
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Positions;

use Pay54ru\Common\ReceiptParam;
use Exception;

/**
 * Ошибка валидации параметра
 */
define("PAY54_ERROR_EMPTY_POSITIONS","Нет товарных позиций чека");

/**
 * Товарные позиции чека
 * Class Positions
 * @package Pay54ru\Positions
 */
class Positions extends ReceiptParam
{


	/**
	 * Формирует секцию товарных позиций чека
	 *
	 * @param array $positions
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public static function getSection(array $positions){
		if(count($positions))
		{
			$out['positions'] = array();
			foreach ($positions as $position)
			{
				$out['positions'][] = $position->getSection();
			}
			return $out;
		} else {
			throw new Exception(PAY54_ERROR_EMPTY_POSITIONS);
		}
	}

}