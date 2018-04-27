//圈选
//技术笔记 控制toolbar用on(".zoom",null),开启用.call
var shiftKey;
d3.select("body").attr("tabindex", 1).on("keydown.brush", keyflip).on("keyup.brush", keyflip).each(function() { this.focus(); });
var nodetool={
    nodeselect:function(flag,s,us,flag2){//flag shift按键true释放按键，false按下中，s实体选定时调用 us取消选定调用
        if(!this.entitystate.isselect || flag2){
            if(flag){
                nodetool.alllinknormal();
                nodetool.allnodenormal();
            }
            nodeStyleMap.select.call(this.view);
            this.entitystate.isselect=true;
            nodetool.linkselect.call(this);
            s.call(this);
        }else{
            nodeStyleMap.hover.call(this.view);
            this.entitystate.isselect=false;
            if(flag){
                nodetool.alllinknormal();
                nodetool.allnodenormal();
            }else{
                nodetool.linkselect.call(this);
            }
            us.call(this);
        }
        return this;
    },
    linkselect:function(){
        this.aboutlink.forEach(function(i,d){
            if(d.source.entitystate.isselect && d.target.entitystate.isselect){
                linkStyleMap.select.call(d.view);
            }else{linkStyleMap.normal.call(d.view);}
        });
    },
    alllinkselect:function(){
        linkmap.forEach(function(i,d){
            if(d.source.entitystate.isselect && d.target.entitystate.isselect){
                linkStyleMap.select.call(d.view);
            }else{linkStyleMap.normal.call(d.view);}
        });
    },
    nodelinks:function(flag){
        if(flag){
            nodetool.alllinknormal();
            nodetool.allnodenormal();
        }
        this.aboutnode.forEach(function(i,d){nodeStyleMap.select.call(d.view);d.entitystate.isselect=true;});
        this.aboutlink.forEach(function(i,d){linkStyleMap.select.call(d.view);});
    },
    alllinknormal:function(){
        graph_show.link.attr("class","linknormal");
    },
    allnodenormal:function(){
        nodemap.forEach(function(i,d){
            nodeStyleMap.normal.call(d.view);
            d.entitystate.isselect=false;
        });
    }
};
function boxSelect(){
    this.init=function(con){
        this.box=con.svg_F.insert("g",":first-child")
            .datum(function() { return {selected: false, previouslySelected: false}; })
            .attr("class", "brush");
    };
};
boxSelect.prototype.openUp=function(){
    this.box.call(d3.svg.brush()
        .x(d3.scale.identity().domain([0, 3000]))
        .y(d3.scale.identity().domain([0, 3000]))
        .on("brushstart", function(d) {
            graph_show.node.each(function(d) { d.entitystate.previouslySelected = shiftKey && d.entitystate.isselect; });
        })
        .on("brush", function() {
            var extent = d3.event.target.extent();//获取区域坐标
            var gzt=toolbar.graph.zoom_.translate();//获取缩放偏移量
            var gzs=toolbar.graph.zoom_.scale();//获取缩放比例
            extent[0][0]-=gzt[0];extent[0][0]/=gzs;//进行偏移量的计算
            extent[1][0]-=gzt[0];extent[1][0]/=gzs;
            extent[0][1]-=gzt[1];extent[0][1]/=gzs;
            extent[1][1]-=gzt[1];extent[1][1]/=gzs;
            graph_show.node.each(function(d){
                d.entitystate.isselect = d.entitystate.previouslySelected ^ (extent[0][0] <= d.x && d.x < extent[1][0] && extent[0][1] <= d.y && d.y < extent[1][1]);
                nodetool.linkselect.call(d);
                if(d.entitystate.isselect){nodeStyleMap.select.call(this);}else{nodeStyleMap.normal.call(this);}
            });
        })
        .on("brushend", function() {
            d3.event.target.clear();
            d3.select(this).call(d3.event.target);
        }));};
boxSelect.prototype.turnOff=function(){this.box.on(".brush",null);};
function keyflip() {
    shiftKey = d3.event.shiftKey || d3.event.metaKey;
};
//图标添加
function iconinsert(){
    this.turnUp=function(){this.box.style("visibility","visible");};
    this.turnOff=function(){this.box.style("visibility","hidden");};
    this.init=function(con){
        var isinflag=true;//是否光标处于选取框体区域
        var xbox=this.box=con.svg_F.append("svg:g").attr("transform","translate(0,25)").on("mouseenter",function(){toolbar.zoomturnOff();}).on("mouseleave",function(){toolbar.zoomopenUp();}).style("visibility","hidden");
        var xbox_rect=this.box.append("rect").attr("x1",0).attr("y1",0).attr("x2",10).attr("y2",10).attr("width",90).attr("height",140).style({"stroke": "#999","stroke-opacity":1,"stroke-width":1,"fill":"#FFF"});
        //添加图标
        var imgxy=[10,10];
        var icon_f=this.box.selectAll(".iconnode").data(icon_list).enter().append("svg:g").attr("transform",function(d,i){
            //i!=0 && (imgxy)
            if(i%2==0){
                imgxy[1]=i*20+10;
                imgxy[0]=50;
            }else{imgxy[0]=10;}
            return "translate("+imgxy[0]+","+imgxy[1]+")";
        });
        icon_f.append("svg:image").attr("xlink:href",function(d){return d.url;}).attr("width",32).attr("height",32);
        icon_f.on("mousedown",function(d){
            var po=d3.mouse(xbox.node());
            temp_node.attr("transform","translate("+(po[0]-16)+","+(po[1]-16)+")").style("visibility","visible").select("image").attr("xlink:href",function(){return d.url;});
            //alert(d3.mouse(xbox.node()));
            con.svg_F.on("mousemove.icondarg",function(){var po0=d3.mouse(xbox.node());temp_node.attr("transform","translate("+(po0[0]-16)+","+(po0[1]-16)+")");})
                .on("mouseup.icondarg",function(){
                    con.svg_F.on("mousemove.icondarg",null)
                        .on("mouseup.icondarg",null);
                    var po0=d3.mouse(xbox.node());
                    temp_node.style("visibility","hidden");
                    if(po0[0]<90 && po0[1]<140){}else{
                        //添加实体代码
                        var newtemp=Math.floor(Math.random()*10000000);
                        var cnn=d3.mouse(con.svg_F.node());//alert(con.gtts());
                        con.addNode(fixNode({id:"n"+newtemp,img:{"url":d.url,"width":16,"height":16},"title":"n"+newtemp,"propn":1,"prop":[{"title":"name","value":"n"+newtemp,type:0}],"propvalue":{},fixed:true,x:(cnn[0]-con.gttf()[0])/con.gtts(),y:(cnn[1]-con.gttf()[1])/con.gtts()}));
                        //alert(toolbar.linkedit.gtf);
                        if(toolbar.linkedit.gtf()){
                            linkinsert.bind(con).call(d3.select(nodemap.get("n"+newtemp).view));
                        }
                        //alert();
                        //console.log(nodemap.get("n"+newtemp));
                    }});
        });
        var temp_node=this.box.append("svg:g").style("visibility","hidden");
        temp_node.append("svg:image").attr("xlink:href","img/boy.png").attr("width",32).attr("height",32);

    };
};
function linkinsert(){
    var temp_link;
    var temp_con;
    var tf=false;
    this.gtf=function(){return tf;}
    this.init=function(con){
        temp_con=con;//alert(graph_show.templink);
        //graph_show.node.on(".drag",null);
        //temp_link=graph_show.templink.append("svg:g").style("visibility","hidden");
        //temp_link.append("svg:path").attr("d","M0,0L0,0").style({"stroke": "#f00","stroke-opacity":1,"stroke-width":1,"fill":"none"});
    };
    this.turnUp=function(){
        linkinsert.bind(temp_con).call(graph_show.node);
        tf=true;
    };
    this.turnOff=function(){
        graph_show.node.call(temp_con.drag).on(".ld",null);
        tf=false;
    };
};
linkinsert.bind=function(temp_con){
    return function(){

        this.on(".drag",null)
            .on("mouseenter.ld",function(){toolbar.graph.turnOffzoom();})
            .on("mouseleave.ld",function(){toolbar.graph.openUpzoom();})
            .on("mousedown.ld",function(dx){

                graph_show.templink.link_s[0]=d3.mouse(graph_show.templink.node());
                graph_show.templink.style("visibility","visible");
                temp_con.svg_F.on("mousemove.ld",function(){
                    graph_show.templink.link_s[1]=d3.mouse(graph_show.templink.node());
                    graph_show.templink.select("path").attr("d","M"+(graph_show.templink.link_s[0][0])+","+graph_show.templink.link_s[0][1]+"L"+graph_show.templink.link_s[1][0]+","+graph_show.templink.link_s[1][1]);
                });
                temp_con.svg_F.on("mouseup.ld",function(){
                    graph_show.templink.select("path").attr("d","M0,0L0,0");
                    temp_con.svg_F.on(".ld",null);
                });
                graph_show.node.on("mouseup.ld",function(d){
                    if(dx.id!=d.id){
                        var tlobj={
                            id:""+dx.id+"_$$_"+d.id+"_!!_s",
                            linkstr:[dx.id+"_$$_"+d.id,d.id+"_$$_"+dx.id],
                            linktype:"s",
                            source:dx.id,
                            target:d.id,
                            arrow:{},
                            event:{"click":function(d){alert(d.prop)},
                                "dblclick":function(d){}
                            },
                            style:"",
                            propn:1,
                            proprow:2,
                            prop:[{"title":"type","value":"0","type":0}],
                            propvalue:{linknum:0},

                            propstyle:{"font-size":12,"fill":"#999"},
                            propview:[],
                            path:"",
                            linkpos:0,
                            sy:0
                        };/*{
                         id:dx.id+"_$$_"+d.id+"_!!_s",
                         linkstr:[dx.id+"_$$_"+d.id,d.id+"_$$_"+dx.id],
                         linktype:"s",
                         source:dx.id,
                         target:d.id,
                         arrow:{},
                         event:{"click":function(d){},
                         "dblclick":function(d){}
                         },
                         style:"",
                         propn:1,
                         proprow:2,
                         prop:[{"title":"type","value":"a0","type":0}],
                         propvalue:{linknum:0},
                         propstyle:{"font-size":12,"fill":"#999"},
                         propview:[],
                         path:"",
                         linkpos:0,
                         sy:0
                         };*/

                        //console.log(tlobj);
                        temp_con.addLink(tlobj);}
                    graph_show.node.on("mouseup.ld",null);
                });
            });
    }
};
var toolbar={
    init:function(d){toolbar.graph=d;toolbar.selectbox.init(d);toolbar.iconedit.init(d);toolbar.linkedit.init(d);},
    selectbox: new boxSelect(),
    noderound: false,
    brushopenUp: function(){toolbar.graph.turnOffzoom();toolbar.selectbox.openUp();},
    brushturnOff: function(){toolbar.selectbox.turnOff();},
    zoomopenUp: function(){toolbar.selectbox.turnOff();toolbar.graph.openUpzoom();},
    zoomturnOff: function(){toolbar.graph.turnOffzoom();},
    noderoundopenUp:function(){toolbar.noderound=true;},
    noderoundturnOff:function(){toolbar.noderound=false;},
    inverseSelect:function(){toolbar.graph.inverseSelect();},
    setForce:function(flag){toolbar.graph.setforce(flag);},
    hideSelect:function(flag){toolbar.graph.hideSelect(flag);toolbar.graph.reload(graph_show);},
    delHider:function(){toolbar.graph.delHide();},
    hideFreeNode:function(){toolbar.graph.hideFreeNode();toolbar.graph.reload(graph_show);},
    showAll:function(){toolbar.graph.unhideAll();toolbar.graph.reload(graph_show);},
    linkFilter:function(area,flag){toolbar.graph.linkFilter(area,flag);toolbar.graph.reload(graph_show);},
    linkAttrFilter:function(fun,fun1,fun2,flag){toolbar.graph.linkAttrFilter(fun,fun1,fun2,flag);toolbar.hideFreeNode();toolbar.graph.reload(graph_show);},
    iconedit:new iconinsert(),
    linkedit:new linkinsert(),
    editopenUp:function(){toolbar.iconedit.turnUp();toolbar.linkedit.turnUp();},
    editturnOff:function(){toolbar.iconedit.turnOff();toolbar.linkedit.turnOff();}
};
var nodeStyleMap={
    normal:function(){d3.select(this).attr("class","node nodenormal");},
    hover:function(){d3.select(this).attr("class","node nodeover");},
    select:function(){d3.select(this).attr("class","node nodeselect");},
};
var linkStyleMap={
    normal:function(){d3.select(this).attr("class","linknormal");},
    hover:function(){d3.select(this).attr("class","linkover");},
    select:function(){d3.select(this).attr("class","linkselect");},
}