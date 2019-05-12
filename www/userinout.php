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
  $link = create_connection();
  $sql = "SELECT carowner.carId, carowner.owner, carowner.tel, carowner.carNum, carowner.type, carowner.color, carowner.subDepartment, carowner.remark, inoutinf.time, inoutinf.inOrOut FROM carowner right join inoutinf on carowner.carNum = inoutinf.carNum WHERE owner = '$name'";
  $result = execute_sql($link, "schoolcarmanager", $sql);
?>
<!doctype html>
<html>
  <head>
    <title>车辆管理系统</title>
    <meta charset="utf-8">
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
  <body>
    	<div class = "div0">
		<div style = "position: static">
			<img src="./img/2.jpg" alt="西南交通大学" width="200" height="90" align = "left">
		</div>
		<div>
			<p align="right" style = "font-size: 15px">欢迎登陆系统，<?php echo $name ?>用户。
			</p>
		</div>
		
		<div style =  "float: left;  background-color:#006188;  height: 30px;  width: 960px;  line-height: 30px;  margin-top: 30px;">
			<a class = "a1" href="userinfo.php">个人信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class = "a1" href="userinout.php">进出信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class = "a1" href="userillegal.php">违规信息</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<a class = "a1" href="logout.php">退出系统</a>
		</div>
	
	  <?php
	    echo "<table border='1' align='center'><tr align='center'>";

        while ($field = $result->fetch_field())   // 显示字段名
        echo "<td>" . $field->name . "</td>";
		echo "</tr>";
        while ($row = $result->fetch_row())
		{
          echo "<tr>";
          for ($i = 0; $i < $result->field_count; $i++)
            echo "<td>" . $row[$i] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
        $result->free();
        $link->close();
	  ?>
    </div>
  </body>
</html>