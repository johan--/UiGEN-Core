<?php
	
	class RemoteAPI {
		protected $api_key;
		protected $api_url;

		protected $response;
		protected $curl_options;
		protected $curl_info;

		function __construct($api_url) {
			$this->response = false;
			$this->api_url = $api_url;
			$this->curl_error = false;
			$this->curl_options = array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false,
				CURLOPT_VERBOSE => false,
				// CURLOPT_PROXY => '127.0.0.1:10101',
			);
		}

		protected function custom_headers($headers) {
			if (!is_array($headers)) {
				$headers = implode('\r\n ', $headers);
			}
			$this->curl_options[CURLOPT_HTTPHEADER] = $headers;
		}

		protected function request($method, $path, $data = false, $upload = false) {
			$curl = curl_init();
			switch($method) {
				case 'POST':
				case 'PUT':
				case 'DELETE':
				case 'OPTIONS':
				case 'HEAD':
				case 'TRACE':
				case 'CONNECT':
					$this->curl_options[CURLOPT_CUSTOMREQUEST] = $method;
					break;
				case 'GET':
				default:
					// Nothing
			}

			// $this->curl_options[CURLOPT_HEADER] = 1;
			if ($data) {
				$this->curl_options[CURLOPT_POST] = true;
				if(is_array($data)) {
					$this->curl_options[CURLOPT_POSTFIELDS] = json_encode($data);
				} else {
					$this->curl_options[CURLOPT_POSTFIELDS] = $data;
				}
			}
			$this->curl_options[CURLOPT_URL] = $this->api_url.$path;
			@curl_setopt_array($curl, $this->curl_options);
			$status = true;
			if(!$this->response = curl_exec($curl)) {
				$status = false;
			}
			$this->curl_info= curl_getinfo($curl);
			// var_dump($this->curl_options);
			// var_dump($this->curl_info);
			curl_close($curl);
			// var_dump($this->response);
			if ($status)
				return true;
			else
				return false;
		}

		public function get_json() {
			// var_dump($this->response);
			print($this->response);
		}

		public function get_raw_data() {
			return $this->response;
		}
	}