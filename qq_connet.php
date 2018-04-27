

<?php
 session_start();

//header("Content-type: text/html; charset=gb2312"); 
$dbhost = ""; 
$dbuser = "sa"; //你的mssql用户名 
$dbpass = "123456"; //你的mssql密码 
//$dbname = "GroupData3"; //你的mssql库名 
$dbname = "GroupData"; //你的mssql库名 
$connect=odbc_connect("Driver={SQL Server};Server=$dbhost;Database=$dbname","$dbuser","$dbpass"); 
if(!$connect)
{echo "失败"."<br>";}


//不显示警告提示信息

error_reporting(E_ALL^E_WARNING^E_NOTICE);


//$des = isset($_REQUEST['Target'])?($_REQUEST['Target']):"";   
$serach = $_POST['serach']; //接收前台传过来的搜索的值


$colfirst = "QQNum"; //定义初始变量
$coltwo = "QunNum";


//取得当前秒值，计算搜索时间用
$ser= date('s');
// echo $change;
// echo $fruit;
// echo $serach;
//change==0 作为母数据查询


//echo $colfirst;  
// echo $coltwo; 

$p = 0; //定义初始变量
$target1 = 0;
$source = 0;
$source2 = 0;

//生成一个随机的六位数
srand((double)microtime()*1000000);//create a random number feed.
$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
for($i=0;$i<8;$i++){
$randnum=rand(0,35); // 10+26;
@$authnum .=$list[$randnum];
}
echo $authnum;
setcookie("json",$authnum.'del.json');


//$groups=array("Group104","Group105","Group106");

for($j=1001;$j<1101;$j++)
{


//一层关系
//查询数据表，并将查询到的结果存入data1数组中

$sql1 = "select * from  Group$j where $colfirst='$serach'";
$query1 = odbc_exec($connect,$sql1);
while ($result1 = odbc_fetch_array($query1)) {
        $data1[] = $result1;
}

//遍历data数组中的数据  循环     //*********************************************
foreach($data1 as $row1) {
        $arrTarget1 = $row1[$colfirst]; //父节点名字
        $arrIPaddress1 = $row1[$coltwo]; //子节点名字
		
		
		

            $Nick1 = $row1['Nick']; //节点信息数据
            $Nick1=iconv('gb2312', 'utf-8', $Nick1);
            $Auth1 = $row1['Auth'];    
            $Age1 = $row1['Age'];
            $Gender1 = $row1['Gender'];

        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
      //  if (!in_array('{"name":"'.$arrIPaddress1.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
		  
		  if ($p++==0) {
                //$node[]= '{"name":"'.$arrTarget1.'","group":1,"size":300,"regit":"'.$regit.'","seal":"'.$seal.'","validity":"'.$validity.'","agency":"'.$agency.'"}';  
                $node[] = '{"name":"'.$arrTarget1.'","group":1,"age":"'.$Age1.'","image":"qq.png","type":"qq","gender":"'.$Gender1.'","nick":"'.$Nick1.'"}';
                $arry[] = $arrTarget1; ////

                //******************************************************************************************************

            }
	 	  
		  
		   if (!in_array($arrIPaddress1,$arry)) {  
               
			 //$node[] = '{"name":"'.$arrIPaddress1.'","group":1,"mastqq":"'.$MastQQ.'","createdate":"'.$CreateDate.'","image":"qun.png","type":"qun","title":"'.$Title.'"}';
				$node[] = '{"name":"'.$arrIPaddress1.'","group":1,"image":"qun.png","type":"qun"}';	
                $qunarry[]= $arrIPaddress1;
				
				$arry[] = $arrIPaddress1;




                //生成节点连线关系
                $source++;
				@$link .= '{"target":'.$source.',"source":'.$target1.',"linerank":"2","auth":"'.$Auth1.'", "relation":"同学","nick":"'.$Nick1.'"},';
                $target2 = $source;
                $source2 = $source;

               // echo "<br>";

                //
                $tt17 = $target2;


               
	
			   
			    //二层关系  将一层关系中子节点的名字作为条件进行查询  查询的结果存入到数组data2中 
			            
                $sql2 = "select * from  Group$j	 where $coltwo = '{$arrIPaddress1}'";
                $query2 = odbc_exec($connect,$sql2);
                while ($result2 = odbc_fetch_array($query2)) {
                        $data2[] = $result2;
                }
			
                //循环遍历data2中的数据  //*****************************************
                foreach($data2 as $row2) {
                        $arrTarget2 = $row2[$colfirst]; //父节点名字
                        //echo "<br>";
//   
                        $arrIPaddress2 = $row2[$coltwo]; //子节点名字
                        		$Nick2 = $row2['Nick']; //节点信息数据
								$Nick2=iconv('gb2312', 'utf-8', $Nick2);
									    //$s=mb_detect_encoding($regit2);
                                        
								
                        $Auth2 = $row2['Auth'];
                        $Age2 = $row2['Age'];
						$Gender2 = $row2['Gender'];
                        //                $agency2 = $row2['COL 6'];
                        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
                        //if (!in_array('{"name":"'.$arrTarget2.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
							if (!in_array($arrTarget2,$arry)) {  
                                $node[] = '{"name":"'.$arrTarget2.'","group":1,"age":"'.$Age2.'","image":"qq.png","type":"qq","gender":"'.$Gender2.'","nick":"'.$Nick2.'"}';
                                $arry[] = $arrTarget2;
 

                                //links1  
                                $source2++;
                                //生成节点连线关系
                                $link .= '{"target":'.$source2.',"source":'.$target2.',"linerank":"2","auth":"'.$Auth2.'", "relation":"朋友","nick":"'.$Nick2.'"},';
                                $source++;


                        } else {

                                $tt2 = array_search($arrTarget2,$arry);

                             
                                if ($source2 != $tt17) {
                                 
                                   
                                        $link .= '{"target":'.$tt2.',"source":'.$tt17.',"linerank":"2","auth":"'.$Auth2.'","relation":"同事","nick":"'.$Nick2.'"},';
									
										

                                };
                            
                        }

                }
       }	
}
}

//将数据转换成json格式
$json_n = json_encode($node);
$nodes = '{"nodes":'.$json_n;
$json_l = json_encode($link);
$links = '"links":['.$json_l.']}';

$json_f = $nodes.$links;







$new1 = str_replace('\"', '"', $json_f);
$new2 = str_replace('"{', '{', $new1);
$new3 = str_replace('}"', '}', $new2);
$new4 = str_replace('}]"', '}],"', $new3);
$json = str_replace('},"]}', '}]}', $new4);
//header("Content-type: application/json"); 
file_put_contents($authnum.'del.json', $json); //数据写入到force.json文件中 
//$json = json_encode($json);
//echo $json; 
//计算查询花费时间函数
$se= date('s');
$s=0;
if($se>=$ser)
{
	$s=$se-$ser;
}
else
{
	$s=($se+60)-$ser;
}

//setcookie("time",$s);
echo "您搜索花费的时间为".$s."秒";



//$_SESSION['json']=$authnum.'.json';




//header('Location:quninfo.php?vaule='.$qunarry);
$_SESSION['vaule']=$qunarry;


?>