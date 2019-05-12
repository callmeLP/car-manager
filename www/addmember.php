<?php
  require_once("dbtools.inc.php");
    
  //检查 cookie 中的 passed 变量是否等于 TRUE
  $passed = $_COOKIE["passed"];
  $name = $_COOKIE["name"];
  /*  如果 cookie 中的 passed 变量不等于 TRUE
      表示尚未登录网站，将用户导向首页 index.html	*/
  if ($passed != "TRUE")
  {
    header("location:index.html");
    exit();
  }
  //获取表单数据 
  $name = $_POST["name"]; 
  $cellphone = $_POST["cellphone"]; 	
  $psd = $_POST["psd"];
  $carNum = $_POST["carNum"];
  $carType = $_POST["carType"]; 
  $carColor = $_POST["carColor"]; 	
  $comment = $_POST["comment"]; 	
  $department = $_POST["department"];
  
  //建立数据连接
  $link = create_connection();
			
  //检查账号是否有人申请
  $sql = "SELECT * FROM carowner Where carNum = '$carNum'";
  $result = execute_sql($link, "schoolcarmanager", $sql);

  //如果账号已经有人使用
  if (mysqli_num_rows($result) != 0)
  {
    //释放 $result 占用的内存
    mysqli_free_result($result);
		
    //显示信息要求用户更换账号名称
    echo "<script type='text/javascript'>";
    echo "alert('您所指定的车牌号已经有人使用！');";
    echo "history.back();";
    echo "</script>";
  }
	
  //如果账号没人使用
  else
  {
    //释放 $result 占用的内存	
    mysqli_free_result($result);
		
    //执行 SQL 命令，新增此账号
    $sql = "INSERT INTO carowner (owner, tel, password, 
            carNum, type, color, subDepartment, remark) VALUES (
            '$name', '$cellphone', '$psd', '$carNum', '$carType', '$carColor', '$department', '$comment')";

    $result = execute_sql($link, "schoolcarmanager", $sql);
  }
	
  //关闭数据连接	
  mysqli_close($link);
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>新增账号成功</title>
	<style>
		.div0
		{
			width: 960px;
			margin: auto;
			padding-top: 1px;
		}
		.a1
		{
			color: #FFF;
			font-size: 12px;
			text-decoration: none;
			float: left;
			padding-left: 160px;	
		}
	</style>
	</head>
	<body bgcolor="#FFFFFF">
		<div class = "div0">
			<div style = "position: static">
				<img src="./img/2.jpg" alt="西南交通大学" width="200" height="90" align = "left">
			</div>
			<div>
				<p align="right" style = "font-size: 15px">欢迎登陆系统，<?php echo $name ?>管理员。
				</p>
			</div>

			<div style =  "float: left;  background-color:#006188;  height: 30px;  width: 960px;  line-height: 30px;  margin-top: 30px;">
				<a class = "a1" href="owner.php">车主列表</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class = "a1" href="inout.php">进出信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class = "a1" href="illegal.php">违规信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class = "a1" href="logout.php">退出系统</a>
			</div>
			
			<p align="center">恭喜您已经注册成功了<br>   
				<font color="#FF0000"><?php echo $name ?></font><br>
				<font color="#FF0000"><?php echo $cellphone ?></font><br> 
				<font color="#FF0000"><?php echo $carNum ?></font><br>
				<font color="#FF0000"><?php echo $carType ?></font><br> 
				<font color="#FF0000"><?php echo $carColor ?></font><br>
				<font color="#FF0000"><?php echo $department ?></font><br> 
				<font color="#FF0000"><?php echo $comment ?></font><br> 
				<a href="main.php">返回主页</a>。
			</p>
		</div>
	</body>
</html>