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

class _DbfenBase {

	private $apiUrl = 'http://www.dbfen.com/api';

	protected $default_params = array();
	protected $params = array();	

	public function __construct($appKey, $appSecret)
	{
		$this->http = new _DbfenHttp($appKey, $appSecret);
	}

    protected function GetResponse($url)
    {
        $this->default_params['timestamp'] = time();
        return $this->http->GetResponse($url, array_merge($this->default_params, $this->params));
    }

    protected function BuildUrl($method)
    {
        $this->default_params['method'] = $method;
        $this->default_params['c_user_id'] = 12036;
        return $this->apiUrl . '?method=' . $method;
    } 	
}