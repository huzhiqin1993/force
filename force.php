<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head>  
<meta charset="utf-8">    
<meta name="viewport" content="width=device-width,initial-scale=0.5,minimum-scale=0.25,maximum-scale=5.0">  
<!--<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">-->
<link href="css/jquery-ui.css" rel="stylesheet">
<title>Force</title>        
<style>  
.link {
  fill: none;
  stroke: #666;
  stroke-width: 1.5px;
  opacity:1.0;
}

.circle{

	opacity:1;
}
.edgelabel {
	font-size: 0.12rem ;
	font-family: Microsoft YaHei;
	opacity:0.7;
	
}
.edgepath
 {
	opacity:0.7;
}

.nodetext {  
  pointer-events: none;  
  font: 0.12rem Microsoft YaHei;  
  opacity:0.7;
  } 
.container {  
  margin-top: 0.1rem;  
  position:relative;
}  
#info{
	width:1.8rem;
	height:1rem;
	position:absolute;
	border:1px solid #999;
	border-radius:5px;
	display:none;
	z-index:9999;
	background-color:#CC6;
	text-align:left;
	padding-top:0.1rem;
	opacity:0.9;
	font-size:0.16rem;
	
}

img{border:none;}

body{background-image:url(image/bg.jpg);background-size:cover;font-size:0.16rem;}
a{text-decoration:none;color:#fff;}
#contianer {width:100%;margin-top:2%; }
#contianer h1 {margin:0 auto;width:7rem;;font-family:"微软雅黑";font-size:0.48rem;margin-bottom:0.3rem;position:relative;}
#contianer h1 img { width:0.8rem;height:0.8rem;margin-right:0.35rem;}
#contianer h1  span {position:absolute;top:0.2rem;}
  
#licensing {
  fill: green;
}

.link.licensing {
  stroke: green;
}

.link.resolved {
  stroke-dasharray: 0,2 1;
}


text {
  font: 0.12rem Microsoft YaHei;
  pointer-events: none;
  text-shadow: 0 1px 0 #fff, 1px 0 0 #fff, 0 -1px 0 #fff, -1px 0 0 #fff;
}

.linetext {
    font-size: 0.12rem Microsoft YaHei;
}
button{border-radius:3px;}
label input{height:0.15rem;width:0.15rem;}
  
  
</style>  

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="js/d3.js" charset="utf-8"></script>    

</head> 
<body >   
<div id="contianer">
<h1><a href="http://www.chc-ad.com/"><img src="image/logo.png" /></a><span style="font-size:0.44rem;" >中海世纪数据检索系统 </span></h1>
</div>
<p class="notice">注：本系统需要在IE9及以上浏览器才能运行，推荐使用360浏览器、谷歌chrome浏览器。</p>
<div>

<fieldset style="width:100%; margin-bottom:0rem;">
<form name="LoginForm" >
<p>

<span  for="label" class="label">请输入搜索条件:</span>
<input value="609689629"  style="height:0.25rem;width:5rem;background-color:#d1e4fe;font-size:0.16rem" id="serach" name="serach" type="text"  />
<p/>
<input style="height:0.25rem;width:0.5rem;border-radius:3px;"  type="button"    id="submit"  onClick="refer()"  name="submit" value="查询"  />

<div id="fruit" >
<label><input class="checkbox" name="fruit" type="radio" value="chc_yijijianzhu" />注册师数据</label> 
<label><input class="checkbox" name="fruit" type="radio" value="chc_shidagudong" />上市公司数据 </label> 
<label><input class="checkbox" name="fruit" type="radio" value="chc_soqiwang" />房地产数据</label> 
<label><input class="checkbox" name="fruit" type="radio" value="4" />开房记录</label> 
<label><input class="checkbox" name="fruit" type="radio" value="5" checked />QQ数据 </label>
</div>

<div id="change" >
<label><input class="checkbox" name="change" type="radio" value="1"  />母数据(公司名、QQ群)</label> 
<label><input class="checkbox" name="change" type="radio" value="0"checked />子数据(人名、上市公司、QQ)</label> 
</div>
<div id="relation" >
<label><input class="checkbox" name="relation" type="radio" value="0" checked  />二层关系</label> 
<label><input class="checkbox" name="relation" type="radio" value="1"  />三层关系 </label> 
</div>
           
<div id="back" >

</div>

<div id="quninfo" >

</div>








<!--手机版-->



 <!--
<div id="contianer">
<h1><a href="http://www.chc-ad.com/"><img src="image/logo.png" /></a><span>中海世纪数据检索系统 </span></h1>
</div>
<p style="font-size:48px;">注：本系统需要在IE9及以上浏览器才能运行，推荐使用360浏览器、谷歌chrome浏览器。</p>
<div>
<div>


<fieldset style="width:100%;font-size:48px;">
<form name="LoginForm" >
<p>
<label style="font-size:48px;" for="label" class="label">请输入搜索条件:</label>
<input value="武汉钢铁(集团)公司"  style="height:60px;width:500px;font-size:48px;" id="serach" name="serach" type="text"  />
<p/>
<input style="height:80px;width:120px;font-size:38px;"  type="button"    id="submit"  onClick="refer()"  name="submit" value="查询"  />

<div id="fruit" >
<label><input style="height:50px;width:50px;" name="fruit" type="radio" value="chc_yijijianzhu" />注册师数据</label> 
<label><input style="height:50px;width:50px;" name="fruit" type="radio" value="chc_shidagudong" checked/>上市公司数据 </label> 
<label><input style="height:50px;width:50px;" name="fruit" type="radio" value="chc_soqiwang" />房地产数据</label> 
<label><input style="height:50px;width:50px;" name="fruit" type="radio" value="" />开房记录</label> 
<label><input style="height:50px;width:50px;" name="fruit" type="radio" value="" />QQ数据 </label>
</div>

<div id="change" >
<label><input style="height:50px;width:50px;" name="change" type="radio" value="1" checked />母数据（公司名、QQ群）</label> 
<label><input style="height:50px;width:50px;" name="change" type="radio" value="0" />子数据（人名、上市公司、QQ）</label> 
</div>
<div id="relation" >
<label><input style="height:50px;width:50px;" name="relation" type="radio" value="0" checked />二层关系</label> 
<label><input style="height:50px;width:50px;" name="relation" type="radio" value="1" />三层关系 </label> 
</div>
<div id="back" >

</div>-->


<p>
609689629


长春中海地产有限公司 郝建民

福泉地产发展(深圳)有限公司 邓炯

吉林省德润地产顾问有限公司 魏建秋

宁夏台建房地产开发有限公司 张冬初
</p>

<p>
中国高科 傅引连

大秦铁路 太原铁路局

湖南海利 湘江产业投资有限责任公司
</p>

<p>
同济大学建筑设计研究院 徐甘

珠海东梁建筑设计有限公司 曹小军

新疆轻工业设计研究院有限责任公司 李永凯

中国建筑设计研究院
</p> 

</form>
</fieldset>
</div>
<button id="button" style="height:0.21rem;width:0.35rem;" >
<span id="b_css" class="ui-icon ui-icon-play"></span>
</button>
<button id="single" style="margin-left:0.1rem;" >
去除独立节点
</button>
<button id="shownick" style="margin-left:0.1rem;" >
显示昵称
</button>

<button id="removenick" style="margin-left:0.1rem;">
去除昵称
</button>

<button id="update" style="margin-left:0.1rem;">
刷新数据
</button>
<div   class="container graph">  

<div id="info" ></div>

</div>  

<script>      
  
  
 //var obj = document.getElementsByName("fruit");
//    for(var i=0; i<obj.length; i ++){
//        if(obj[i].checked){
//            alert(obj[i].value);
//			
//        }
//    } 
  
  //#######################	  

		function ajax(serachval,fruit,change,relation)
			{
		
		var fruit =0;	
		var obj = document.getElementsByName("fruit");
		for(var i=0; i<obj.length; i ++){
			if(obj[i].checked){
			   fruit= obj[i].value;	
			}
		}
		//alert(fruit);
		if(fruit==5){
		json  ='qq_connet.php'
		}
		else if(fruit==4){
		json  ='kf_connet.php'
		}
		//alert(json);
		else{
		json  ='json.php'
		}
		 $.ajax({
		    url:json,	
            //url: 'json.php',
			//url: 'connet.php',
			async:false,
            method: 'post',
			//dataType: 'json', 
            data: {serach:serachval,fruit:fruit,change:change,relation:relation},
          success: function(data){
	   //假设后端传回的 1 表示成功， 0 表示用户名或密码错误
	    //var test=new Array;
	   //window.test;
	   //test=[data];
	//data=eval(data);
	    //alert(data[0].nodes);
		//alert(data[0].links);
	   //alert(data[0].nodes[0].name)
	   
	   document.getElementById("back").innerHTML=data;
	   
	  
	  
          window.test=data;
	   //alert(test);  
	  return test;
	  // window.location.reload();
    	  }
		  
        });        
        // 别忘记了这句
		return test;
        return false;
		//alert(1)
}
  
  
//#######################	  

function  refer() {	

var fruit =0;	
var obj = document.getElementsByName("fruit");
for(var i=0; i<obj.length; i ++){
	if(obj[i].checked){
	   fruit= obj[i].value;	
	}
}


var change =0;	
var obj2 = document.getElementsByName("change");
for(var i=0; i<obj2.length; i ++){
	if(obj2[i].checked){
	   change= obj2[i].value;	
	}
}

var relation =0;	
var obj3 = document.getElementsByName("relation");
for(var i=0; i<obj3.length; i ++){
	if(obj3[i].checked){
	   relation= obj3[i].value;	
	}
}
 //alert(change);

var svalue= document.getElementById('serach').value;
var  svalue  =  svalue .replace(/\s+/g, ' ');
var  svalue = svalue.replace(/(^\s*)|(\s*$)/g, "");	 
        
if (svalue == "")
  {
    alert("搜索条件不能为空!");
    LoginForm.serach.focus();
    return false;
  }
else 
 {
	//var fruit="chc_yijijianzhu";
  ajax(svalue,fruit,change,relation);
//window.location.reload();
   // 别忘记了这句
   
   
   
//qq群信息搜索传值      
$.ajax({
		url:'quninfo.php',	      
		async:true,
		method: 'post',
		dataType: 'json', 
		data: {start:"start"},
	  success: function(data){
   //假设后端传回的 1 表示成功， 0 表示用户名或密码错误
  document.getElementById("quninfo").innerHTML=data;
	  }  
	});      
   
   return false;	
 } 
    };
  
   
    
  
 
 //******************************************************************************************************

    var width = document.body.clientWidth;  
    var height = 800;  
    var img_w = 22;  
    var img_h = 22;  
	var flag=false; 
	var flag1=false;
		
	var linkedByIndex = {};		
	var selected    = {};

//d3 颜色选择函数
    var color = d3.scale.category10();  
  
    //添加缩放行为
    var zoom = d3.behavior.zoom()  
          .scaleExtent([1, 10])  
          //.on("zoom", zoomed);  
  
    var root = d3.select(".graph").append("svg")  
          .attr("width", width)  
          .attr("height", height)  
          .call(zoom);  
  
	  
//    var svg = d3.select(".mian")
//	             .attr("width",width)
//				.attr("height",height)
//				.append("g");

     var svg = root.append('svg:g');
	  
	  
	var force = d3.layout.force()  //layout将json格式转化为力学图可用的格式
		.gravity(.05)  //指定重力
		//.distance(180)  //指定连线长度
		
		.linkDistance(function(b) { //群成员权限越大，连线越长
			var a = 180;
			if (b.auth=="4") {
				return a+100;
			}
			if (b.auth=="2") {
				return a+50;
			}
			return a
		})
		
		.charge(-250)  //相互之间的作用力//顶点的电荷数。该参数决定是排斥还是吸引，数值越小越互相排斥
		.size([width, height])  //指定范围，作用域的大小
   

    //.linkDistance(180)//连接线长度

    //.on("tick", tick);//指时间间隔，隔一段时间刷新一次画面



							//.linkDistance(100)
//							.linkStrength(1)
//							.charge(-500)
//
//							.alpha(0.5)
							//.friction(0.6)
							
				
							
							
 //******************************************************************************************************
 //******************************************************************************************************	
		
		
 //d3.json("connet.php", function(error, json) { 
	d3.json("", function(error, json) {  
	
	//function populate(data){console.log(data);}
	
	 if (error) throw error;  
	   
	  force  
		  .nodes(json.nodes)  //指定节点数组
		  .links(json.links)  //指定连线数组
		  .start();  //开始作用




//给圆设置阴影效果
    var glow = svg.append('filter')
        .attr('x'     , '-50%')
        .attr('y'     , '-50%')
        .attr('width' , '200%')
        .attr('height', '200%')
        .attr('id'    , 'blue-glow');

    glow.append('feColorMatrix')
        .attr('type'  , 'matrix')
        .attr('values', '0 0 0 0  0 '
                      + '0 0 0 0  0 '
                      + '0 0 0 0  .7 '
                      + '0 0 0 1  0 ');
					  
    glow.append('feGaussianBlur')
        .attr('stdDeviation', 5)
        .attr('result'      , 'coloredBlur');

    glow.append('feMerge').selectAll('feMergeNode')
        .data(['coloredBlur', 'SourceGraphic'])
        .enter()
	    .append('feMergeNode')
        .attr('in', String);
		

//将节点连线关系取出并将其存入数组		
json.links.forEach(function(d) {
  linkedByIndex[d.source.index + "," + d.target.index] = 1;
});

//判断两个节点是否是相邻节点
 function neighboring(a, b) {
  return linkedByIndex[a.index + "," + b.index] ||linkedByIndex[b.index + "," + a.index] || a.index == b.index;
}
		
		

//箭头
var marker= svg.append("marker")
    //.attr("id", function(d) { return d; })
    .attr("id", "resolved")
    //.attr("markerUnits","strokeWidth")//设置为strokeWidth箭头会随着线的粗细发生变化
    .attr("markerUnits","userSpaceOnUse")
    .attr("viewBox", "0 -5 10 10")//坐标系的区域
    .attr("refX",32)//箭头坐标
    .attr("refY", 0)
    .attr("markerWidth", 12)//标识的大小
    .attr("markerHeight", 12)
    .attr("orient", "auto")//绘制方向，可设定为：auto（自动确认方向）和 角度值
    .attr("stroke-width",1)//箭头宽度
    .append("path")
    .attr("d", "M0,-5L10,0L0,5")//箭头的路径
    .attr('fill','#A254A2');//箭头颜色

/* 将连接线设置为曲线
var path = svg.append("g").selectAll("path")
    .data(force.links())
    .enter().append("path")
    .attr("class", function(d) { return "link " + d.type; })
    .style("stroke",function(d){
        //console.log(d);
       return "#A254A2";//连接线的颜色
    })
    .attr("marker-end", function(d) { return "url(#" + d.type + ")"; });
*/

//设置连接线 
   
var edges_line = svg.selectAll(".edgepath")
    .data(json.links)
    .enter()
    .append("path")
    .attr({
          'd': function(d) {return 'M '+d.source.x+' '+d.source.y+' L '+ d.target.x +' '+d.target.y},
          'class':'edgepath',
          //'fill-opacity':0,
          //'stroke-opacity':0,
          //'fill':'blue',
          //'stroke':'red',
          'id':function(d,i) {return 'edgepath'+i;}})
    .style("stroke",function(d){
         var lineColor;
         //根据群的权限的不同设置线条颜色 
	    if(d.auth=="4"){
             lineColor="#FFD700";
         }else if(d.auth=="2"){
             lineColor="#B43232";
         }else{
             lineColor="#A254A2";
         }
         return lineColor;
     })
	 
	 
    .style("pointer-events", "none")//禁用连线上的鼠标事件
    .style("stroke-width",1)//线条粗细
    .attr("marker-end", "url(#resolved)" );//根据箭头标记的id号标记箭



////添加连线	 
// // var link = svg.selectAll(".link")  
//var edges_line = svg.selectAll("line")
//      
//	  .data(json.links)  
//      .enter()
//	  .append("line") 
//	  						
//      .attr("class", "link") 
//	  
//	  .style("stroke","#666")//更改连线颜色
//	  
//	  .style("stroke",function(d){
//         var lineColor;
//         //根据关系的不同设置线条颜色
//         if(d.relation=="同学" ){
//             lineColor="red";
//         }else if(d.relation=="同事"){
//             lineColor="yellow";
//         }
//         return lineColor;
//     })
//      .style("stroke-width",1)//更改连线宽度								
//	  
//	  //.style("display","none")  //���ع�ϵ��
//								
//								
//								.attr("linerank",function(d){
//									return d.linerank;
//								})
//								
//								.attr("lineparent",function(d){
//									return d.lineparent;
//								});





 //给连线添加文字
						

								
//			var edges_text = svg.selectAll(".linetext")
//								.data(json.links)
//								.enter()
//								.append("text")
//								.attr("class","linetext")
//								.attr("linerank",function(d){
//									return d.linerank;
//								})
//								.attr("lineparent",function(d){
//									return d.source.name;
//								})
//								//.style("display","none")//���ع�ϵ�ı�
//								.text(function(d){
//									return d.relation;
//								});
  
  
  
  
  
 //给连线添加文字  
var edges_text = svg.selectAll(".edgelabel")
.data(json.links)
.enter()
.append("text")
.style("pointer-events", "none")
//.attr("class","linetext")
.attr({  'class':'edgelabel',
               'id':function(d,i){return 'edgepath'+i;},
               'dx':90,
               'dy':15
               //'font-size':10,
               //'fill':'#aaa'
               });

//设置线条上的文字
edges_text.append('textPath')
		.attr('xlink:href',function(d,i) {return '#edgepath'+i})
		.style("pointer-events", "none")
		.text(function(d){
			if(d.auth==4){
			return  "群主";
			}else if(d.auth==2){
				return "管理员";
			}else{
				return "成员";
			}
			});
 //********************************************
  
 window.dataset= json.links;
  
  //添加节点	
  var node = svg.selectAll(".node")  
      .data(json.nodes)  
      .enter()
	  .append("g")  
      .attr("class", "node")  
      .call(force.drag); 
  
       


    //graph.node = graph.svg.selectAll('.node')
    //    .data(graph.force.nodes())



  
  //添加描述节点的文字
  
//var nodes_text = svg.selectAll(".nodetext")
//      
//      .data(json.nodes)  
//      .enter()
//	  .append("text")  
//      .attr("dx", 10)  
//      .attr("dy", ".85em")  
//      .text(function(d) { return d.name });  



			var text_dx = 12;
			var text_dy = -25;
			
			var nodes_text = svg.selectAll(".nodetext")
								.data(json.nodes)
								.enter()
								.append("text")
								//.style("display","none")//���ؽӵ���Ϣ
								.attr("text-anchor", "middle")//在圆圈中加上数据  
								.attr("class","nodetext")
								//.attr("dx", text_dx) 
								 .attr('x',function(d){
									// console.log(d.name+"---"+ d.name.length);
									var re_en = /[a-zA-Z]+/g;
									//如果是全英文，不换行
									if(d.name.match(re_en)){
										 d3.select(this).append('tspan')
										 .attr('x',0)
										 .attr('y',2)
										 .text(function(){return d.name;});
									}
									//如果小于四个字符，不换行
									else if(d.name.length<=4){
										 d3.select(this).append('tspan')
										.attr('x',0)
										.attr('y',2)
										.text(function(){return d.name;});
									}else{
										var top=d.name.substring(0,4);
										var bot=d.name.substring(4,d.name.length);
							
										d3.select(this).text(function(){return '';});
							
										d3.select(this).append('tspan')
											.attr('x',0)
											.attr('y',-7)
											.text(function(){return top;});
							
										d3.select(this).append('tspan')
											.attr('x',0)
											.attr('y',10)
											.text(function(){return bot;});
											
									} 
									})
		
                                .attr("dy", text_dy)  
								.attr("rank",function(d){
									return d.rank;
								})
								.attr("parent",function(d){
									return d.parent;
								})
								.call(force.drag)
								//.on("click", click)
								
								.text(function(d){
									return d.name;
								})
								//.on("dblclick", function(d,i){
//								  d3.select(this)
//									.style("display","none");
//								
//								});
 
 




 
 
 
 //给节点添加图片
	//node.append("image")
//		.attr("class","image")
//		.attr("width",img_w)//图片宽
//		.attr("height",img_h)//图片高
//		.attr("x",-10)//图片定位
//		.attr("y",-10)
//		.attr("xlink:href",function(d){
//			return d.image;
//		});		
 


//添加节点矩形
//    nodeRect = node.append('rect')
//        .attr('rx', 5)
//        .attr('ry', 5)
//		.attr("x",-25)//定位
//		.attr("y",-25)
//        .attr('stroke', "#A254A2")
//        .attr('fill', "#F6E8E9")
//        .attr('width' , 60)
//        .attr('height', 60)
//    .attr("filter", "url(#blue-glow)")



	
  
						  //添加节点圆圈
						  var node_circle = svg.selectAll("circle") 
							  .data(json.nodes)  
							  .enter()
							  node.append("circle")
						
							  //.attr("r", function(d) { return (d.size) / 10; }) <!--更改节点的大小-->
							  //.style("fill", function(d) { return color(d.group); }) 
					          //.attr("r", function(d) { return d.value; })
					          //.style("stroke", function(d) { return d.type; })
					          //.style("fill", function(d) { return d.level; })
								 
							  //.attr("r", 28)
							  
							  .attr("r",function(d){
								 var r;
								 //根据群的权限的不同设置线条颜色 
								if(d.type=="qun"){
									 r=30;
								 }else{
									 r=25;
								 }
								 return r;
							 })
							  
							  
							  .attr("class","circle")
							  //.attr("filter", "url(#blue-glow)")
							  //.style("stroke", "#A254A2")
							  
							  .style("stroke",function(d){
								 var lineColor;
								 //根据群的权限的不同设置线条颜色 
								if(d.type=="qun"){
									 lineColor="#09F";
								 }else{
									 lineColor="#A254A2";
								 }
								 return lineColor;
							 })
							  
							  .style("stroke-width", 4)
							  
							  //.style("fill", "#F6E8E9")
							  .style("fill",function(d){
								 var fillColor;
								 //根据群的权限的不同设置线条颜色 
								if(d.type=="qun"){
									 fillColor="#9FF";
								 }else{
									 fillColor="#FFC";
								 }
								 return fillColor;
							 })
							  
							  
		                    //  .style("opacity", 0.6)




								
								
								
							   //.on("dblclick", dblclick)

						       .call(force.drag)

                               
							   .on("click",function(d,i){


									//$(".circle").css("display","none")
									
								//nodes_img.style("filter",function(nodes_img){
								//阻止浏览器冒泡事件		
								event=event?event:window.event;
								event.stopPropagation();
							
								$(".circle").removeAttr("filter"); 
								$(".image").removeAttr("filter"); 
								d3.select(this).attr("filter", "url(#blue-glow)")
								
					
									
								})
							   
							   
	
								
							   .on("mouseover",function(d,i){
									
								//鼠标停留圆变大	
								d3.select(this).transition()  
								  .duration(550)  
								  .attr("r", function(d){  //设置圆点半径                        
								   return 32;                            
							   }) ;  	
				
									
								//显示相邻节点上的文字	
								nodes_text.style("opacity", function(o) {
								  return neighboring(d, o) ? 1 : 0.2;
								});
					            //显示相邻节点上的图片
								nodes_img.style("opacity", function(o) {
								  return neighboring(d, o) ? 1 : 0.2;
								});
								//显示相邻节点上的圆	
								node.style("opacity", function(o) {
								  return neighboring(d, o) ? 1 : 0.2;
								});
								
								//文字加粗										
								 nodes_text.style("font-weight","bold")	
								 d3.select(this).style("opacity", 1)							

								//连接线加粗
							    edges_line.style("stroke-width",function(edge){
								//console.log(line);
								if( edge.source == d || edge.target == d ){
									return 3;
								}else{
									return 1;
								}
								})	
									
								//scan_array(d.name);

     							//显示连接线
								edges_line.style("opacity",function(edge){
									if( edge.source != d && edge.target != d ){
										return 0.2;
									}

									if( edge.source == d || edge.target == d ){
										return 1.0;
									}
									});
									
									
								//显示连接线上的文字
								edges_text.style("opacity",function(edge){
									if( edge.source != d && edge.target != d ){
										return 0.2;
									}

									if( edge.source == d || edge.target == d ){
										return 1.0;
									}
									});

								
								 })
								
							
							   .on("mouseout",function(d,i){
								
								//鼠标移除圆变小	
								d3.select(this).transition()  
								  .duration(550)  
								  .attr("r", function(d){  //设置圆点半径                        
								   return 25;                            
							   }) ; 
							   
		                        //所有元素恢复原始状态
								edges_line.style("opacity",function(edge){
									//if( edge.source != d && edge.target != d ){
										//nodes_img.style("display","block");
										return 0.7;
									//}
									});
                                    

    							edges_text.style("opacity",function(edge){
									//if( edge.source === d && edge.target === d ){
										return 0.7;
									//}
								});
								
								node.style("opacity", function(edge) {
								  return 1 ;
								});
								
								nodes_text.style("opacity", function(edge) {
								  return 0.7 ;
								});
					
								nodes_img.style("opacity", function(edge) {
								  return 0.7 ;
								});
					
							
							   // edges_text.style("filter", "url(#)")
								
							});
								
                                  

//                                .on("mouseover",function(d,i){
//                                    d.show = true;
//                                })
//                                .on("mouseout",function(d,i){
//                                    d.show = false;
//                                })
					

                                //.on("dblclick", dblclick)
			
								//.on("click", click);



			var nodes_img = svg.selectAll("image")
								.data(json.nodes)
								.enter()
								//.append("g")
								
								//.style("clip-path","url(#clipPath)");

								.append("image")
								.attr("class","image")
								.attr("id",function(d){
									return d.id;
								})
							//.style("display","none")//���ؽӵ�
								.attr("rank",function(d){
									return d.rank;
								})
								.attr("parent",function(d){
									return d.parent;
								})
								.attr("width",img_w)
								.attr("height",img_h)
							
								.attr("xlink:href",function(d){
									return d.image;
								})
								
								//.on("dblclick", dblclick)

                                .call(force.drag)
								
								//.attr("filter", "url(#blue-glow)")
								
							   .on("dblclick",function(d,i){  		
								  d.fixed = false; 				 
								})

                               .on("click",function(d,i){
									
									

									
											  
							//阻止浏览器冒泡事件		
							event=event?event:window.event;
                            event.stopPropagation();    
							
                            $(".circle").removeAttr("filter"); 
					        $(".image").removeAttr("filter"); 
						    d3.select(this).attr("filter", "url(#blue-glow)")
								
								
							
								
							})
							
							
                           .on("mouseover",function(d,i){
							
							//显示节点上的文字	
							nodes_text.style("opacity", function(o) {
							  return neighboring(d, o) ? 1 : 0.2;
							});
				
							nodes_img.style("opacity", function(o) {
							  return neighboring(d, o) ? 1 : 0.2;
							});
							node.style("opacity", function(o) {
							  return neighboring(d, o) ? 1 : 0.2;
							});
							
							//连接线加粗
							edges_line.style("stroke-width",function(edge){
								//console.log(line);
								if( edge.source == d || edge.target == d ){
									return 3;
								}else{
									return 1;
								}
								})
							   
							//显示连线
							edges_line.style("opacity",function(edge){
									if( edge.source != d && edge.target != d ){
										return 0.2;
									}

									if( edge.source == d || edge.target == d ){
										return 1.0;
									}
									});

                                //显示连线上的文字
								edges_text.style("opacity",function(edge){
									if( edge.source != d && edge.target != d ){
										return 0.2;
									}

									if( edge.source == d || edge.target == d ){
										return 1.0;
									}
									});
							 })
								 
								 
								 
								.on("mouseout",function(d,i){
									
								//所有元素恢复原始状态	
									edges_line.style("opacity",function(edge){
										//if( edge.source != d && edge.target != d ){
											//nodes_img.style("display","block");
											return 0.7;
										//}
										});
								    edges_text.style("opacity",function(edge){
										//if( edge.source === d && edge.target === d ){
											return 0.7;
										//}
									});
									
									node.style("opacity", function(edge) {
									  return 1 ;
									});
									
									nodes_text.style("opacity", function(edge) {
									  return 0.7 ;
									});
						
									nodes_img.style("opacity", function(edge) {
									  return 0.7 ;
									});
									
									
									
									
									
								})
  
//#######################//#######################//#######################//#######################
 
  
  force.on("tick", function() {  //对于每一个时间间隔
   //实时更新连线坐标

				 edges_line.attr("x1",function(d){ return d.source.x; });
				 edges_line.attr("y1",function(d){ return d.source.y; });
				 edges_line.attr("x2",function(d){ return d.target.x; });
				 edges_line.attr("y2",function(d){ return d.target.y; });


  				 //���������������ֵ�λ��
			     //edges_text.attr("x",function(d){ return (d.source.x + d.target.x) / 2-20 ; });
			     //edges_text.attr("y",function(d){ return (d.source.y + d.target.y) / 2 ; });
			   
				 
		
				//限制结点的边界
		
				json.nodes.forEach(function(d,i){  
				  d.x = d.x - img_w/2 < 0     ? img_w/2 : d.x ;  
				  d.x = d.x + img_w/2 > width ? width - img_w/2 : d.x ;  
				  d.y = d.y - img_h/2 < 0      ? img_h/2 : d.y ;  
				  d.y = d.y + img_h/2 > height ? height - img_h/2 : d.y ; 
				  //d.y = d.y + img_h/2 + text_dy > height ? height - img_h/2 - text_dy : d.y ; 
				});  
  
  
  
				 nodes_text.attr("x",function(d){ return d.x ;});
				 nodes_text.attr("y",function(d){ return d.y + img_w/2; });
  
  
//                 //是否绘制连接线上的文字
//                 edges_text.style("fill-opacity",function(d){
//                    return d.source.show || d.target.show ? 1.0 : 0.0 ;
//                 });
				 
				 
				 
				  edges_line.attr('d', function(d) { 
					  var path='M '+d.source.x+' '+d.source.y+' L '+ d.target.x +' '+d.target.y;
					  return path;
					  })
				
					
					  
					    
    
                   //连线文字位置变换
				  edges_text.attr('transform',function(d,i){
						if (d.target.x<d.source.x){
							bbox = this.getBBox();
							rx = bbox.x+bbox.width/2;
							ry = bbox.y+bbox.height/2;
							return 'rotate(180 '+rx+' '+ry+')';
						}
						else {
							return 'rotate(0)';
						}
				   });
                	   


		 
				 
				 
				 //���½��ͼƬ������
				nodes_img.attr("transform",function(d){
					return "translate("+(d.x - img_w/2)+","+(d.y - img_h/2)+")"
				});
				 //nodes_img.attr("x",function(d){ return d.x - img_w/2; });
				 //nodes_img.attr("y",function(d){ return d.y - img_h/2; });
  
  
    node.attr("transform", function(d){return "translate(" + d.x + "," + d.y + ")";})     
	  //鼠标双击搜索当前节点
        //.on("dblclick",function(d,i){  
//		    document.getElementById("serach").value= d.name  ; 
//				refer();
//           				 
//                })  
		//鼠标双击解除节点固定		
	   .on("dblclick",function(d,i){  		
			  d.fixed = false; 				 
			}) 

		
		
		//鼠标移入显示悬浮窗信息
		.on("mouseover",function(d,i){ 
		  	
		 var  divObj=document.getElementById("info");
			  divObj.style.display="block";//显示 
			  divObj.style.left=d.x+30+"px";  
			  divObj.style.top=d.y+10+"px";  
			  //divObj.innerHTML="基金名称："+d.name+d.name.length;
			  
		if(d.type=="qq"&&d.image=="qq.png")	{  
			  if(d.gender==0||d.gender=="男")	{
				  d.gender="男";
				  } else if(d.gender==1||d.gender=="女"){
					  d.gender="女";
				  }else{d.gender="未知";}
                  divObj.innerHTML="qq号:"+d.name+"<br>"+"昵称:"+d.nick+"<br>"+"年龄:"+d.age+"<br>"+"性别:"+d.gender; 
		  }else if(d.image=="qq.png"){
		         divObj.innerHTML="名称:"+d.name+"<br>"+d.regit+"<br>"+d.seal+"<br>"+d.validity+"<br>"+d.agency; 
		  }
		  
		//  regit":"'.$regit2.'","seal":"'.$seal2.'","image":"qq.png","validity":"'.$validity2.'","agency":"'.$agency2
		  
		  
		  
			//var fruit =0;	
//			var obj = document.getElementsByName("fruit");
//			for(var i=0; i<obj.length; i ++){
//				if(obj[i].checked){
//				   fruit= obj[i].value;	
//				}
//			}
//			  if(fruit== 5){
//				divObj.innerHTML="qq号:"+d.name+"<br>"+"昵称:"+d.nick+"<br>"+"年龄:"+d.age+"<br>"+"性别:"+d.gender;  
//			  }else{
//				  divObj.innerHTML="名称:"+d.name+"<br>"+d.group+"<br>"+d.size+"<br>"+d.rank+"<br>"+d.parent;
//				  }
//			  
//			  
//			  //divObj.innerHTML="基金名称："+links.d.target+d.source+d.linerank+d.lineparent+d.relation;
//			  
//			  
//			  //divObj.innerHTML="基金名称："+d.lineparent;
//
//			  //{"target":'.$source.',"source":'.$target1.',"linerank":"2","lineparent":"同学", "relation":"同学" },'
//			  //d.target+d.source+d.linerank+d.lineparent+d.relation 
//			 // alert(test);
			
			else{
//				 var json = [				
//					{"name":"20600001"},
//					{"name":"20890457"}			
//				]  

         $.getJSON("quninfo1.json",function(data){
						 
			 //var data = eval(data);
			 //alert(data[0].name);
			  for(var i=0; i<data.length; i++)  
			  {  

			  // alert(data[i].name);
			     if(d.name==data[i].name){
					 //alert(1); 
			 var  divObj=document.getElementById("info");
				  divObj.style.display="block";//显示 
				  divObj.style.left=d.x+30+"px";  
				  divObj.style.top=d.y+10+"px";  
					  
				  divObj.innerHTML="群号:"+data[i].name+"<br>"+"人数:"+data[i].mastqq+"<br>"+"创建日期:"+data[i].createdate+"<br>"+"群介绍:"+data[i].title;			 
				 
			   }  
			  }
           });

	     }
			}) 
			
			
		//鼠标移出信息消失 	
		.on("mouseout",function(d,i){          
		     //alert (d.name);
			
		  var divObj=document.getElementById("info");
		      divObj.style.display="none";//隐藏	
			 
		})  	
			
        .call(force.drag);  //绑定一个行为允许交互式拖动
   
  });  
  
  
  
 ////////////去除独立节点 
  dataset=json.links; 
   function removesingle() {

    var c = [];
    var b = svg.selectAll(".node").filter(function(f) {
      
	   var e = dataset.filter(function(d) {
			
            return (d.target == f||d.source == f)
			
			
			
        });
        if (e.length == 1) {
            c.push(e[0]);
            return true
        }
    });
	var d = svg.selectAll(".image").filter(function(f) {
		//alert(1);
        var e = dataset.filter(function(d) {
			
            return (d.target == f||d.source == f)
        });
        if (e.length == 1) {
            c.push(e[0]);
            return true
        } 
    });
	var g = svg.selectAll(".nodetext").filter(function(f) {
		//alert(1);
        var e = dataset.filter(function(d) {
			
            return (d.target == f||d.source == f)
			
        });
	
		//scan_array(e);	
        if (e.length == 1) {
            c.push(e[0]);
            return true
        } 
    });
    var a = svg.selectAll(".edgepath")
	    .data(dataset).filter(function(d) {
			
		//alert(c.indexOf(d));
        return c.indexOf(d) != -1;
    });
	
 	
	//alert(a)
    b.remove();
	d.remove();
	g.remove();
    a.remove();
    force.start();
	
			
	//b.style("opacity",0); 
//	d.style("opacity",0);
//	g.style("opacity",0);
//	a.style("opacity",0);
//	h.style("opacity",0);
	//force.start(); 
//	flag=!flag;
//     }	 
//	 else{	 
//    b.style("opacity",1); 
//	d.style("opacity",1);
//	g.style("opacity",1);
//	a.style("opacity",1);
//	h.style("opacity",1);
//    force.start();
//    flag=!flag; 	 
//		 }

}

var flag = false;
$('#single').click( function() {
     if(flag) {
           window.location.reload();
           return false;
     }
     removesingle();
     flag=!flag; 
 })
 
 
 
 
////////////显示昵称 
function shownick() {
    nodea = svg.selectAll(".node").filter(function(a) {
        return a.type == "qq"
    });
    nodea.append("foreignObject").attr("width", "25%").attr("height", "50%").attr("x", -20).attr("y", 5).append("xhtml:div").html(function(f) {
        if (f.type == "qq") {
            var e = dataset.filter(function(d) {
                return d.target == f
            });
            var c = [];
            e.forEach(function(d) {
                c.push(d.nick)
            });
            var b = d3.set(c);
            var a = "";
            b.forEach(function(d) {
                a ="<font size='2' face='Microsoft YaHei' color='green'>"+a+d+"<font/>"+"<br/>"
            });
            return a
        }
    });
    force.start()
}

$('#shownick').click( function() { 
  shownick();
 })
 
 

////////////隐藏昵称 
function removenick() {
    txtnode = svg.selectAll(function() {
        return this.getElementsByTagName("foreignObject")
    });
    txtnode.remove();
    force.start()
};
 
$('#removenick').click( function() { 
 removenick();
})


$('#update').click( function() { 
 window.location.reload();
})
 
});  
  

 
//#######################//#######################//#######################
 


//#######################	  
//显示源节点
		  function showRoot() {

			 	svg.select("image")				
								   .style("display","block");
			    svg.select(".nodetext")
								   .style("display","block");
			}
		
		
//@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
//鼠标双击隐藏子节点
		  function dblclick (d){
			if(d.rank==1){
				if(flag){
				
				 svg.selectAll("image")				
								   .style("display","block");
				 svg.selectAll(".nodetext")
								   .style("display","block");
				 svg.selectAll(".edgepath")
									.style("display","block");
				 svg.selectAll(".linetext")
									.style("display","block");
				 svg.selectAll("circle")
					                .style("display","block");								
				flag=!flag;
				}else if(!flag){
				
				 svg.selectAll("image[rank='"+(parseInt(d.rank)+1)+"']")				
								   .style("display","none");
				 svg.selectAll("image[rank='"+(parseInt(d.rank)+2)+"']")				
								   .style("display","none");
				 svg.selectAll(".nodetext[rank='"+(parseInt(d.rank)+1)+"']")
					                .style("display","none");
				 svg.selectAll(".nodetext[rank='"+(parseInt(d.rank)+2)+"']")
					                .style("display","none");
				 svg.selectAll(".linetext")
					                .style("display","none");
				 svg.selectAll(".edgepath")
					                .style("display","none");
				 svg.selectAll("circle")
					                .style("display","none");
				


				flag=!flag; 
				}
			

			}else if(d.rank!=1){
				if(flag1){
			svg.selectAll("image[rank='"+(parseInt(d.rank)+1)+"']")
				
			                   .style("display","block");
			svg.selectAll(".nodetext[rank='"+(parseInt(d.rank)+1)+"']")
					                .style("display","block");
			svg.selectAll(".edgepath")
					                .style("display","block");
			 
			svg.selectAll(".linetext")
					                .style("display","block");
							   
			svg.selectAll("circle")
					                .style("display","block");
									
			   flag1=!flag1;						
			  }else if(!flag1){
			  
			  svg.selectAll("image[rank='"+(parseInt(d.rank)+1)+"']")				
								   .style("display","none");
			  svg.selectAll(".nodetext[rank='"+(parseInt(d.rank)+1)+"']")
					                .style("display","none");
			 
			  svg.selectAll(".edgepath")
					                .style("display","none");
			 
			  svg.selectAll(".linetext")
					                .style("display","none");
									
									
			  svg.selectAll("circle")
					                .style("display","none");					
				flag1=!flag1;
			  }
			
			
			}
		  }
		  
		  
		  
//#######################	更新  

		  function update() {
           // nodes_text.push({'name': 'xxx'});
           // edges_data.push({'source': +1, 'target': nodes_data.length - 1});

            svg.selectAll("line")
			   .exit()
			   .remove();

            nodes.exit().remove();

            force.start();
        }
  					
 //******************************************************************************************************	
 //****************************************************************************************************** 


//拖拽开始后设定被拖拽对象为固定 
  var drag =force.drag()  
            .on("dragstart",function(d,i){  
              d3.event.sourceEvent.cancelBubble = true;  
              d.fixed = true;     
            });  
  
  
//缩放函数
  function zoomed () {  
        svg.attr("transform",   
          "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");  
      } ;
	    


//将所有节点固定
function setforce(flag){
    this.force.nodes().forEach(function(d, i) {
        d.fixed = flag;
    });
};	
//动态停止 切换	
var sf=1;		
$( "#button" ).click(function(){
	sf++;
	if(sf%2==0){
		$("#b_css").attr("class","ui-icon ui-icon-pause");
		setforce(true);
	}else{
		$("#b_css").attr("class","ui-icon ui-icon-play");
		setforce(false);
	}	
	});
		
		
		
//设置连接线的坐标,使用椭圆弧路径段双向编码
function linkArc(d) {
    //var dx = d.target.x - d.source.x,
  // dy = d.target.y - d.source.y,
     // dr = Math.sqrt(dx * dx + dy * dy);
  //return "M" + d.source.x + "," + d.source.y + "A" + dr + "," + dr + " 0 0,1 " + d.target.x + "," + d.target.y;
  //打点path格式是：Msource.x,source.yArr00,1target.x,target.y  
  
  return 'M '+d.source.x+' '+d.source.y+' L '+ d.target.x +' '+d.target.y
}
//设置圆圈和文字的坐标
function transform1(d) {
  return "translate(" + d.x + "," + d.y + ")";
}
function transform2(d) {
      return "translate(" + (d.x) + "," + d.y + ")";
}		
		
		
		
	
      // node.each(function(d) {
//        var node  = d3.select(this),
//            rect  = node.select('rect'),
//            lines = wrap(d.name),
//            ddy   = 1.1,
//            dy    = -ddy * lines.length / 2 + .5;
//
//        lines.forEach(function(line) {
//            var text = node.append('text')
//                .text(line)
//                .attr('dy', dy + 'em');
//            dy += ddy;
//        });
//    });	
	

		
		
// 遍历数组
function scan_array(arr) {
for(var key in arr) { // 这个是关键
if(typeof(arr[key]) == 'array' || typeof(arr[key]) == 'object') {// 递归调用
scan_array(arr[key]);
} else {
document.write(key + ' = ' + arr[key] + '<br>');
}
}
}

function successionPrint(str,num) {
    num = parseInt(num);
    var return_str = '';
    for (var i = 1; i<=num; i++) {
        return_str +=str;
    }
    
    return return_str;
}

function __debug(param, flag) {
    if (!param || typeof(param) == 'number' || typeof(param) == 'string') {
            return param;
    }
    var t = typeof(param) + '(\n';
    
    flag = flag ? parseInt(flag) + 1 : 1;
    for(var key in param) {
        if(typeof(param[key]) == 'array' || typeof(param[key]) == 'object') {
            var t_tmp = key + ' = ' + __debug(param[key],flag);
            t += successionPrint('\t', flag) + t_tmp + '\n';
        } else {
                var t_tmp = key + ' = ' + param[key];
                t += successionPrint('\t', flag) + t_tmp + '\n';
            }
        }

    t = t + successionPrint('\t', flag-1) + ')';

    return t;
}

function _debug(param) {
    alert(__debug(param));
}






//##################################################################

function getCookie(name)
{
var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
if(arr=document.cookie.match(reg))
return unescape(arr[2]);
else
return null;
}

//兼容手机端代码
//(function (doc, win) {
//        var docEl = doc.documentElement,
//            resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
//            recalc = function () {
//                var clientWidth = docEl.clientWidth;
//                if (!clientWidth) return;
//                if(clientWidth>=640){
//                    docEl.style.fontSize = '100px';
//                }else{									
//                    docEl.style.fontSize = 100 * (clientWidth / 400) + 'px';                      					
//                }
//            };
//
//        if (!doc.addEventListener) return;
//        win.addEventListener(resizeEvt, recalc, false);
//        doc.addEventListener('DOMContentLoaded', recalc, false);
//    })(document, window);
//if(window.screen.width<650){
//	var checkbox=document.getElementsByClassName("checkbox");
//	var button=document.getElementsByTagName("button");
//	document.getElementsByClassName("notice")[0].style.fontSize=25+ 'px';
//	document.getElementsByClassName("label")[0].style.fontSize=25+ 'px';
//	document.getElementById("serach").style.fontSize=25+ 'px';
//	
//	for(i=0;i<button.length;i++)
//	{
//	 button[i].style.width=145+'px';
//	 button[i].style.height=35+'px';
//	 button[i].style.fontSize=20+'px';
//	}
//	document.getElementById("button").style.width=55+ 'px';
//	document.getElementById("button").style.height=35+ 'px';
//	document.getElementById("submit").style.width=65+ 'px';
//	document.getElementById("submit").style.height=35+ 'px';
//	document.getElementById("submit").style.fontSize=20+ 'px';
//	for(i=0;i<checkbox.length;i++)
//	{
//	 checkbox[i].style.width=25+'px';
//	 checkbox[i].style.height=25+'px';
//	}
//}
</script>   
     
<!--     
//##################################################################
//##################################################################-->
 
 <script type="text/javascript">

//$(function(){
//
//    document.onclick = function(){
//	alert(1);
//
//    };
//})

//$(document).on('click',  function() {
//
//})
//鼠标单击空白地方恢复初始状态
 $(function($) {
           $('body').click( function() {  
		   
    	 $(".circle").removeAttr("filter"); 
		 $(".image").removeAttr("filter"); 
         $(".edgepath").css('stroke-width', 1);
 
            });  
  });

 
 



 
</script>   
     
   <!--  <iframe src="http://192.168.1.35/d3js/json.php" style="border:none;width:100%;height:1000px;" /> -->
    </body>  

</html>    