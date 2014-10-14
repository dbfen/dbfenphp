dbfenphp
========

## Usage ##

### 用户接口 ###
``` php
	#SDK 引用
	require_once('dbfenphp.php');

	$dbfen =  new Dbfenphp('app key', 'app secret');

	#用户创建
	$params = array
		(
			'email' => 'demo@site.com',
			'c_user_id' => 'self_define_user_id'
		);

	$response = $dbfen->User->create($params);

	#用户信息查看
	$params = array
		(
			'c_user_id' => 'self_define_user_id'
		);	

	$response = $dbfen->User->Info($params);

	#查看返回结果
	if (0 == $response['code'])
	{
		$data = $response['data'];
		var_dump($data);
		die;
	}
	else
	{
		echo $response['msg'], "\n";
		die;
	}
```
