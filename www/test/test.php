<html>
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8">
</head>
<script type="text/javascript">
function doThing() {
var name = document.getElementById("myinput").value;
if (name.length != 0)
{
location.href= "do.php?name=" + name;
}
}
</script>
<body>
<table>
<tr>
<td>name:</td><td><input type="text" name="name" id="myinput" /></td><td><input type="button" value="submit" onclick="doThing();" /></td>
</tr>
</table>
</body>
</html>

