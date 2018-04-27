
<?php

session_start();

$dbhost = ""; 
$dbuser = "sa"; //你的mssql用户名 
$dbpass = "123456"; //你的mssql密码 
//$dbname = "GroupData3"; //你的mssql库名 
$dbname = "qqdata"; //你的mssql库名 
$connect=odbc_connect("Driver={SQL Server};Server=$dbhost;Database=$dbname","$dbuser","$dbpass"); 
//if($connect)
//{echo "成功"."<br>";}
//session值的读取:
//$qunarry = $_SESSION['vaule'];

$serach = $_POST['serach']; 
//$qunarry = $_GET['vaule'];
$serach=iconv('utf-8', 'gb2312', $serach); 

for($i=1;$i<12;$i++)
		{
		$sql = "select * from  data$i where Col001='$serach' ";
		$query = odbc_exec($connect,$sql);
		while ($result = odbc_fetch_array($query)) {
				$data[] = $result;
		}
		}
		
		
		foreach($data as $row) {
			    $Name = $row['Col001'];
				echo "<br>";
			    echo "姓名:".$Name=iconv('gb2312', 'utf-8', $Name);
				
				echo "<br>";
				echo "身份证:".$CtfId = $row['Col005']; //父节点名字
				echo "<br>";
				echo "性别:".$Gender= $row['Col006']; //子节点名字
				echo "<br>";
					
				echo "生日:".$Birthday= $row['Col007']; 
				echo "<br>";	
				     $Address= $row['Col008'];
				echo "地址:".$Address=iconv('gb2312', 'utf-8', $Address);
				echo "<br>";
				echo "手机:".$Mobile= $row['Col020']; 
				echo "<br>";
				echo "电话:".$Tel= $row['Col021']; 
				echo "<br>";
				echo "邮箱:".$EMail= $row['Col023']; 
				echo "<br>";
				echo "时间:".$Version= $row['Col032']; 
				echo "<br>";
				
			

		}

 
  
?>