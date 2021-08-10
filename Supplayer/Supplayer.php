<?php
/**
 * Supplayer.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Supplayer;

use Pay54ru\Common\ReceiptParam;
use Exception;

/**
 * Ошибка валидации параметра
 */
define('PAY54_ERROR_SUPPLAYER_EMPTY_PHONE','Отсутствует телефон поставщика');
/**
 * Ошибка валидации параметра
 */
define('PAY54_ERROR_SUPPLAYER_EMPTY_NAME','Отсутствует наименование поставщика');

/**
 * Поставщик
 * Class Supplayer
 * @package Pay54ru\Supplayer
 */
class Supplayer  extends ReceiptParam
{
	/**
	 * Телефон
	 * @var string
	 */
	private $_telefonPostavshhika = "";
	/**
	 * Наименование
	 * @var string
	 */
	private $_naimenovaniePostavshhika = "";
	/**
	 * ИНН
	 * @var string
	 */
	private $_INNPostavshhika = "";

	/**
	 * Supplayer constructor.
	 *
	 * @param string $_telefonPostavshhika
	 * @param string $_naimenovaniePostavshhika
	 * @param string $_INNPostavshhika
	 */
	public function __construct(string $telefonPostavshhika, string $naimenovaniePostavshhika, string $INNPostavshhika)
	{
		$this->_telefonPostavshhika        = $telefonPostavshhika;
		$this->_naimenovaniePostavshhika   = $naimenovaniePostavshhika;
		$this->_INNPostavshhika            = $INNPostavshhika;
		$this->_validate();
	}


	/**
	 * Формирование секции поставщика для чека
	 * @return array
	 * @throws Exception
	 */
	public function getSection(){
		$this->_validate();
		$out = self::_getParam("telefonPostavshhika",$this->_telefonPostavshhika);
		$out = array_merge($out,self::_getParam("naimenovaniePostavshhika",$this->_naimenovaniePostavshhika));
		$out = array_merge($out,self::_getParam("INNPostavshhika",$this->_INNPostavshhika));
		return $out;
	}

	/**
	 * Проверка корректности параметров
	 * @throws Exception
	 */
	private function _validate() {
		if(empty($this->_telefonPostavshhika))
			throw new Exception(PAY54_ERROR_SUPPLAYER_EMPTY_PHONE);
		if(empty($this->_naimenovaniePostavshhika))
			throw new Exception(PAY54_ERROR_SUPPLAYER_EMPTY_NAME);

	}
}