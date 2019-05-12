<?php
	//判断上传的文件是否出错,是的话，返回错误
	require_once("dbtools.inc.php");
	if($_FILES["file"]["error"])
	{
		echo $_FILES["file"]["error"];    
	}
	else
	{
		//没有出错
		//加限制条件
		//判断上传文件类型为png或jpg且大小不超过1024000B
		if(($_FILES["file"]["type"]=="image/png"||$_FILES["file"]["type"]=="image/jpeg")&&$_FILES["file"]["size"]<1024000)
		{
			//防止文件名重复
			$filename ="./img/".time().$_FILES["file"]["name"];
			//转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
			$filename =iconv("UTF-8","gb2312",$filename);
			 //检查文件或目录是否存在
			if(file_exists($filename))
			{
				echo"该文件已存在";
			}
			else
			{  
				//保存文件,   move_uploaded_file 将上传的文件移动到新位置  
				move_uploaded_file($_FILES["file"]["tmp_name"],$filename);//将临时地址移动到指定地址    
				$link = create_connection();
				$date = date('Y-m-d H:i:s');
				$sql = "INSERT INTO illegal (carNum, illegalContent, illegalTime, adminId, imgUrl) VALUES ('$_POST[carNum]','$_POST[illeageComt]', '$date', '$_COOKIE[id]', '$filename')";
				
				$result = execute_sql($link, "schoolcarmanager", $sql);
				
				if($result == 0)
				{
					die('无法插入数据: ' . mysqli_error($link));
				}
				header("Location: superviseillegal.php");  
				
				mysqli_close($link);
			}        
		}
		else
		{
			echo"文件类型错误";
		}
	}
?>