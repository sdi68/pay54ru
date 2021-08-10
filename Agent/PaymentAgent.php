<?php
/**
 * PaymentAgent.php  08.08.21 20:55
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru\Agent;


use Pay54ru\Common\ReceiptParam;
use Pay54ru\ReceiptParams\AgentType;
use Pay54ru\Supplayer\Supplayer;
use Exception;


/**
 * Ошибка валидации значения
 */
define('PAY54_ERROR_WRONG_AGENT_TYPE','Некорректное значение признака агента по предмету расчета');
/**
 * Ошибка валидации значения
 */
define('PAY54_ERROR_WRONG_PAYMENT_AGENT','Некорректное значение платежного агента');

/**
 * Class PaymentAgent
 * @package Pay54ru\Agent
 */
class PaymentAgent  extends ReceiptParam
{
	/**
	 * @var int|AgentType
	 */
	private $_priznakAgentaPoPredmetuRascheta = 1;
	/**
	 * @var string
	 */
	private $_telefonOperatoraPerevoda = "";
	/**
	 * @var string
	 */
	private $_operacijaPlatezhnogoAgenta = "";
	/**
	 * @var string
	 */
	private $_telefonPlatezhnogoAgenta = "";
	/**
	 * @var string
	 */
	private $_telefonOperatoraPoPriemuPlatezhej = "";
	/**
	 * @var string
	 */
	private $_naimenovanieOperatoraPerevoda = "";
	/**
	 * @var string
	 */
	private $_adresOperatoraPerevoda = "";
	/**
	 * @var string
	 */
	private $_INNOperatoraPerevoda = "";
	/**
	 * @var Supplayer|null
	 */
	private $_supplayer = null;

	/**
	 * PaymentAgent constructor.
	 *
	 * @param AgentType|int    $priznakAgentaPoPredmetuRascheta
	 * @param string $telefonOperatoraPerevoda
	 * @param string $operacijaPlatezhnogoAgenta
	 * @param string $telefonPlatezhnogoAgenta
	 * @param string $telefonOperatoraPoPriemuPlatezhej
	 * @param string $naimenovanieOperatoraPerevoda
	 * @param string $adresOperatoraPerevoda
	 * @param string $INNOperatoraPerevoda
	 * @param Supplayer $supplayer
	 */
	public function __construct(int $priznakAgentaPoPredmetuRascheta, string $telefonOperatoraPerevoda, string $operacijaPlatezhnogoAgenta, string $telefonPlatezhnogoAgenta, string $telefonOperatoraPoPriemuPlatezhej, string $naimenovanieOperatoraPerevoda, string $adresOperatoraPerevoda, string $INNOperatoraPerevoda, Supplayer $supplayer)
	{
		$this->_priznakAgentaPoPredmetuRascheta   = $priznakAgentaPoPredmetuRascheta;
		$this->_telefonOperatoraPerevoda          = $telefonOperatoraPerevoda;
		$this->_operacijaPlatezhnogoAgenta        = $operacijaPlatezhnogoAgenta;
		$this->_telefonPlatezhnogoAgenta          = $telefonPlatezhnogoAgenta;
		$this->_telefonOperatoraPoPriemuPlatezhej = $telefonOperatoraPoPriemuPlatezhej;
		$this->_naimenovanieOperatoraPerevoda     = $naimenovanieOperatoraPerevoda;
		$this->_adresOperatoraPerevoda            = $adresOperatoraPerevoda;
		$this->_INNOperatoraPerevoda              = $INNOperatoraPerevoda;
		$this->_supplayer                         = $supplayer;
		$this->_validate();
	}


	/**
	 * Формирует секцию параметра в чеке
	 * @return array
	 * @throws Exception
	 */
	public function getSection(){
		$this->_validate();
		$out = array();
		if(!empty($this->_priznakAgentaPoPredmetuRascheta)) {
			$out = array_merge($out,AgentType::getSection($this->_priznakAgentaPoPredmetuRascheta));
			if(!empty($this->_telefonOperatoraPerevoda)) {
				$out['telefonOperatoraPerevoda'] = $this->_telefonOperatoraPerevoda;
			}
			if(!empty($this->_operacijaPlatezhnogoAgenta)) {
				$out['operacijaPlatezhnogoAgenta'] = $this->_operacijaPlatezhnogoAgenta;
			}
			if(!empty($this->_telefonPlatezhnogoAgenta)) {
				$out['telefonPlatezhnogoAgenta'] = $this->_telefonPlatezhnogoAgenta;
			}
			if(!empty($this->_telefonOperatoraPoPriemuPlatezhej)) {
				$out['telefonOperatoraPoPriemuPlatezhej'] = $this->_telefonOperatoraPoPriemuPlatezhej;
			}
			if(!empty($this->_naimenovanieOperatoraPerevoda)) {
				$out['naimenovanieOperatoraPerevoda'] = $this->_naimenovanieOperatoraPerevoda;
			}
			if(!empty($this->_adresOperatoraPerevoda)) {
				$out['adresOperatoraPerevoda'] = $this->_adresOperatoraPerevoda;
			}
			if(!empty($this->_INNOperatoraPerevoda)) {
				$out['INNOperatoraPerevoda'] = $this->_INNOperatoraPerevoda;
			}

			$out = array_merge($out,$this->_supplayer->getSection());
		}

		return $out;
	}

	/**
	 * Проверка корректности значений
	 * @throws Exception
	 */
	private function _validate(){
		if(AgentType::validate($this->_priznakAgentaPoPredmetuRascheta))
		{
			switch ($this->_priznakAgentaPoPredmetuRascheta)
			{
				case 1:
				case 2:
					if(empty($this->_telefonOperatoraPerevoda)
						|| empty($this->_operacijaPlatezhnogoAgenta)
						|| empty($this->_naimenovanieOperatoraPerevoda)
						|| empty($this->_INNOperatoraPerevoda)) {

						throw new Exception(PAY54_ERROR_WRONG_PAYMENT_AGENT);
					}
					break;
				case 3:
				case 4:
				if(empty($this->_telefonPlatezhnogoAgenta)
					|| empty($this->_telefonOperatoraPoPriemuPlatezhej)
					|| empty($this->_INNOperatoraPerevoda)) {

					throw new Exception(PAY54_ERROR_WRONG_PAYMENT_AGENT);
				}
				break;
				case "":
				default:
					break;
			}
		} else
		{
			throw new Exception(PAY54_ERROR_WRONG_AGENT_TYPE);
		}
	}

}


