<?php
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
?>
<!doctype html>
<html>
  <head>
    <title>车辆管理系统</title>
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
    <meta charset="utf-8">
  </head>
  <body>
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
	</div>
	</body>
</html>