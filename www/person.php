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
  $id = $_GET["id"];
  $link = create_connection();
  $sql1 = "select a.carId,a.owner,a.tel,a.carNum,a.type,a.color,a.subDepartment,b.time,b.inOrOut from carowner a right join inoutinf b on a.carNum= b.carNum where a.carNum = '".$id."';";
  $sql2 = "select a.carId,a.owner,a.tel,a.carNum,a.type,a.color,a.subDepartment,c.illegalContent,c.illegalTime from carowner a right join illegal c on a.carNum = c.carNum where a.carNum = '".$id."';";
  $result1 = execute_sql($link, "schoolcarmanager", $sql1);
  $result2 = execute_sql($link, "schoolcarmanager", $sql2);
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
	
		<?php
			echo "&nbsp<div ><p align = 'center'>进出日志</p> </div>";
			echo "<table border='1' align='center'><tr align='center'>";

			while ($field = $result1->fetch_field())   // 显示字段名
			echo "<td>" . $field->name . "</td>";

			while ($row = $result1->fetch_row())
			{
				echo "<tr>";
				for ($i = 0; $i < $result1->field_count; $i++)
				echo "<td>" . $row[$i] . "</td>";
			}
			echo "</table>";
			$result1->free();
			echo "<p align = 'center'>违规信息</p> ";
			echo "<table border='1' align='center'><tr align='center'>";

			while ($field = $result2->fetch_field())   // 显示字段名
			echo "<td>" . $field->name . "</td>";

			while ($row = $result2->fetch_row())
			{
				echo "<tr>";
				for ($i = 0; $i < $result2->field_count; $i++)
				echo "<td>" . $row[$i] . "</td>";
			}
			echo "</table>";
			$result2->free();
			$link->close();
		?>
	</div>
  </body>
</html>