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

header("Content-type:text/html;charset=utf-8");
require_once("PHPExcel-1.8/Classes/PHPExcel.php");
$name=$_FILES['userfile']['name'];//名字
$suffixName=explode('.', $name)[1];//后缀名
$filePath='upload/'.$_FILES["userfile"]["name"];//文件存储路径
if($suffixName=="xls" || $suffixName=="xlsx"){
    if (is_uploaded_file($_FILES["userfile"]["tmp_name"])) {
        echo "已经上传到临时文件夹";echo "<hr>";
        if (!move_uploaded_file($_FILES["userfile"]["tmp_name"],$filePath)) {
            echo "移动失败";
        }else{
             echo "移动到".$filePath."成功";echo "<hr>";
            //调用解析方法 返回数组
            $ExcleArr=analysisExcel($filePath);
        }
    } else {
        echo "上传临时文件失败";
    }
}
else
{
    echo "<a href='http://localhost/Excel/upload.html'>文件上传格式不正确，请重新上传</a>";
}
function analysisExcel($filePath){
    $file_type=explode('.',$filePath)[1];
    $objReader='';
    //根据上传类型做不同处理
    if ($file_type == 'xls') {
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');//创建读取实例
    }
    if ($file_type == 'xlsx') {
        $objReader = new \PHPExcel_Reader_Excel2007();
    }
    $objPHPExcel = $objReader->load($filePath,$encode='utf-8');//加载文件
    $sheet = $objPHPExcel->getSheet(0);//取得sheet(0)表
    $highestRow = $sheet->getHighestRow(); // 取得总行数
    $highestColumn = $sheet->getHighestColumn(); // 取得总列数
    $data=[];
	foreach($sheet->getRowIterator() as $row)
	{//逐行处理
		if($row->getRowIndex()<2)
		{
			continue;
		}
		foreach($row->getCellIterator() as $cell)
		{//逐列读取
				$data=$cell->getValue();//获取单元格数据
				echo $data." ";
		}
		echo '<br/>';
	}
	echo '<br/>';
}
?>