dbfenphp - 多备份API PHP SDK
========

## Requirement ##
php 5.0以上版本即可，无额外需求。

## Usage ##
关于API的详细说明可以到[多备份官网](http://www.dbfen.com/index.php/help/api) 查看
### 初始化 ###

``` php
	require_once('dbfenphp.php');

	$dbfen =  new Dbfenphp('app key', 'app secret');
```

### 用户接口 ###

1.创建用户
``` php
	$params = array
		(
			'email' => 'demo@site.com',
			'c_user_id' => 'self_define_user_id'
		);

	$response = $dbfen->User->create($params);

	#结果查看，其他接口类似。
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

2.用户信息查看
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id'
		);	

	$response = $dbfen->User->Info($params);
```

### 任务 ###

1.创建网站托管任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'fhost' => 'backup_site.com',
			'fuser' => 'ftp_username',
			'fpass' => 'ftp_password',
			'backup_dir' => '/backup_path'
		);	

	$response = $dbfen->Task->Createsite($params);
``` 

2.创建数据库托管任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'dhost' => 'database_host.com',
			'duser' => 'database_username',
			'dpass' => 'database_password',
			'dname' => 'database_name'
		);	

	$response = $dbfen->Task->Createdb($params);
``` 

3.创建客户端任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'target_host' => 'backup_site.com',
			'backup_dir' => '/backup_path'
		);	

	$response = $dbfen->Task->Createclient($params);
``` 

4.创建客户端数据库任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'target_host' => 'backup_site.com',
			'backup_dir' => '/backup_tmp_path',
			'dname' => 'database_name'
		);	

	$response = $dbfen->Task->Createclientdb($params);	
``` 

5.删除单个任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_id' => task_id,
			'task_type' => task_type
		);	

	$response = $dbfen->Task->Delete($params);		
``` 

6.开始备份任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_id' => task_id,
			'task_type' => task_type
		);	

	$response = $dbfen->Task->Start($params);		
``` 

7.获取任务最新的进度信息
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_id' => task_id,
			'task_type' => task_type
		);	

	$response = $dbfen->Task->Latestprogress($params);	
``` 

8.获取任务备份历史记录
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_id' => task_id,
			'task_type' => task_type
		);	

	$response = $dbfen->Task->History($params);					
```

### 恢复 ###

1.创建恢复任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_type' => task_type,
			'history_id' => history_id
		);	

	$response = $dbfen->Recovery->Create($params);	
``` 

2.获取恢复任务信息
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_type' => task_type,
			're_id' => re_id
		);	

	$response = $dbfen->Recovery->Info($params);
``` 

3.获取恢复任务列表
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_type' => task_type
		);	

	$response = $dbfen->Recovery->Lists($params);		
```

### 迁移 ###

1.创建网站迁移任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'history_id' => history_id,
			'fhost' => 'site.com',
			'fuser' => 'ftp_username',
			'fpass' => 'ftp_password',
			'fpath' => '/path'			
		);	

	$response = $dbfen->Movehouse->Createsite($params);	
``` 

2.创建数据迁移任务
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'history_id' => history_id,
			'dhost' => 'database_host.com',
			'duser' => 'database_username',
			'dpass' => 'database_password',
			'dname' => 'database_name'		
		);	

	$response = $dbfen->Movehouse->Createdb($params);		
``` 

3.获取迁移任务信息
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_type' => task_type,
			'house_id' => house_id
		);	

	$response = $dbfen->Movehouse->Info($params);
``` 

4.获取迁移任务列表
``` php
	$params = array
		(
			'c_user_id' => 'self_define_user_id',
			'task_type' => task_type
		);	

	$response = $dbfen->Movehouse->Lists($params);	
```
