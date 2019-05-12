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
  $sql = "delete from carowner where carId = $id";
  $result = execute_sql($link, "schoolcarmanager", $sql);


  //关闭数据连接	
  mysqli_close($link);
  header("location:owner.php");
?>
