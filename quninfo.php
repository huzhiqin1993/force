
<?php

session_start();

$dbhost = ""; 
$dbuser = "sa"; //你的mssql用户名 
$dbpass = "s123456"; //你的mssql密码 
//$dbname = "GroupData3"; //你的mssql库名 
$dbname = "quninfo"; //你的mssql库名 
$connect=odbc_connect("Driver={SQL Server};Server=$dbhost;Database=$dbname","$dbuser","$dbpass"); 
//if($connect)
//{echo "成功"."<br>";}
//session值的读取:
$qunarry = $_SESSION['vaule'];

srand((double)microtime()*1000000);//create a random number feed.
$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
for($i=0;$i<8;$i++){
$randnum=rand(0,35); // 10+26;
@$authnum .=$list[$randnum];
}
echo $authnum;

//$_SESSION['json']=$authnum.'.json';

setcookie("qunjson",$authnum.'del.json');


$serach = $_POST['start']; 
//$qunarry = $_GET['vaule'];
 
$arr = array();
for($j=0;$j<count($qunarry);$j++)
		{
for($i=11;$i<110;$i++)
		{
		$sql = "select * from  QunList$i where QunNum='$qunarry[$j]'";
		$query = odbc_exec($connect,$sql);
		while ($result = odbc_fetch_array($query)) {
				$data[] = $result;
		}
		}
		foreach($data as $row) {
			    $QunNum = $row['QunNum'];
				$MastQQ = $row['MastQQ']; //父节点名字
				$CreateDate= $row['CreateDate']; //子节点名字	
				$Title= $row['Title']; 
				$Title=iconv('gb2312', 'utf-8', $Title);
				$Class= $row['Class']; 
				$QunText= $row['QunText']; 
				$QunText=iconv('gb2312', 'utf-8', $QunText);
			
//                echo "<br> ******";
//				  echo $MastQQ;
//				  echo "<br>";	
//				  echo $Title;	
//				  echo "<br>";
//				  echo $Class;
//				  echo "<br> ******";
			         
		if (!in_array($QunNum,$arr)) {   
		 // if (!in_array('{"group":1,"mastqq":"'.$MastQQ.'","createdate":"'.$CreateDate.'","class":"'.$Class.'","quntext":"'.$QunText.'","title":"'.$Title.'"}', $arr)) {	  
		 $node[]= '{"name":"'.$QunNum.'","mastqq":"'.$MastQQ.'","createdate":"'.$CreateDate.'","class":"'.$Class.'","quntext":"'.$QunText.'","title":"'.$Title.'"}';
			   $arr[] = $QunNum;
			 // $arr[] = '{"group":1,"mastqq":"'.$MastQQ.'","createdate":"'.$CreateDate.'","image":"qun.png","type":"qun","title":"'.$Title.'"}';
		}
		}
	}	

$nodes = json_encode($node);
//$nodes = '{"nodes":'.$json_n;
//$nodes=$nodes.'}';
//
$new1 = str_replace('\"', '"', $nodes);
$new2 = str_replace('"{', '{', $new1);
$json= str_replace('}"', '}', $new2);
//$json = json_encode($new3);
file_put_contents($authnum.'del.json', $json);
//file_put_contents("quninfo1.json", $json); //数据写入到force.json文件中
echo $nodes;
//session值的销毁
unset($_SESSION['vaule']);
  
  
  
?>