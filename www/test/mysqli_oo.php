<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>
    <?php
      $mysqli = new mysqli("localhost", "root", "root", "schoolcarmanager");

      if ($mysqli->connect_errno)
        die("无法建立数据连接: " . $mysqli->connect_error);

      $mysqli->query("SET NAMES utf8");
      $result = $mysqli->query("SELECT * FROM administrator");

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
      $mysqli->close();
    ?> 
  </body>
</html>