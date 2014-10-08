dbfenphp
========

## Usage ##

本接口支持在所有php的空间和虚拟主机运行，不需要额外设置。

``` php
<?php
	#用户接口
	require_once('dbfenphp.php');

	$dbfen =  new Dbfenphp('app key', 'app secret');

	$params = array
		(
			'email' => 'demo@site.com',
			'c_user_id' => 'self_define_user_id'
		);

	$response = $dbfen->User->create($params);
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

	$params = array
		(
			'c_user_id' => 'self_define_user_id'
		);	

	$response = $dbfen->User->Info($params);
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

?>
```
