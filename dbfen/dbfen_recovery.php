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

class _DbfenRecovery extends _DbfenBase {
	public function Lists($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_type'] = $params['task_type'];	

		if (isset($params['count']))
		{
			$this->params['count'] = $params['count'];
		}

		if (isset($params['page']))
		{
			$this->params['page'] = $params['page'];
		}

		return $this->GetResponse($this->buildUrl('dbf.recovery.list'));
	}		

	public function Create($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['history_id'] = $params['history_id'];
		$this->params['task_type'] = $params['task_type'];		
		return $this->GetResponse($this->buildUrl('dbf.recovery.create'));
	}

	public function Info($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['re_id'] = $params['re_id'];
		$this->params['task_type'] = $params['task_type'];

		return $this->GetResponse($this->buildUrl('dbf.movehouse.createdb'));	
	}
}