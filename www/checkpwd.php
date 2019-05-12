<?php
	require_once("dbtools.inc.php");
	header("Content-type: text/html; charset=utf-8");
		
	//获取表单数据
	$account = $_POST["account"];         
	$password = $_POST["password"];
	$author = $_POST["author"];
	//建立数据连接

	switch($author)
	{
		case "admin":
			$link = create_connection();
			$sql = "SELECT * FROM administrator Where account = '$account' AND password = '$password' AND author = '$author'";
			$result = execute_sql($link, "schoolcarmanager", $sql);
			if (mysqli_num_rows($result) == 0)
			{
				//释放 $result 占用的内存
				mysqli_free_result($result);

				//关闭数据连接        
				mysqli_close($link);
					
				//显示信息要求用户输入正确的账号密码
				echo "<script type='text/javascript'>";
				echo "alert('账号密码错误，请查明后再登录');";
				echo "history.back();";
				echo "</script>";
			}
			//如果账号密码正确
			else
			{
				//获取 id 字段 name 字段
				$admin = mysqli_fetch_object($result);

				//释放 $result 占用的内存    
				mysqli_free_result($result);
					
				//关闭数据连接        
				mysqli_close($link);

				//将用户数据加入 cookies
				setcookie("id", $admin->adminId);
				setcookie("passed", "TRUE");
				setcookie("name", $admin->name);        
				header("location:main.php");                
			}
			break;
		case "user":
			$link = create_connection();
			$sql = "SELECT * FROM carowner Where tel = '$account' AND password = '$password'";
			$result = execute_sql($link, "schoolcarmanager", $sql);
			if (mysqli_num_rows($result) == 0)
			{
				//释放 $result 占用的内存
				mysqli_free_result($result);

				//关闭数据连接        
				mysqli_close($link);
					
				//显示信息要求用户输入正确的账号密码
				echo "<script type='text/javascript'>";
				echo "alert('账号密码错误，请查明后再登录');";
				echo "history.back();";
				echo "</script>";
			}
			//如果账号密码正确
			else
			{
				//获取 id 字段 name 字段
				$admin = mysqli_fetch_object($result);

				//释放 $result 占用的内存    
				mysqli_free_result($result);
					
				//关闭数据连接        
				mysqli_close($link);

				//将用户数据加入 cookies
				setcookie("id", $admin->carId);
				setcookie("passed", "TRUE");
				setcookie("name", $admin->owner);        
				header("location:usermain.php");         
			}
			break;
		case  "punish":
			$link = create_connection();
			$sql = "SELECT * FROM administrator Where account = '$account' AND password = '$password' AND author = '$author'";
			$result = execute_sql($link, "schoolcarmanager", $sql);
			if (mysqli_num_rows($result) == 0)
			{
				//释放 $result 占用的内存
				mysqli_free_result($result);

				//关闭数据连接        
				mysqli_close($link);
					
				//显示信息要求用户输入正确的账号密码
				echo "<script type='text/javascript'>";
				echo "alert('账号密码错误，请查明后再登录');";
				echo "history.back();";
				echo "</script>";
			}
			//如果账号密码正确
			else
			{
				//获取 id 字段 name 字段
				$admin = mysqli_fetch_object($result);

				//释放 $result 占用的内存    
				mysqli_free_result($result);
					
				//关闭数据连接        
				mysqli_close($link);

				//将用户数据加入 cookies
				setcookie("id", $admin->adminId);
				setcookie("passed", "TRUE");
				setcookie("name", $admin->name);        
				header("location:supervisemain.php");                
			}
			break; 
		default:
			echo "<script type='text/javascript'>";
			echo "alert('系统错误');";
			echo "history.back();";
			echo "</script>";
			break;
	}
?>
<html>
    <head>
        <meta name="generator"
            content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
        <title></title>
    </head>
        <body></body>
</html>
