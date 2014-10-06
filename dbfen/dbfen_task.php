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

class _DbfenTasK extends _DbfenBase {
	public function Createsite($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['fhost'] = $params['fhost'];	
		$this->params['fuser'] = $params['fuser'];	
		$this->params['fpass'] = $params['fpass'];	
		$this->params['backup_dir'] = $params['backup_dir'];		

		if (isset($params['ftype']))
		{
			$this->params['ftype'] = $params['ftype'];
		}

		if (isset($params['fport']))
		{
			$this->params['fport'] = $params['fport'];
		}

		if (isset($params['fdomain']))
		{
			$this->params['fdomain'] = $params['fdomain'];
		}	

		if (isset($params['taskname']))
		{
			$this->params['taskname'] = $params['taskname'];
		}				

		if (isset($params['freqence']))
		{
			$this->params['freqence'] = $params['freqence'];
		}

		if (isset($params['monthday']))
		{
			$this->params['monthday'] = $params['monthday'];
		}

		if (isset($params['weekday']))
		{
			$this->params['weekday'] = $params['weekday'];
		}

		if (isset($params['start_time']))
		{
			$this->params['start_time'] = $params['start_time'];
		}								

		return $this->GetResponse($this->buildUrl('dbf.task.createsite'));
	}

	public function Createdb($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['dhost'] = $params['dhost'];	
		$this->params['duser'] = $params['duser'];	
		$this->params['dpass'] = $params['dpass'];	
		$this->params['dname'] = $params['dname'];		

		if (isset($params['dtype']))
		{
			$this->params['dtype'] = $params['dtype'];
		}

		if (isset($params['dport']))
		{
			$this->params['dport'] = $params['dport'];
		}

		if (isset($params['ddomain']))
		{
			$this->params['ddomain'] = $params['ddomain'];
		}		

		if (isset($params['taskname']))
		{
			$this->params['taskname'] = $params['taskname'];
		}

		if (isset($params['freqence']))
		{
			$this->params['freqence'] = $params['freqence'];
		}

		if (isset($params['monthday']))
		{
			$this->params['monthday'] = $params['monthday'];
		}

		if (isset($params['weekday']))
		{
			$this->params['weekday'] = $params['weekday'];
		}

		if (isset($params['start_time']))
		{
			$this->params['start_time'] = $params['start_time'];
		}								

		return $this->GetResponse($this->buildUrl('dbf.task.createdb'));
	}

	public function Createclient($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['target_host'] = $params['target_host'];	
		$this->params['backup_dir'] = $params['backup_dir'];		

		if (isset($params['taskname']))
		{
			$this->params['taskname'] = $params['taskname'];
		}

		return $this->GetResponse($this->buildUrl('dbf.task.createclient'));
	}

	public function Createclientdb($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['target_host'] = $params['target_host'];	
		$this->params['dname'] = $params['dname'];	
		$this->params['backup_dir'] = $params['backup_dir'];		

		if (isset($params['dtype']))
		{
			$this->params['dtype'] = $params['dtype'];
		}

		if (isset($params['taskname']))
		{
			$this->params['taskname'] = $params['taskname'];
		}

		if (isset($params['freqence']))
		{
			$this->params['freqence'] = $params['freqence'];
		}

		if (isset($params['monthday']))
		{
			$this->params['monthday'] = $params['monthday'];
		}

		if (isset($params['weekday']))
		{
			$this->params['weekday'] = $params['weekday'];
		}

		if (isset($params['start_time']))
		{
			$this->params['start_time'] = $params['start_time'];
		}								

		return $this->GetResponse($this->buildUrl('dbf.task.createclientdb'));
	}

	public function Delete($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_id'] = $params['task_id'];	
		$this->params['task_type'] = $params['task_type'];

		return $this->GetResponse($this->buildUrl('dbf.task.delete'));
	}

	public function Start($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_id'] = $params['task_id'];	
		$this->params['task_type'] = $params['task_type'];

		return $this->GetResponse($this->buildUrl('dbf.task.start'));
	}

	public function Latestprogress($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_id'] = $params['task_id'];	
		$this->params['task_type'] = $params['task_type'];

		return $this->GetResponse($this->buildUrl('dbf.task.latestprogress'));
	}

	public function History($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_id'] = $params['task_id'];	
		$this->params['task_type'] = $params['task_type'];		

		if (isset($params['count']))
		{
			$this->params['count'] = $params['count'];
		}

		if (isset($params['page']))
		{
			$this->params['page'] = $params['page'];
		}

		return $this->GetResponse($this->buildUrl('dbf.task.history'));
	}
	
	public function Info($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		$this->params['task_id'] = $params['task_id'];
		$this->params['task_type'] = $params['task_type'];

		return $this->GetResponse($this->buildUrl('dbf.task.info'));
	}	

	public function lists($params)
	{
		$this->params['c_user_id'] = $params['c_user_id'];
		return $this->GetResponse($this->buildUrl('dbf.task.list'));
	}		
}