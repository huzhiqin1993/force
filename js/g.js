
//可视化变量
var graph_show={};
var nodecontrol=[d3.map(),d3.map()];//操作实体集合，非操作实体集合
//封装拓扑
function tvd(graph,graph_show,width,height,tb){
    this.graph=graph;
    this.width=width;
    this.height=height;
    this.force=d3.layout.force()
        .gravity(.03)//.03
        .charge(-120)//-720
        .linkDistance(100)//230 100
        .linkStrength(.1)
        .size([width, height]);
    var ttf,tts;
    this.gttf=function(){return ttf;};
    this.gtts=function(){return tts;};

    this.drag=this.force.drag().on("dragstart",function(d) {d3.event.sourceEvent.stopPropagation();d.isdrag=d.isdrag2=d.x+d.y;}).on("drag",function(d,i){d.isdrag2=d.x+d.y;}).on("dragend",function(d,i){});
    function zoom(){ttf=d3.event.translate;tts=d3.event.scale;if(tts<=0.65){graph_show.link.selectAll(".linknormal .link").style({stroke: "#333"});}else{graph_show.link.selectAll(".linknormal .link").style({stroke: "#999"});};svg.attr("transform", "translate(" + ttf + ")scale(" + tts + ")");	};//需要提出
    this.zoom_=d3.behavior.zoom().center([width / 2, height / 2]).scaleExtent([0.1, 8]).on("zoom", zoom);//创建缩放功能
    this.svg_F=d3.select("#continue").append("svg")
        .attr("width", "100%")
        .attr("height", "100%")
        //.attr("viewBox", "0 0 " + width + " " + height)
        .call(this.zoom_)//添加缩放
        .on("dblclick.zoom",null);//取消缩放双击事件
    var svg=this.svg=this.svg_F.append("g");
    tb.init(this);
    this.force
        .nodes(this.graph.nodes)
        .links(this.graph.links)
    ;
    //初始化可视化对象
    graph_show.link=this.svg.append("svg:g").selectAll(".link");
    //初始化临时链接
    this.temp_link=graph_show.templink=this.svg.append("svg:g").style("visibility","hidden");
    graph_show.templink.append("svg:path").attr("d","M0,0L0,0").style({"stroke": "#f00","stroke-opacity":1,"stroke-width":1,"fill":"none"});
    graph_show.templink.link_s=new Array();
    graph_show.node=this.svg.append("svg:g").selectAll(".node");
    //转为内部函数
    this.reload(graph_show);
    this.initNode();
    this.startTick=function(){
        this.force.on("tick", t);
    };
    this.stopTick=function(){
        this.force.on("tick", null);
    };
    function t() {
        graph_show.link.attr("transform", function(d) {
            d.angle=getAngle(d.source.x,d.source.y,d.target.x,d.target.y);//获取链接线角度
            d.dis=getDistance(d.source.x,d.source.y,d.target.x,d.target.y);//获取长度
            d.xtype=d.source.x-d.target.x;//获取链接位置值
            return "translate(" + (d.source.x+d.target.x)/2 + "," + (d.source.y+d.target.y)/2 + ")"+"rotate("+d.angle+")";
        }).selectAll(".link").attr("d",function(d){
            //加入链接长度缩进
            var rd=d.flink.source.rad(d.flink.angle);
            rd[0]+=5;rd[1]+=5;
            return "M "+((d.flink.dis/-2))+","+(d.linkpos*-40)+"L"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2))+",0L "+(((d.flink.dis-((d.linkpos==0)?0:100))/2))+",0 L"+((d.flink.dis/2))+","+(d.linkpos*-40);
            if(d.flink.xtype>=0){
                return "M "+((d.flink.dis/-2)+rd[1])+","+(d.linkpos*-40)+"L"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2)+rd[1])+",0L"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2)+rd[1]+10)+",-2M"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2)+rd[1]+10)+",2L"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2)+rd[1])+",0L "+(((d.flink.dis-((d.linkpos==0)?0:100))/2)-rd[0])+",0 L"+((d.flink.dis/2)-rd[0])+","+(d.linkpos*-40);//+" M"+(d.flink.dis/4)+",0L"+(d.flink.dis/4)+",20"; 起点->多链接折点->2次折点->终点
            }else{
                return "M "+((d.flink.dis/-2)+rd[1])+","+(d.linkpos*-40)+"L"+(((d.flink.dis-((d.linkpos==0)?0:100))/-2)+rd[1])+",0L"+(((d.flink.dis-((d.linkpos==0)?0:100))/ 2)-rd[0])+",0L"+(((d.flink.dis-((d.linkpos==0)?0:100))/2)-rd[0]-10)+",-2M"+(((d.flink.dis-((d.linkpos==0)?0:100))/2)-rd[0]-10)+",2L"+(((d.flink.dis-((d.linkpos==0)?0:100))/2)-rd[0])+",0L"+((d.flink.dis/2)-rd[0])+","+(d.linkpos*-40);//+" M"+(d.flink.dis/-4)+",0L"+(d.flink.dis/-4)+",20";
            };
        });
        graph_show.link.select(".linkbox").attr("transform",function(d){return d.linknum==1?"rotate("+(-d.angle)+",0,0)":""; });
        graph_show.node.attr("transform", function(d) {
            return "translate(" + (d.x-d.img.width/2) + "," + (d.y-d.sy) + ")";
        });
    };
    //启动力导引擎
    //this.startForce=function(){this.force.start()};
    //获取稳定后的实体边界值自适应缩放值
    this.getLimit=function(){};
};
tvd.prototype.turnOffzoom=function(){this.svg_F.on(".zoom",null);};
tvd.prototype.openUpzoom=function(){this.svg_F.call(this.zoom_).on("dblclick.zoom",null);};
tvd.prototype.reload=function(graph_show){
    //链接alert(this.graph.links.length);

    graph_show.link=graph_show.link.data(this.graph.links,function(d){return d.id;});
    var l=graph_show.link.enter().append("svg:g").classed("linknormal",true).each(function(d){
        d.view=this;
        d3.select(this).selectAll("path").data(d.linklist).enter().append("path").attr("transform",function(d){return "translate(0,"+(d.linkpos*40)+")";}).attr("class", "link");
    });
    //连接属性
    var lg=l.selectAll(".linkbox").data(function(d){return d.linklist}).enter().append("svg:g")
            .attr("class","linkbox")
            .attr("transform",function(d){return "translate(0,"+(d.linkpos*40)+")";})
            .each(function(d){
                d3.select(this).on("click",function(dx){d.event.click.call(this,d);});
                ;})
        ;//连接属性
    lg.append("path")
        .attr("class", "linkbg")
        .attr("d",function(d){return d.path;});
    //linkmap change error this

    lg.each(function(d){
        d3.select(this).selectAll(".prop").data(d.propview).enter().append("svg:text")
            .attr("font-size", "12px")
            .text(function(dz) { return dz.value; })
            .attr("dx",function(dz){return dz.x;})
            .attr("dy",function(dz){return dz.ty;})
        ;
    });//初始化链接属性
    graph_show.link.exit().remove();
    //更新实体可视化数据集
    graph_show.node=graph_show.node.data(this.graph.nodes,function(d){return d.id});
    var g=graph_show.node.enter().append("svg:g").each(function(d){d.view=this;})
            .attr("class", "node nodenormal")
            .call(this.drag)
            .on("click",function(d){
                if(d.isdrag!=d.isdrag2){return;}//判断是否被拖拽
                nodetool.nodeselect.call(d,!shiftKey,function(){
                    if(toolbar.noderound)nodetool.nodelinks.call(this,false);
                },function(){});
                if(d.event.click){d.event.click.call(this,d);};
            })
            .on("dblclick",function(d){if(d.event.dblclick)d.event.dblclick.call(this,d);})
            .on("mouseover",function(d){if(!d.entitystate.isselect){nodeStyleMap.hover.call(this);}})
            .on("mouseout",function(d){if(!d.entitystate.isselect){nodeStyleMap.normal.call(this);}})
        ;
    //作用实体提示
    g.append("path")
        .attr("fill", "white")
        .attr("d",function(d){return d.path;})
        .attr("class","propbgpath")
        .attr("style", "stroke-width:0");
    //
    g.append("svg:image")
        .attr("xlink:href", function(d){return d.img.url;})
        .attr("width", function(d){return d.img.width;})
        .attr("height", function(d){return d.img.height;});

    g.each(function(d){
        //加入属性
        d3.select(this).selectAll(".prop").data(d.propview).enter().append("svg:text")
            .attr("font-size", "12px")
            .text(function(dz) { return dz.value; })
            .attr("dx",function(dz){return dz.x;})
            .attr("dy",function(dz){return dz.ty;});
    });
    g.append("title")
        .text(function(d) { return d.name; });
    graph_show.node.exit().remove();
    this.force.start();
};
//初始化实体排列
tvd.prototype.initNode=function(){
    //力导初始化位置分配
    var h=Math.round(Math.sqrt(this.force.nodes().length));
    this.force.nodes().forEach(function(d, i) {
        d.x=(width / 2 + (i%h*70))-(h*70)/2;
        d.y=(height / 2 + (i%(h+1)*70))-((h+1)*70)/2;
    });
    //可视化控件初始化位置分配
    graph_show.node.attr("transform", function(d,i){return "translate(" + (width / 2 + (i%h*70)-(h*70)/2) + "," + (height / 2 + (i%(h+1)*70)-((h+1)*70)/2) + ")";});//初始化实体位置
};
//缩放切换动画
tvd.prototype.layoutflash=function(funstart,funin,funend){
    var svgself=this;
    svgself.svg.transition().duration(500).call(this.zoom_.translate([this.width*-9/2,this.height*-9/2]).scale(10).event).style("opacity", 0).each("end",function(){//切换布局动画使用变焦掩盖
        (function(){this.svg.transition().duration(500).call(this.zoom_.translate([this.width/2-((this.width/2)*1),this.height/2-((this.height/2)*1)]).scale(1).event).style("opacity", 1).each("start",funin).each("end",funend);}).call(svgself);
    }).each("start",funstart);
};
//实体力导控制
tvd.prototype.setforce=function(flag){
    this.force.nodes().forEach(function(d, i) {
        d.fixed = flag;
    });
};
//重置缩放
tvd.prototype.resetZoom=function(){
    this.svg.transition().duration(500).call(this.zoom_.translate([0,0]).scale(1).event).style("opacity", 1);
};
tvd.prototype.setSize=function(w,h){
    this.force.size([w,h]);
};
tvd.prototype.addNode=function(obj){
    this.graph.nodes.push(obj);//同步数据
    nodemap.set(obj.id,obj);//同步map
    this.reload(graph_show);
};
tvd.prototype.delNode=function(objid){
    //先删除链接
    var nodeobj=nodemap.get(objid);
    if(!nodeobj){return;}
    var tempobj=this;
    nodeobj.aboutlink.forEach(function(i,d){
        tempobj.delLink(i);
    });
    nodeobj.aboutlink.empty();
    //最终删除本体
    if(this.graph.nodes.indexOf(nodeobj)>=0){
        this.graph.nodes.splice(this.graph.nodes.indexOf(nodeobj), 1);//从内部数组删除
    }
    nodemap.remove(objid);//从map中删除
};
tvd.hideNode=tvd.prototype.hideNode=function(obj){
    //先隐藏相关链接
    var nodeobj=typeof obj =="object" ? obj : nodemap.get(obj);
    if(!nodeobj){return;}
    var tempobj=this;
    if(!isFreeNode.call(nodeobj)){
        nodeobj.aboutlink.forEach(function(i,d){
            tempobj.hideLink(d);
        });}
    //隐藏实体
    if(this.graph.nodes.indexOf(nodeobj)>=0){
        this.graph.nodes.splice(this.graph.nodes.indexOf(nodeobj), 1);//从内部数组删除
    }
    nodeobj.entitystate.state=2;
};
tvd.unhideNode=tvd.prototype.unhideNode=function(obj,flag){
    var objnode=typeof obj=='object' ? obj : nodemap.get(obj);
    if(!objnode){return;}
    objnode.entitystate.state=0;
    var tempobj=this;
    this.graph.nodes.push(objnode);
    if(flag){
        objnode.aboutlink.forEach(function(d,i){
            tempobj.unhideLink(d);
        });
    };
};
tvd.prototype.addLink=function(obj1){

    //linkmap.set(obj.id,obj);//同步map

    var obj=fixLink(obj1);
    //记录实体间的连接状态
    var tempidstr=(function(){if(linkmap.has(this.linkstr[0])){return this.linkstr[0];}else if(linkmap.has(this.linkstr[1])){return this.linkstr[1]}else{return "";}}).call(obj);
    if(tempidstr!=""){
        //存在
        var n=linkmap.get(tempidstr).linknum;
        obj.linkpos=n;
        linkmap.get(tempidstr).linknum=(n+(n<0?-1:0))*-1;
        linkmap.get(tempidstr).linklist.push(obj);
        obj.flink=linkmap.get(tempidstr);
    }else{
        //不存在
        obj.linkpos=0;
        linkmap.set(obj.linkstr[0],{
            id:obj.source.id+"_$$_"+obj.target.id,
            source:obj.source,//元实体
            target:obj.target,//目标实体
            defultstyle:{"font-size":12,"fill":"#999"},
            linklist:[obj],
            linknum:1,
            state:0
        });
        obj.flink=linkmap.get(obj.linkstr[0]);
        //建立实体关联
        obj.source.aboutnode.set(obj.target.id,obj.target);
        obj.target.aboutnode.set(obj.source.id,obj.source);
        //建立链接关联
        obj.source.aboutlink.set(obj.linkstr[0],linkmap.get(obj.linkstr[0]));
        obj.target.aboutlink.set(obj.linkstr[0],linkmap.get(obj.linkstr[0]));
    };
    this.graph.links.push(linkmap.get(obj.linkstr[0]));
    this.reload(graph_show);
};
tvd.delLink=tvd.prototype.delLink=function(objid){//彻底删除链接
    //删除相关链接
    var linkobj=typeof objid=='object' ? objid :linkmap.get(objid);
    if(!linkobj){return;}
    if(this.graph.links.indexOf(linkobj)>=0){
        this.graph.links.splice(this.graph.links.indexOf(linkobj), 1);//从内部数组删除
    }
    linkobj.source.aboutlink.remove(linkobj.id);
    linkobj.target.aboutlink.remove(linkobj.id);
    //删除相关实体引用
    linkobj.source.aboutnode.remove(linkobj.target.id);
    linkobj.target.aboutnode.remove(linkobj.source.id);
    linkmap.remove(linkobj.id);//从map中删除
};
tvd.hideLink=tvd.prototype.hideLink=function(linkobj){
    var obj=typeof linkobj=='object' ? linkobj : linkmap.get(linkobj);
    if(!obj || this.graph.links.indexOf(obj)<0){return;}
    this.graph.links.splice(this.graph.links.indexOf(obj), 1);//从内部数组删除
    obj.state=2;
};
tvd.unhideLink=tvd.prototype.unhideLink=function(obj,flag){//flag如果链接的相关实体处于隐藏状态，则自动展现实体
    var objlink=typeof obj=='object' ? obj : linkmap.get(obj);
    if(!objlink){return;}
    if(flag){
        if(objlink.source.entitystate.state==2){this.unhideNode(objlink.source);}
        if(objlink.target.entitystate.state==2){this.unhideNode(objlink.target);}
    };
    objlink.state=0;
    this.graph.links.push(objlink);
};
tvd.prototype.inverseSelect=function(){//反选元素
    graph_show.node.each(function(d){
        if(!d.entitystate.isselect){
            d3.select(this).attr("class","node nodeselect");
            d.entitystate.isselect=1;
        }else{
            d3.select(this).attr("class","node nodenormal");
            d.entitystate.isselect=0;
        }
    });
    nodetool.alllinkselect();
};
//动画测试
tvd.prototype.flashtest=function (){
    graph_show.node.transition().attr("transform",function(d){ return "translate("+(d.x+300)+","+(d.y+300)+")";}).each("end",function(d){d.x=d.px=d.x+300;d.y=d.py=d.y+300;}).delay(750);
};
tvd.prototype.getSelectNode=function(flag){
    return flag?d3.selectAll(nodemap.values()).filter(function(){if(this.entitystate.isselect)return this;}):d3.selectAll(nodemap.values()).filter(function(){if(this.entitystate.isselect)return this;})[0];
};
tvd.prototype.getSelectLink=function(){
    return d3.selectAll(linkmap.values()).filter(function(){if(this.source.entitystate.isselect && this.target.entitystate.isselect)return this;})[0];
};
//获取隐藏的实体
tvd.prototype.getHideNode=function(flag){
    return flag?d3.selectAll(nodemap.values()).filter(function(){if(this.entitystate.state==2)return this;}):d3.selectAll(nodemap.values()).filter(function(){if(this.entitystate.state==2)return this;})[0];
};
//获取隐藏的链接
tvd.prototype.getHideLink=function(flag){
    return flag?d3.selectAll(linkmap.values()).filter(function(){if(this.state==2)return this;}):d3.selectAll(linkmap.values()).filter(function(){if(this.state==2)return this;})[0];
};
//更新实体链接状态
tvd.prototype.refGraph=function(){
    //state 0 正常显示中  1预设显示 2隐藏中 4预设隐藏 6预设删除
    var tempobj=this;
    //隐藏删除预设链接
    d3.selectAll(linkmap.values()).each(function(d,i){if(this.state==4){
        tempobj.hideLink(this);
    }else if(this.state==6){
        tempobj.delLink(this.id);
    }
    });
    //隐藏删除预设实体
    d3.selectAll(nodemap.values()).each(function(d,i){if(this.entitystate.state==4){
        tempobj.hideNode(this);
    }else if(this.entitystate.state==6){
        tempobj.delNode(this.id);
    }
    });
    d3.selectAll(nodemap.values()).each(function(d,i){if(this.entitystate.state==1){
        tempobj.unhideNode(this);
    }
    });
    d3.selectAll(linkmap.values()).each(function(d,i){if(this.state==1){
        tempobj.unhideLink(this);
    }
    });
};
//隐藏选定
tvd.prototype.hideSelect=function(flag){
    if(flag){
        d3.selectAll(this.graph.nodes).each(function(d,i){
            if(!this.entitystate.isselect && this.entitystate.state==0){this.entitystate.state=4;}
        });
    }else{
        this.getSelectNode(true).each(function(d,i){
            this.entitystate.state=4;
        });
    }
    this.refGraph();
};
tvd.prototype.unhideAll=function(){
    d3.selectAll(nodemap.values()).each(function(d,i){
        if(this.entitystate.state==2){
            this.entitystate.state=1;
        }
    });
    d3.selectAll(linkmap.values()).each(function(d,i){
        if(this.state==2){
            this.state=1;
        }
    });
    this.refGraph();
};
//链接过滤，被过滤掉的链接将被隐藏,游离实体也会被隐藏
tvd.prototype.linkFilter=function(lm,flag){//链接条数区域
    d3.selectAll(linkmap.values()).each(function(d,i){
        if((!flag || (this.source.aboutlink.values().length==1 || this.target.aboutlink.values().length==1)) && this.state==0){
            if(lm[1]<lm[0] && this.linklist.length<lm[0]){
                this.state=4;
            }else if(lm[1]>lm[0] && (this.linklist.length<lm[0] || this.linklist.length>lm[1])){
                this.state=4;
            }else if(lm[1]==lm[0] && this.linklist.length!=lm[0]){
                this.state=4;
            }
        }
    });
    this.refGraph();
};
//隐藏游离实体
tvd.prototype.hideFreeNode=function(){
    d3.selectAll(nodemap.values()).each(function(d,i){
        if(isFreeNode.call(this)){this.entitystate.state=4}
    });
    this.refGraph();
};
tvd.prototype.delHide=function(){
    var tempobj=this;
    d3.selectAll(linkmap.values()).each(function(d,i){
        if(this.state==2){
            tempobj.delLink(this.id);
        }
    });
    d3.selectAll(nodemap.values()).each(function(d,i){
        if(this.entitystate.state==2){
            tempobj.delNode(this.id);
        }
    });
};
tvd.prototype.linkAttrFilter_=function(fun,flag,flag1){//fun过滤函数，flag true显示符合条件的，false隐藏符合条件的,flag1 true 只过滤终端实体链接
    d3.selectAll(linkmap.values()).each(function(){
        if((!flag1 || (this.source.aboutlink.values().length==1 || this.target.aboutlink.values().length==1)) && this.state==0){
            if(!(flag ^ !fun(this.linklist))){
                this.state=4;
            }
        }
    });
    this.refGraph();
};
tvd.prototype.linkAttrFilter=function(fun,fun1,fun2,flag1){//fun过滤函数，flag true显示符合条件的，false隐藏符合条件的,flag1 true 只过滤终端实体链接
    var tempobj=this;
    nodetool.alllinknormal();
    nodetool.allnodenormal();
    d3.selectAll(linkmap.values()).each(function(){
        if((!flag1 || (this.source.aboutlink.values().length==1 || this.target.aboutlink.values().length==1)) && this.state==0){
            if(fun(this.linklist)){
                fun1?fun1.call(tempobj,this):0;
            }else{
                fun2?fun2.call(tempobj,this):0;
            }
        }
    });
};
//基于力道实现的可视化布局，群及布局显示
tvd.prototype.setLayout=function(){//辨认链接布局类型
    tvd.nodeXtype();
    d3.selectAll(linkmap.values()).each(function(){
        if(this.state==0){
            //记录链接关系类型 2末端链接 3中枢链接 5次级中枢链接
            if(this.source.xt==2 || this.target.xt==2){
                this.linkDistance=100;//100末端实体设置较小的链接距离
            }else if((this.source.xt*this.target.xt)==21){//当该链接是连接集群实体和中枢实体时进行此设置
                //(this.source.xt==3 || this.target.xt==3)&&(this.source.xt!=2 || this.target.xt!=2)
                this.linkDistance=750;//750群集实体，中枢实体进行远距离设置
            }else if(((this.source.xt*this.target.xt)%3)==0 || ((this.source.xt*this.target.xt)%5)==0){
                this.linkDistance=700;//700当链接链接了群集实体或者次级群及实体
            }else{
                this.linkDistance=150;//
            }
        }
    });
    this.force.linkDistance(function(d){return d.linkDistance;}).start();
};
tvd.nodeXtype=tvd.prototype.nodeXtype=function(){//辨认实体布局类型
    //记录末端实体，以及生成对于群及实体的二次分类依据（群及实体、次级群集实体）
    d3.selectAll(nodemap.values()).each(function(d,i){
        if(this.entitystate.state==0){
            //记录实体关系类型 2末端实体 3集群实体 5次级集群实体 7中枢实体 11次级中枢实体
            if(this.aboutlink.values().length==1){//当该实体只有一个相关实体时，
                this.xt=2;//标记末端实体
                this.aboutnode.values()[0].txt?(this.aboutnode.values()[0].txt+=1):(this.aboutnode.values()[0].txt=1);//该值为群及实体判断依据,记录群集实体所连接的末端实体个数
            }
        }
    });
    //记录群集实体，根据415-424行生成的txt属性进行实体分类
    d3.selectAll(nodemap.values()).each(function(d,i){
        if(this.entitystate.state==0){
            //记录实体关系类型 2末端实体 3集群实体 5次级集群实体 7中枢实体 11次级中枢实体
            if(this.txt>=10){//相连接的末端实体超过10个(包括10个)
                this.xt=3;//标记为群及实体
                //标记集群实体所连接的中枢实体
                d3.selectAll(this.aboutnode.values()).each(function(d,i){
                    if(!this.xt){this.xt=7;};//将该实体记录为中枢实体
                });
            }else if(this.txt<=10 && this.txt>=1 ){
                this.xt=5;//记录为次级群及实体
                d3.selectAll(this.aboutnode.values()).each(function(d,i){
                    if(!this.xt){this.xt=11;};//记录为次级中枢实体
                });
            }
        }
    });
};
tvd.linkSelect=function(obj){
    var objlink=typeof obj=='object' ? obj : linkmap.get(obj);
    nodetool.nodeselect.call(objlink.target,false,function(){},function(){},true);
    nodetool.nodeselect.call(objlink.source,false,function(){},function(){},true);
};
tvd.STAY=function(){};
function isFreeNode(flag){//判断是否是游离实体，flag true 基于可视化数据判断，false基于元数据判断
    var isflag=true;
    if(flag){
        if(this.aboutlink.values().length==0){
            isflag=true;
        }else{
            isflag=false;
        }
    }else{
        this.aboutlink.forEach(function(i,d){
            if(d.state==0){
                isflag=false;
            }
        });
    }
    return isflag;
};
function getDistance(x1,y1,x2,y2){
    return Math.sqrt((x2-x1)*(x2-x1)+(y2-y1)*(y2-y1));
};
/*
 tvd.testx=function(){
 d3.selectAll(nodemap.values()).filter(function(){
 if(this.entitystate.state==0){
 var tempobj=this,flag=0;

 d3.selectAll(this.aboutnode.values()).each(function(){if(this.entitystate.state==0 && (this.propvalue.index>tempobj.propvalue.index)){flag=1;}});
 if(!flag){
 return 1;}
 }
 }).each(function(){x.hideNode(this);});}
 */