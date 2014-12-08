<?php
/**
 * 
 * The GNU General Public License (GPL-2.0)
 * Copyright © 2014 dbfen.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author robinsun <robinsun@dbfen.com>
 * @version 1.0
 */

class _DbfenHttp {
	public function __construct($appKey, $appSecret)
	{
		$this->appKey = $appKey;
		$this->appSecret = $appSecret;
		$this->useCurl = self::HasCurl() ? true : false;		
	}

	public function GetResponse($url, $params=null, $method='POST')
	{		
		$response = array();
		$json = array();

		if ($this->useCurl) 
		{
			$http = _DbfenWebRequest::Instance($this->appKey, $this->appSecret);
			$res = $http->Create($url, $method, $params);

			if (null == $res) 
			{
				return array('code' => -1, 'msg' => 'HTTP请求失败');
			}

			$response['content'] = $res->Content;
	
			if (200 != $res->Info['http_code']) 
			{
				$json =  array('code' => -1, 'msg' => 'HTTP CODE: ' . $res->Info['http_code']);
			}
			else
			{
				$json = json_decode($res->Content, true);
			}			
		}
		else 
		{
			$res = $this->CreateWithoutCurl($url, $params);

			if (empty($res))
			{
				return array('code' => -1, 'msg' => 'HTTP EROOR');
			}

			$response['content'] = $res;
			$json = json_decode($res, true);
		}

		if ($json)
		{
			$response["code"] = $json["code"];
			$response["msg"] = $json["msg"];
			$response["data"] = $json["data"];
		}

		return $response;
	}   

	public function CreateWithoutCurl($url, $params = array(), $method = 'POST')
	{
		$query = '';

		ksort($params);
		
		foreach ($params as $k => $v)
			$query .= $k . $v;

		$query .= $this->appSecret;
		$params['sign']   = md5($query);
		$params['appkey'] = $this->appKey;

		switch (strtolower($method))
		{
			case 'post':
				$context = array(
					'http' => array(
						'method' => 'POST',
						'header' => "Content-type: application/x-www-form-urlencoded ",
						'content' => http_build_query($params)
					)
				);		

				$context = stream_context_create($context);
				return file_get_contents($url, false, $context);							
				break;
			default:
				return null;
		}			
	}		

	private static function HasCurl()
	{
		return function_exists('curl_init');
	}			 
}

class _DbfenWebRequest
{
	private $mh = null;
	private $_requests;
	private $_responses;
	static $_instance = null;

	private final function __construct($appKey, $appSecret)
	{
		$this->mh = curl_multi_init();	
		$this->appKey = $appKey;					
		$this->appSecret = $appSecret;
		$this->_requests = array();
		$this->_responses = array();
	}

	public static function Instance($appKey, $appSecret)
	{
		if (null == self::$_instance)
		{
			self::$_instance = new self($appKey, $appSecret);
		}

		return self::$_instance;
	}		

	public function Post($url, $params = array())
	{
		return $this->Create($url, "POST", $params);
	}

	public function Create($url, $method = 'POST', $params = array())
	{
		$ch = curl_init();
		$key= (string)$ch;
		$query = '';
		$res = null;

		ksort($params);
		
		foreach ($params as $k => $v)
		{
			$query .=  $k . $v;
		}

		$query .= $this->appSecret;
		$params['sign']   = md5($query);
		$params['appkey'] = $this->appKey;

		switch (strtolower($method))
		{
			case 'post':
				$options[CURLOPT_POST] = true;
				$options[CURLOPT_POSTFIELDS] = http_build_query($params);
				$options[CURLOPT_HEADER] = 0;
				$options[CURLOPT_RETURNTRANSFER] = 1;
				break;
			default:
				return null;
		}
		
		$options[CURLOPT_URL] = $url;
		curl_setopt_array($ch, $options);
		
		$this->_requests[$key] = $ch;
		
		$res = curl_multi_add_handle($this->mh, $this->_requests[$key]);
		if ($res == CURLM_OK) {
			curl_multi_exec($this->mh, $active);
			return new _DbfenWebRequestManager($key, $this->appKey, $this->appSecret);
		}
		
		return null;
	}

	public function GetResponse($key = null)
	{
		if (isset($this->_responses[$key]))
			return $this->_responses[$key];
		
		$running = null;
		
		do {
			$res = curl_multi_exec($this->mh, $current);
			if (null !== $running && $current != $running) {
				$this->store();	
				
				if (isset($this->_responses[$key]))
					return $this->_responses[$key];
				
			}
			$running = $current;
		} while ($current > 0);
		
		return false;
	}

	private function store()
	{
		while ($finished = curl_multi_info_read($this->mh, $messages)) {
			$key = (string)$finished["handle"];
			$this->_responses[$key] = new _DbfenWebResponse(curl_multi_getcontent($finished["handle"]), curl_getinfo($finished["handle"]));
			curl_multi_remove_handle($this->mh, $finished["handle"]);
		}
	}				
}

class _DbfenWebRequestManager
{
	private $key;
	private $request;
	
	public function __construct($key, $appkey, $appSecret)
	{
		$this->key = $key;
		$this->request = _DbfenWebRequest::Instance($appkey, $appSecret);
	}
	
	public function __get($name)
	{
		$response = $this->request->GetResponse($this->key);
		return $response->{$name};
	}
}

class _DbfenWebResponse
{
	public $Content;
	public $Info;
	
	public function __construct($content = null, $info = null)
	{
		$this->Content = $content;
		$this->Info = $info;
	}
}