

<?php
 session_start();

//header("Content-type: text/html; charset=gb2312"); 
$dbhost = ""; 
$dbuser = "sa"; //你的mssql用户名 
$dbpass = "s123456"; //你的mssql密码 
//$dbname = "GroupData3"; //你的mssql库名 
$dbname = "kaifangjilu"; //你的mssql库名 
$connect=odbc_connect("Driver={SQL Server};Server=$dbhost;Database=$dbname","$dbuser","$dbpass"); 
//if($connect)
//{echo "成功"."<br>";}





//$des = isset($_REQUEST['Target'])?($_REQUEST['Target']):"";   
$serach = $_POST['serach']; //接收前台传过来的搜索的值
$fruit = $_POST['fruit']; //接收前台传过来的要查询的数据表名
$change = $_POST['change']; //接收前台传过来的子数据、母数据
$relation = $_POST['relation']; //接收前台传过来的层级
//$colfirst = "QQNum"; //定义初始变量
//$coltwo = "QunNum";


//取得当前秒值，计算搜索时间用
$ser= date('s');
// echo $change;
// echo $fruit;
// echo $serach;
//change==0 作为母数据查询
//$two = "Version";
$two = "Version";

if ($change == 0) {
        $colfirst = "Name";
        $coltwo = $two ;
} else {
        $colfirst = $two;
        $coltwo = "Name";
}

//echo $colfirst;  
// echo $coltwo; 

$p = 0; //定义初始变量
$target1 = 0;
$source = 0;
$source2 = 0;



srand((double)microtime()*1000000);//create a random number feed.
$ychar="0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z";
$list=explode(",",$ychar);
for($i=0;$i<8;$i++){
$randnum=rand(0,35); // 10+26;
@$authnum .=$list[$randnum];
}
echo $authnum;

//$_SESSION['json']=$authnum.'.json';

setcookie("json",$authnum.'del.json');
//$groups=array("Group104","Group105","Group106");

for($j=1;$j<12;$j++)
{
//零层关系  
//查询数据表，并将查询到的结果存入data0数组中  	  
//$sql0 = "select * from  Group$j where $colfirst='$serach'";
//
//$query0 = odbc_exec($connect,$sql0);
//while ($result0 = odbc_fetch_array($query0)) {
//        $data0[] = $result0;
//
//}
//foreach($data0 as $row0) {   //*********************************************
//        $arrTarget0 = $row0[$colfirst]; //父节点名字
//        $arrIPaddress0 = $row0[$coltwo]; //子节点名字
//		$Nick0 = $row0['Nick']; //节点信息数据
//		$Nick0=iconv('gb2312', 'utf-8', $Nick0);
//		$Auth0 = $row0['Auth'];    
//		$Age0 = $row0['Age'];
//		$Gender0 = $row0['Gender'];
//        //nodes0   0级节点
//        //将节点存入到node数组中
//        if ($p++==0) {
//                //$node[]= '{"name":"'.$arrTarget1.'","group":1,"size":300,"regit":"'.$regit.'","seal":"'.$seal.'","validity":"'.$validity.'","agency":"'.$agency.'"}';  
//                $node[] = '{"name":"'.$arrTarget0.'","group":1,"age":"'.$Age0.'","image":"qq.png","type":"qq","gender":"'.$Gender0.'"}';
//                $arry[] = $arrTarget0; ////
//
//                //******************************************************************************************************
//
//        }
//}
//echo "<br>";
//echo $arrTarget2, "<<<<<";
//echo "<br> !!!!!";
//print_r($node);
//echo "<br>";


//一层关系
//查询数据表，并将查询到的结果存入data1数组中


$serach=iconv('utf-8', 'gb2312', $serach); 
  	
  
$sql1 = "select * from  data$j where $colfirst='$serach'";
$query1 = odbc_exec($connect,$sql1);
while ($result1 = odbc_fetch_array($query1)) {
        $data1[] = $result1;
}

//遍历data数组中的数据  循环     //*********************************************
foreach($data1 as $row1) {
        $arrTarget1 = $row1[$colfirst]; //父节点名字
		
		$arrTarget1=iconv('gb2312', 'utf-8', $arrTarget1);
        $arrIPaddress1 = $row1[$coltwo]; //子节点名字

            $Nick1 = $row1['Address']; //节点信息数据
            $Nick1=iconv('gb2312', 'utf-8', $Nick1);
            $Auth1 = $row1['CtfId'];    
            $Age1 = $row1['Birthday'];
            $Gender1 = $row1['Gender'];

        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
      //  if (!in_array('{"name":"'.$arrIPaddress1.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
		  
		  if ($p++==0) {
                //$node[]= '{"name":"'.$arrTarget1.'","group":1,"size":300,"regit":"'.$regit.'","seal":"'.$seal.'","validity":"'.$validity.'","agency":"'.$agency.'"}';  
                $node[] = '{"name":"'.$arrTarget1.'","group":1,"age":"'.$Age1.'","image":"qq.png","type":"qq","gender":"'.$Gender1.'"}';
                $arry[] = $arrTarget1; ////

                //******************************************************************************************************

            }
	 	  
		  
		   if (!in_array($arrIPaddress1,$arry)) {  
               
			 //$node[] = '{"name":"'.$arrIPaddress1.'","group":1,"mastqq":"'.$MastQQ.'","createdate":"'.$CreateDate.'","image":"qun.png","type":"qun","title":"'.$Title.'"}';
				$node[] = '{"name":"'.$arrIPaddress1.'","group":1,"image":"qun.png","type":"qun"}';	
                $qunarry[]= $arrIPaddress1;
				
				$arry[] = $arrIPaddress1;


                //******************************************************************************************************

                //		        if (!in_array($arrIPaddress1,$arry)) {  
                //		                 $node[] = '{"name":"'.$arrIPaddress1.'","group":1,"size":60}';
                //		                 $arry[] = $arrIPaddress1; /////

                //links0  0级节点的连线
                //生成节点连线关系
                $source++;
				@$link .= '{"target":'.$source.',"source":'.$target1.',"linerank":"2","auth":"5", "relation":"同学","nick":"'.$Nick1.'"},';
                $target2 = $source;
                $source2 = $source;

               // echo "<br>";
//                //echo $arrTarget2, "<<<<<";
//                echo "<br> !!!!!";
//                //print_r($arry);
//                echo "<br>";

                //
                $tt17 = $target2;

                //        echo "<br>";
                //        echo "@@@@@@", $tt17;
                //        echo "<br>";

               
	
			   
			    //二层关系  将一层关系中子节点的名字作为条件进行查询  查询的结果存入到数组data2中 
			            
                $sql2 = "select * from  data$j	 where $coltwo = '{$arrIPaddress1}'";
                $query2 = odbc_exec($connect,$sql2);
                while ($result2 = odbc_fetch_array($query2)) {
                        $data2[] = $result2;
                }
			
                //循环遍历data2中的数据  //*****************************************
                foreach($data2 as $row2) {
                        $arrTarget2 = $row2[$colfirst]; //父节点名字
                        //echo "<br>";
//                        echo "????";
//                        print_r($arrTarget2);
//                        echo "<br>";
//                        echo "<br>";
                    $arrTarget2=iconv('gb2312', 'utf-8', $arrTarget2);
                        $arrIPaddress2 = $row2[$coltwo]; //子节点名字
						$Nick2 = $row2['Address']; //节点信息数据
						$Nick2=iconv('gb2312', 'utf-8', $Nick2);
								//$s=mb_detect_encoding($regit2);
								
						
						$Auth2 = $row2['CtfId'];
						$Age2 = $row2['Birthday'];
						$Gender2 = $row2['Gender'];

						
                        //                $agency2 = $row2['COL 6'];
                        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
                        //if (!in_array('{"name":"'.$arrTarget2.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
							if (!in_array($arrTarget2,$arry)) {  
                                $node[] = '{"name":"'.$arrTarget2.'","group":1,"age":"'.$Age2.'","image":"qq.png","type":"qq","gender":"'.$Gender2.'"}';
                                $arry[] = $arrTarget2;
                                //$tan[] = $arrTarget2;
                                //******************************************************************************************************

                                //				  if (!in_array($arrTarget2,$arry)) {  
                                //					   $node[]= '{"name":"'.$arrTarget2.'","group":1,"size":60}'; 		  
                                //					   $arry[] = $arrTarget2;

                              //  echo "<br>";
                                //echo $Nick2, "<<<<<";
                                //echo "<br> !!!!!";
//                                print_r($arry);
//                                echo "<br>";

                                //links1  
                                $source2++;
                                //生成节点连线关系
                                $link .= '{"target":'.$source2.',"source":'.$target2.',"linerank":"2","auth":"5", "relation":"朋友","nick":"'.$Nick2.'"},';
                                $source++;
                                //echo $link, "";
                                //echo "<br> !!!!!";
                              //$num[]=$source2;

                        } else {

                                $tt2 = array_search($arrTarget2,$arry);

                                // echo "<br>";
                                //                        echo "!!!",$tt17;
                                if ($source2 != $tt17) {
                                        //   echo "<br> >>>>>>>";
                                        //                                print_r($tt2);
                                        //                                echo "<br>";
                                        $link .= '{"target":'.$tt2.',"source":'.$tt17.',"linerank":"2","auth":"5","relation":"同事","nick":"'.$Nick2.'"},';
										//echo $link, "<<<<<";
                                        //echo "<br> !!!!!";
										

                                };
                                //		$link .= '{"source":3,"target":'.$tt17.'},';
                                //		$link .= '{"source":4,"target":'.$tt17.'},';
                        }

                }
       }	
}
}
 // //// 三层关系    
//                                if ($relation == 1) {
//                                for($i=0;$i<count($tan);$i++)
//                        {
//                                        $target3 = $source2;
//                                        // 将二层关系中子节点的名字作为条件进行查询  查询的结果存入到数组data3中count($arr)
//                                        $sql3 = "select * from $fruit where $colfirst  = '$tan[$i]'";
//
//                                    //    echo "<br>";
////                                        echo "<br>";
////                                        print_r($sql3);
////                                        echo "<br>";
////                                        echo "<br>";
//
//                                        $query3 = mysql_query($sql3);
//                                        while ($result3 = mysql_fetch_assoc($query3)) {									
//                                                $data3[] = $result3;
//												
//												 print_r($result3);
//                                                echo "<br>";
//                                                    echo "<br>";
//												
//												
//                                        }
//                                        //循环遍历data3中的数据   //***************************************** 
//                                        foreach($data3 as $row3) {
//                                                $arrTarget3 = $row3[$colfirst]; //父节点名字
//                                                $arrIPaddress3 = $row3[$coltwo]; //子节点名字
//
//                                                //nodes2  将节点存入node数组中，数组中已有相同的节点不再存入	  
//                                                if (!in_array('{"name":"'.$arrIPaddress3.'","group":1,"size":60}', $node)) {
//                                                        $node[] = '{"name":"'.$arrIPaddress3.'","group":1,"size":60}';
//														 
//														
//                                                       // $arry[] = $arrIPaddress3;
//
//                                                        //******************************************************************************************************
//
//                                                        //if (!in_array($arrIPaddress3,$arry)) {  
//                                                        // $node[]= '{"name":"'.$arrIPaddress3.'","group":1,"size":60}'; 
//                                                        // $arry[]=$arrIPaddress3;
//
//                                                        //links2  
//                                                        $source2++;
//                                                        //生成节点连线关系
//                                                        $link .= '{"source":'.$source2.',"target":'.$num[$i].'},';
//                                                        $source++;
//
//                                                }else {
//						
//														$tt3 = array_search('{"name":"'.$arrIPaddress3.'","group":1,"size":60}', $node);
//						
//														// echo "<br>";
//														//                        echo "!!!",$tt17;
//														if ($source2 != $num[$i]) {
//																//   echo "<br> >>>>>>>";
//																//                                print_r($tt2);
//																//                                echo "<br>";
//																$link .= '{"source":'.$tt3.',"target":'.$num[$i].'},';
//																echo "!!!",$num[$i];
//						
//														};
//													  
//												}
//																							
//																							
//                                        }
//                                }
//                                }


echo "<br> !!!!!";
//echo $source2;
echo "<br>";

//
////print_r($num);
//echo "<br>";
////echo $arrTarget2, "<<<<<";
//
////print_r($tan);
//echo "<br>";
//echo "<br>";
print_r($node);
//echo "<br>";

print_r($link);
//$ii = array_search('{"name":"'.$arrTarget2.'","group":1,"size":60}', $node);
//unset($arr[ii]);
//print_r($arry);
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



//header('Location:quninfo.php?vaule='.$qunarry);
//$_SESSION['vaule']=$qunarry;


?>