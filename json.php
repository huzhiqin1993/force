<?php

session_start(); //session开始
//连接数据库
$con = mysql_connect("localhost", "root", "");
if (!$con) {
        die('Could not connect: '.mysql_error());
}
mysql_select_db("chc-estate", $con); //选择要操作的数据库名
mysql_query('set names utf8'); //数据库编码格式
//$des = isset($_REQUEST['Target'])?($_REQUEST['Target']):"";   
$serach = $_POST['serach']; //接收前台传过来的搜索的值
$fruit = $_POST['fruit']; //接收前台传过来的要查询的数据表名
$change = $_POST['change']; //接收前台传过来的子数据、母数据
$relation = $_POST['relation']; //接收前台传过来的层级
$colfirst = "COL1"; //定义初始变量
$coltwo = "COL2";

// echo $change;
// echo $fruit;
// echo $serach;
//change==0 作为母数据查询
if ($change == 0) {
        $colfirst = "COL1";
        $coltwo = "COL2";
} else {
        $colfirst = "COL2";
        $coltwo = "COL1";
}

//echo $colfirst;  
// echo $coltwo; 

$p = 0; //定义初始变量
$target1 = 0;
$source = 0;
$source2 = 0;

//零层关系  
//查询数据表，并将查询到的结果存入data0数组中  	  
$sql0 = "select * from  $fruit where $colfirst='$serach'";

//echo "<br>";
//echo $arrTarget2, "<<<<<";
//echo "<br> &&&&&&";
//print_r($sql0);
//echo "<br>";

$query0 = mysql_query($sql0);
while ($result0 = mysql_fetch_assoc($query0)) {
        $data0[] = $result0;
}
foreach($data0 as $row0) {   //*********************************************
        $arrTarget0 = $row0[$colfirst]; //父节点名字
        $arrIPaddress0 = $row0[$coltwo]; //子节点名字
		
		$regit0 = $row0['COL 3']; //节点信息数据
		$seal0 = $row0['COL 4'];
		$validity0 = $row0['COL 5'];
		$agency0 = $row0['COL 6'];
        //nodes0   0级节点
        //将节点存入到node数组中
        if ($p++==0) {
                //$node[]= '{"name":"'.$arrTarget1.'","group":1,"size":300,"regit":"'.$regit.'","seal":"'.$seal.'","validity":"'.$validity.'","agency":"'.$agency.'"}';  
                $node[] = '{"name":"'.$arrTarget0.'","regit":"'.$regit0.'","seal":"'.$seal0.'","image":"qq.png","validity":"'.$validity0.'","agency":"'.$agency0.'"}';
                $arry[] = $arrTarget0; ////

                //******************************************************************************************************

        }
}

//echo "<br>";
//echo $arrTarget2, "<<<<<";
//echo "<br> !!!!!";
//print_r($node);
//echo "<br>";

//一层关系
//查询数据表，并将查询到的结果存入data1数组中  	  
$sql1 = "select * from  $fruit where $colfirst='$serach'";
$query1 = mysql_query($sql1);
while ($result1 = mysql_fetch_assoc($query1)) {
        $data1[] = $result1;
}

//遍历data数组中的数据  循环     //*********************************************
foreach($data1 as $row1) {
        $arrTarget1 = $row1[$colfirst]; //父节点名字
        $arrIPaddress1 = $row1[$coltwo]; //子节点名字
        //        $regit1 = $row1['COL 3']; //节点信息数据
        //        $seal1 = $row1['COL 4'];
        //        $validity1 = $row1['COL 5'];
        //        $agency1 = $row1['COL 6'];

        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
      //  if (!in_array('{"name":"'.$arrIPaddress1.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
		   if (!in_array($arrIPaddress1,$arry)) {  
                $node[] = '{"name":"'.$arrIPaddress1.'","image":"qun.png"}';
                $arry[] = $arrIPaddress1;

                //******************************************************************************************************

                //		        if (!in_array($arrIPaddress1,$arry)) {  
                //		                 $node[] = '{"name":"'.$arrIPaddress1.'","group":1,"size":60}';
                //		                 $arry[] = $arrIPaddress1; /////

                //links0  0级节点的连线
                //生成节点连线关系
                $source++;
				@$link .= '{"target":'.$source.',"source":'.$target1.',"linerank":"2","lineparent":"同学", "relation":"同学" },';
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
                $sql2 = "select * from  $fruit where $coltwo = '{$arrIPaddress1}'";
                $query2 = mysql_query($sql2);
                while ($result2 = mysql_fetch_assoc($query2)) {
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

                        $arrIPaddress2 = $row2[$coltwo]; //子节点名字
                        				$regit2 = $row2['COL 3']; //节点信息数据
                                        $seal2 = $row2['COL 4'];
                                        $validity2 = $row2['COL 5'];
                                        $agency2 = $row2['COL 6'];
                        //nodes1  将节点存入node数组中，数组中已有相同的节点不再存入	  
                        //if (!in_array('{"name":"'.$arrTarget2.'","group":1,"size":60,"image":"1.png","rank":"1","parent":"1","id":"c11"}', $node)) {
							if (!in_array($arrTarget2,$arry)) {  
                                $node[] = '{"name":"'.$arrTarget2.'","regit":"'.$regit2.'","seal":"'.$seal2.'","image":"qq.png","validity":"'.$validity2.'","agency":"'.$agency2.'"}';
                                $arry[] = $arrTarget2;
                                $tan[] = $arrTarget2;
                                //******************************************************************************************************

                                //				  if (!in_array($arrTarget2,$arry)) {  
                                //					   $node[]= '{"name":"'.$arrTarget2.'","group":1,"size":60}'; 		  
                                //					   $arry[] = $arrTarget2;

                              //  echo "<br>";
//                                //echo $arrTarget2, "<<<<<";
//                                echo "<br> !!!!!";
//                                print_r($arry);
//                                echo "<br>";

                                //links1  
                                $source2++;
                                //生成节点连线关系
                                $link .= '{"target":'.$source2.',"source":'.$target2.',"linerank":"2","lineparent":"同学", "relation":"朋友" },';
                                $source++;

                              $num[]=$source2;

                        } else {

                                $tt2 = array_search($arrTarget2,$arry);

                                // echo "<br>";
                                //                        echo "!!!",$tt17;
                                if ($source2 != $tt17) {
                                        //   echo "<br> >>>>>>>";
                                        //                                print_r($tt2);
                                        //                                echo "<br>";
                                        $link .= '{"target":'.$tt2.',"source":'.$tt17.',"linerank":"2","lineparent":"同学", "relation":"同事" },';

                                };
                                //		$link .= '{"source":3,"target":'.$tt17.'},';
                                //		$link .= '{"source":4,"target":'.$tt17.'},';
                        }

                }
       }	
}


 // //// 三层关系    
                                if ($relation == 1) {
                                for($i=0;$i<count($tan);$i++)
                        {
                                        $target3 = $source2;
                                        // 将二层关系中子节点的名字作为条件进行查询  查询的结果存入到数组data3中count($arr)
                                        $sql3 = "select * from $fruit where $colfirst  = '$tan[$i]'";

                                        //echo "<br>";
                                        //echo "<br>";
                                        //print_r($sql3);
                                        //echo "<br>";
                                        //echo "<br>";

                                        $query3 = mysql_query($sql3);
                                        while ($result3 = mysql_fetch_assoc($query3)) {									
                                                $data3[] = $result3;
												
												 //print_r($result3);
                                                //echo "<br>";
                                                    //echo "<br>";
												
												
                                        }
                                       // 循环遍历data3中的数据   //***************************************** 
                                        foreach($data3 as $row3) {
                                                $arrTarget3 = $row3[$colfirst]; //父节点名字
                                                $arrIPaddress3 = $row3[$coltwo]; //子节点名字

                                                //nodes2  将节点存入node数组中，数组中已有相同的节点不再存入	  
                                                if (!in_array('{"name":"'.$arrIPaddress3.'","group":1,"size":60,"image":"qq.png","rank":"3","parent":"1","id":"c11"}', $node)) {
                                                        $node[] = '{"name":"'.$arrIPaddress3.'","group":1,"size":60,"image":"qq.png","rank":"3","parent":"1","id":"c11"}';
														 
														
                                                       // $arry[] = $arrIPaddress3;

                                                        //******************************************************************************************************

                                                        //if (!in_array($arrIPaddress3,$arry)) {  
                                                        // $node[]= '{"name":"'.$arrIPaddress3.'","group":1,"size":60}'; 
                                                        // $arry[]=$arrIPaddress3;

                                                        //links2  
                                                        $source2++;
                                                        //生成节点连线关系
                                                        $link .= '{"target":'.$source2.',"source":'.$num[$i].',"linerank":"2","lineparent":"同学", "relation":"同事"},';
                                                        $source++;

                                                }//else {
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
																							
																							
                                        }
                                }
                                }


//echo "<br> !!!!!";
//echo $source2;
//echo "<br>";


//print_r($num);
//echo "<br>";
//echo $arrTarget2, "<<<<<";

//print_r($tan);
//echo "<br>";
//echo "<br>";
//print_r($node);
//echo "<br>";

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
//echo $json;
//$_SESSION['json']=$json;

//$json = '['.$json.']';
////$json = json_encode($json);
//echo $json;

//$ip=$_SERVER["REMOTE_ADDR"]; 
//
//echo $ip;
//$_SESSION['ip']=($ip).'.json';
//
//echo ($ip).'.json';

//生成一个随机的六位数
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
file_put_contents($authnum.'del.json', $json); //数据写入到force.json文件中 
// echo "json文件已生成"; 
 
?>