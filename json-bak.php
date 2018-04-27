<?php   
  $con= mysql_connect("localhost","root","");  
  if(!$con)  
  {  
     die('Could not connect: ' . mysql_error());  
  }  
  mysql_select_db("chc-estate", $con);  
  mysql_query('set names utf8');  
  
  //$des = isset($_REQUEST['Target'])?($_REQUEST['Target']):"";   
  
  $serach=$_POST['serach'];
  
  $sql = "select * from chc_yijijianzhu where `COL 1`='$serach'";  
  $query = mysql_query($sql);  
  while($result= mysql_fetch_assoc($query)){  
    $data[]=$result;  
  }  
  //一层关系  
  $p=0;  
  $source = 0;  
  $source1 = 0;  
  foreach ($data as $row ){  
    $Target = $row['COL 1'];  
    $IPaddress = $row['COL 2'];  
    //nodes0  
    if($p++==0){  
      $node[]= '{"name":"'.$Target.'","group":1}';  
    }  
    $node[]= '{"name":"'.$IPaddress.'","group":1}';  
    //links0  
    $source++;  
    @$link .= '{"source":'.$source.',"target":0},';  
    $target = $source;  
    $source1= $source;  
    
  //二层关系  
    $sql1 = "select * from chc_yijijianzhu where `COL 2`  = '{$IPaddress}'";  
    $query1 = mysql_query($sql1);  
    while ($result1 = mysql_fetch_assoc($query1)) {  
        $data1[] = $result1;  
      }  
    foreach ($data1 as $row1) {  
      $Target1 = $row1['COL 1'];  
      $IPaddress1 = $row1['COL 2'];  
      //nodes1  
      if (!in_array('{"name":"'.$Target1.'","group":2}',$node)) {  
        $node[]= '{"name":"'.$Target1.'","group":2}';  
        //links1  
      $source1++;  
      $link .= '{"source":'.$source1.',"target":'.$target.'},';  
      $source++;  
    }  
      }  
        
		
		
		
		
  }  
  
  
  
 $json_n = json_encode($node);   
 $nodes = '{"nodes":'. $json_n ;  
 $json_l= json_encode($link);  
 $links = '"links":['.$json_l.']}';  
   
 $json_f = $nodes.$links;  
  
   $new1 = str_replace('\"','"',$json_f);  
   $new2 = str_replace('"{','{',$new1);  
   $new3 = str_replace('}"','}',$new2);  
   $new4 = str_replace('}]"','}],"', $new3);  
   $json = str_replace('},"]}','}]}', $new4);  
  
  
file_put_contents("force.json",$json);  
  
 echo "json文件已生成";  
  ?>  