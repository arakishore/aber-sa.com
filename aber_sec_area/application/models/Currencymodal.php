<?php

 

class Currencymodal extends CI_Model{

	private $currencies = array();



	public function __construct() {

		 

		$query = $this->db->query("SELECT * FROM currency where del_status=0");



		foreach ($query->result_array()  as $result) {

			$this->currencies[$result['code']] = array(

				'currency_id'   => $result['currency_id'],

				'title'         => $result['title'],

				'symbol_left'   => $result['symbol_left'],

				'symbol_right'  => $result['symbol_right'],

				'decimal_place' => $result['decimal_place'],

				'default_flag' => $result['default_flag'],

				'country_id' => $result['country_id'],

				'code' => $result['code'],

				'value'         => $result['value']

			);

		}

	}

	public function getDefault() {

		// echo "SELECT * FROM currency where default_flag='1'";

		$query = $this->db->query("SELECT * FROM currency where default_flag='1'  ");



		foreach ($query->result_array()  as $result) {

			return  array(

				'currency_id'   => $result['currency_id'],

				'title'         => $result['title'],

				'symbol_left'   => $result['symbol_left'],

				'symbol_right'  => $result['symbol_right'],

				'decimal_place' => $result['decimal_place'],

				'default_flag' => $result['default_flag'],

				'country_id' => $result['country_id'],

				'code' => $result['code'],

				'value'         => $result['value']

			);

		}

	}

	public function format($number, $currency, $value = '', $format = true) {

		$symbol_left = $this->currencies[$currency]['symbol_left'];

		$symbol_right = $this->currencies[$currency]['symbol_right'];

		$decimal_place = $this->currencies[$currency]['decimal_place'];



		if (!$value) {

			$value = $this->currencies[$currency]['value'];

		}



		$amount = $value ? (float)$number * $value : (float)$number;

		

		$amount = round($amount, (int)$decimal_place);

		

		if (!$format) {

			return $amount;

		}



		$string = '';



		if ($symbol_left) {

			$string .= $symbol_left. " ";

		}



		$string .= number_format($amount, (int)$decimal_place, '.', ',');



		if ($symbol_right) {

			$string .= $symbol_right;

		}



		return $string;

	}

 

	public function convert($value, $from, $to) {

		if (isset($this->currencies[$from])) {

			$from = $this->currencies[$from]['value'];

		} else {

			$from = 1;

		}



		if (isset($this->currencies[$to])) {

			$to = $this->currencies[$to]['value'];

		} else {

			$to = 1;

		}



		return $value * ($to / $from);

	}

	

	public function getId($currency) {

		if (isset($this->currencies[$currency])) {

			return $this->currencies[$currency]['currency_id'];

		} else {

			return 0;

		}

	}



	public function getSymbolLeft($currency) {

		if (isset($this->currencies[$currency])) {

			return $this->currencies[$currency]['symbol_left'];

		} else {

			return '';

		}

	}



	public function getSymbolRight($currency) {

		if (isset($this->currencies[$currency])) {

			return $this->currencies[$currency]['symbol_right'];

		} else {

			return '';

		}

	}



	public function getDecimalPlace($currency) {

		if (isset($this->currencies[$currency])) {

			return $this->currencies[$currency]['decimal_place'];

		} else {

			return 0;

		}

	}



	public function getValue($currency) {

		if (isset($this->currencies[$currency])) {

			return $this->currencies[$currency]['value'];

		} else {

			return 0;

		}

	}



	public function has($currency) {

		return isset($this->currencies[$currency]);

	}

	public function getCurrencyByCode($currency) {

		$currency =	 filter_var($currency, FILTER_SANITIZE_STRING);

		$query = $this->db->query("SELECT DISTINCT * FROM currency WHERE code = '" . $currency . "' ");



		return $query->row_array();

	}

	public function getCurrencies() {

		 



		

			$currency_data = array();



			$query = $this->db->query("SELECT * FROM currency where del_status=0 and status='1'  ORDER BY sort_order ASC");



			foreach ($query->result_array() as $result) {

				$currency_data[$result['code']] = array(

					'currency_id'   => $result['currency_id'],

					'title'         => $result['title'],

					'code'          => $result['code'],

					'symbol_left'   => $result['symbol_left'],

					'symbol_right'  => $result['symbol_right'],

					'decimal_place' => $result['decimal_place'],

					'value'         => $result['value'],

					'status'        => $result['status'],

					'date_modified' => $result['date_modified']

				);

			}



		 

		



		return $currency_data;

	}

}

