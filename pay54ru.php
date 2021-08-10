<?php
/**
 * pay54ru.php  09.08.21 13:15
 * Created for project pay54.ru API
 * www.econsultlab.ru
 * mail: info@econsultlab.ru
 * Released under the GNU General Public License
 * Copyright (c) 2021 Econsult Lab.
 */

namespace Pay54ru;

use Exception;
use Pay54ru\Customer\Customer;
use Pay54ru\Positions\Positions;
use Pay54ru\ReceiptParams\PaymentData;
use Pay54ru\ReceiptParams\Type;
use Pay54ru\ReceiptParams\CalculationMethod;
use Pay54ru\ReceiptParams\UniqueId;

// ERRORS

/**
 * Некорректный CLIENT_ID
 */
define('PAY54_ERROR_CLIENT_ID',"Некорректное значение параметра client_id");

/**
 * Некорректный CLIENT_SECRET
 */
define('PAY54_ERROR_CLIENT_SECRET',"Некорректное значение параметра client_secret");

/**
 * Некорректный ID чека
 */
define('PAY54_ERROR_RECEIPT_ID','Некорректное значение параметра receipt_id');

/**
 * Не установлены параметры сервиса
 */
define('PAY54_ERROR_URL','Не установлены параметры сервиса');


/**
 * Class pay54ru
 * @package Pay54ru
 */
class pay54ru
{
	/**
	 * @var string
	 * @since version 1.0
	 */
	private $_client_id = "";

	/**
	 * @var string
	 * @since version 1.0
	 */
	private	$_client_secret = "";

	/**
	 * @var boolean
	 * @since version
	 */
	private	$_test_mode = false;

	/**
	 * @var string
	 * @since version 1.0
	 */
	private $_url = "";

	/**
	 * pay54ru constructor.
	 * @var string $client_id pay54.ru client ID
	 * @var string $client_secret pay54.ru client secret key
	 * @var boolean $test_mode pay54.ru test mode true
	 */
	public function __construct($client_id,$client_secret,$test_mode = false) {
		if(empty($client_id)) {
			throw new Exception(PAY54_ERROR_CLIENT_ID);
		}
		if(empty($client_secret)) {
			throw new Exception(PAY54_ERROR_CLIENT_SECRET);
		}

		$this->_client_id = $client_id;
		$this->_client_secret = $client_secret;
		$this ->_test_mode = $test_mode;
		$this->_data = "";
	}


	/**
	 * Отправка чека продажи
	 *
	 * @param          $type
	 * @param          $paymentData
	 * @param          $uniqueId
	 * @param Customer $customer
	 * @param array    $positions
	 * @param          $calculationMethod
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function sendReceipt($type, $paymentData,$uniqueId,Customer $customer, array $positions, $calculationMethod) {
		$receipt = array();
		$this->_buildURL();
		try
		{
			$receipt = array_merge($receipt, Type::getSection($type));
			$paymentData = (empty($paymentData)) ? 2: $paymentData;
			$receipt = array_merge($receipt, PaymentData::getSection($paymentData));
			if(!empty($uniqueId))
				$receipt = array_merge($receipt, UniqueId::getSection($uniqueId));
			$receipt = array_merge($receipt, $customer->getSection());
			if($calculationMethod !== "") {
				$receipt = array_merge($receipt, CalculationMethod::getSection($calculationMethod));
			}
			$receipt = array_merge($receipt, Positions::getSection($positions));
		} catch (Exception $e) {
			$out['error'][] = array(
				'error'        => $e->getCode(),
				'errorMessage' => $e->getMessage()
			);
			return $out;
		}
		//var_dump($receipt);
		$out = $this->_request($receipt);
		return $out;
	}

	/**
	 * Получить чек по ID в системе pay54.ru
	 *
	 * @param $receipt_id
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function getReceipt($receipt_id) {
		if(!is_numeric($receipt_id) || $receipt_id <= 0 )
		{
			throw new Exception(PAY54_ERROR_RECEIPT_ID);
		}
		$this->_buildURL(TYPE::TYPE_RETURN, $receipt_id);
		$out = $this->_request(null);
		return $out;
	}

	/**
	 * Формирует URL для запроса
	 *
	 * @param int    $mode  режим генерации URL
	 *
	 * @param string $receipt_id
	 *
	 * @return bool
	 *
	 * @throws Exception
	 * @since version 1.0
	 */
	private function _buildURL($mode = TYPE::TYPE_SALES, $receipt_id = '') {
		$task = 'receipt';
		switch ($mode) {
			case TYPE::TYPE_SALES:
				$receipt_id = "";
				break;
			case TYPE::TYPE_RETURN:
				if(empty($receipt_id)) {
					throw new Exception(PAY54_ERROR_RECEIPT_ID);
				}
				$task = 'getreceipt';
		}
		$out = "https://api.pay54.ru/".$task."?client_id=".$this->_client_id."&client_secret=".$this->_client_secret;

		if(!empty($receipt_id)) {
			$out .=('&receiptid='.$receipt_id);
		}

		if($this->_test_mode) {
			$out .='&test=1';
		}

		$this->_url = $out;
		return false;
	}

	/**
	 * Отправка запроса в pay54.ru
	 * @param $data
	 *
	 * @return mixed
	 *
	 * @throws Exception
	 * @since version 1.0
	 */
	private function _request($data) {
		header('Access-Control-Allow-Origin: *');
		$data_string = json_encode($data);
		print_r($data_string);
		print_r('<br>'.$this->_url);
		if(empty($this->_url)) {
			throw new Exception(PAY54_ERROR_URL);
		}

		$ch  = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $this->_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
				'Content-Type: application/json')
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_POST, 1);
		$result = curl_exec($ch);
		$err    = curl_errno($ch);
		$errmsg = curl_error($ch);
		//$header  = curl_getinfo( $ch );
		curl_close($ch);
		$out['result'] = json_decode($result, true);
		if ($err)
		{
			$out['error'][] = array(
				'error'        => $err,
				'errorMessage' => $errmsg
			);
		}
		if ($out['result']['error'])
		{
			$out['error'][] = array(
				'error'        => $out['result']['error'],
				'errorMessage' => $out['result']['errorMessage']
			);
		}
		unset($out['result']['error']);
		unset($out['result']['errorMessage']);

		return $out;

	}
}