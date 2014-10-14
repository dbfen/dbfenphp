dbfenphp - 多备份API PHP SDK
========

## Requirement ##
php 5.0以上版本即可，无额外需求。

## Usage ##

### SDK初始化 ###

``` php
require_once('dbfenphp.php');

$dbfen =  new Dbfenphp('app key', 'app secret');
```

### 用户接口 ###

``` php
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
