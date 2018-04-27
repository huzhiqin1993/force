/* spig.js */
//右键菜单

var isindex = true;
var visitor = true;

jQuery(document).ready(function ($) {
    $("#spig").mousedown(function (e) {
        if(e.which==3){
        showMessage("秘密通道:<br /><a style='color:blue;font-size:14px;' href=\"http://192.168.1.35/index.php\" title=\"管理系统\">管理系统</a> <span style='color:blue;font-size:14px;cursor:pointer;' onClick=closed();>隐藏人物</span>",10000);
}
});
$("#spig").bind("contextmenu", function(e) {
    return false;
});
});

//鼠标在消息上时
jQuery(document).ready(function ($) {
    $("#message").hover(function () {
       $("#message").fadeTo("100", 1);
     }); 
});

function closed(){
	$("#spig").css("display","none");
	}



//鼠标在上方时
jQuery(document).ready(function ($) {
    //$(".mumu").jrumble({rangeX: 2,rangeY: 2,rangeRot: 1});
    $(".mumu").mouseover(function () {
       $(".mumu").fadeTo("300", 0.3);
       msgs = ["我隐身了，你看不到我", "我会隐身哦！嘿嘿！","把手拿开我才出来！"];
       var i = Math.floor(Math.random() * msgs.length);
        showMessage(msgs[i]);
    });
    $(".mumu").mouseout(function () {
        $(".mumu").fadeTo("300", 1)
    });
});

//开始
jQuery(document).ready(function ($) {
    if (isindex) { //如果是主页
        var now = (new Date()).getHours();
        if (now > 0 && now <= 6) {
            showMessage( ' 你是夜猫子呀？还不睡觉，明天起的来么你？', 6000);
        } else if (now > 6 && now <= 9) {
            showMessage( ' 早上好，早起的鸟儿有虫吃噢！早起的虫儿被鸟吃，你是鸟儿还是虫儿？嘻嘻！', 6000);
        } else if (now > 12 && now <= 13) {
            showMessage( ' 中午了，吃饭了么？不要饿着了，饿死了谁来逗我玩呀！', 6000);
        } else if (now > 17 && now <= 18) {
            showMessage( ' 马上就要下班了，一天过得真快啊！', 6000);
        } else {
            showMessage( ' hi！欢迎使用QQ群关系可视化查询系统', 6000);
        }
    }
    else {
        showMessage('欢迎' + visitor + '来到代码笔记《' + title + '》', 6000);
    }
    $(".spig").animate({
        top: $(".spig").offset().top + 300,
        left: document.body.offsetWidth - 160
    },
	{
	    queue: false,
	    duration: 1000
	});
});

//鼠标在某些元素上方时
jQuery(document).ready(function ($) {
	
	
	 $('#contianer img').mouseover(function () {
        showMessage('点击图片可以跳转到公司主页哦！');
    });
   
});


//无聊讲点什么
jQuery(document).ready(function ($) {

    window.setInterval(function () {
        msgs = ["<iframe name=\"xidie\" src=\"http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=2\"frameborder=\“0\” scrolling=\"no\" height=\"50px\"  width=\"300px\" allowtransparency=\"true\" ></iframe>", "陪我聊天吧！","搜索完了要点击数据刷新按钮哦！", "我身上还有哪些好玩的东西你没发现？右键试试！","鼠标右键可以将我隐藏！", "我可爱吧！嘻嘻!~^_^!~~","从前有座山，山上有座庙，庙里有个老和尚给小和尚讲故事，讲：“从前有座……”"];
        var i = Math.floor(Math.random() * msgs.length);
        showMessage(msgs[i], 10000);
    }, 25000);
});

//无聊动动
//jQuery(document).ready(function ($) {
//    window.setInterval(function () {
//        msgs = ["<iframe name=\"xidie\" src=\"http://i.tianqi.com/index.php?c=code&id=12&icon=1&num=2\"frameborder=\“0\” scrolling=\"no\" height=\"50px\"  width=\"300px\" allowtransparency=\"true\" ></iframe>", "乾坤大挪移！", "我飘过来了！~", "搜索完了要点击数据刷新按钮哦！", "我身上还有哪些好玩的东西你没发现？右键试试！","鼠标双击可以将我关掉！", "我飘过去了", "我得意地飘！~飘！~"];
//        var i = Math.floor(Math.random() * msgs.length);
//        s = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6,0.7,0.75,-0.1, -0.2, -0.3, -0.4, -0.5, -0.6,-0.7,-0.75];
//        var i1 = Math.floor(Math.random() * s.length);
//        var i2 = Math.floor(Math.random() * s.length);
//            $(".spig").animate({
//            left: document.body.offsetWidth/2*(1+s[i1]),
//            top:  document.body.offsetHeight/2*(1+s[i1])
//        },
//			{
//			    duration: 2000,
//			    complete: showMessage(msgs[i])
//			});
//    }, 25000);
//});

//评论资料
jQuery(document).ready(function ($) {
    $("#author").click(function () {
        showMessage("留下你的尊姓大名！");
        $(".spig").animate({
            top: $("#author").offset().top - 70,
            left: $("#author").offset().left - 170
        },
		{
		    queue: false,
		    duration: 1000
		});
    });
    $("#email").click(function () {
        showMessage("留下你的邮箱，不然就是无头像人士了！");
        $(".spig").animate({
            top: $("#email").offset().top - 70,
            left: $("#email").offset().left - 170
        },
		{
		    queue: false,
		    duration: 1000
		});
    });
    $("#url").click(function () {

        showMessage("快快告诉我你的家在哪里，好让我去参观参观！");
        $(".spig").animate({
            top: $("#url").offset().top - 70,
            left: $("#url").offset().left - 170
        },
		{
		    queue: false,
		    duration: 1000
		});
    });
    $("#comment").click(function () {
        showMessage("认真填写哦！不然会被认作垃圾评论的！我的乖乖~");
        $(".spig").animate({
            top: $("#comment").offset().top - 70,
            left: $("#comment").offset().left - 170
        },
		{
		    queue: false,
		    duration: 1000
		});
    });
});

var spig_top = 50;
//滚动条移动
jQuery(document).ready(function ($) {
    var f = $(".spig").offset().top;
    $(window).scroll(function () {
        $(".spig").animate({
            top: $(window).scrollTop() + f +300
        },
		{
		    queue: false,
		    duration: 1000
		});
    });
});

//鼠标点击时
jQuery(document).ready(function ($) {
    var stat_click = 0;
	//var ismove = false;
    $(".mumu").click(function () {
        if (!ismove) {
            stat_click++;
            if (stat_click > 4) {
                msgs = ["你有完没完呀？", "你已经摸我" + stat_click + "次了", "非礼呀！救命！OH，My ladygaga"];
                var i = Math.floor(Math.random() * msgs.length);
                //showMessage(msgs[i]);
            } else {
                msgs = ["筋斗云！~我飞！", "我跑呀跑呀跑！~~", "别摸我，大男人，有什么好摸的！", "惹不起你，我还躲不起你么？", "不要摸我了，我会告诉老婆来打你的！", "干嘛动我呀！小心我咬你！"];
                var i = Math.floor(Math.random() * msgs.length);
                //showMessage(msgs[i]);
            }
        s = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6,0.7,0.75,-0.1, -0.2, -0.3, -0.4, -0.5, -0.6,-0.7,-0.75];
        var i1 = Math.floor(Math.random() * s.length);
        var i2 = Math.floor(Math.random() * s.length);
            $(".spig").animate({
            left: document.body.offsetWidth/2*(1+s[i1]),
            top:  document.body.offsetHeight/2*(1+s[i1])
            },
			{
			    duration: 500,
			    complete: showMessage(msgs[i])
			});
        } else {
            ismove = false;
        }
    });
});
//显示消息函数 
function showMessage(a, b) {
    if (b == null) b = 10000;
    jQuery("#message").hide().stop();
    jQuery("#message").html(a);
    jQuery("#message").fadeIn();
    jQuery("#message").fadeTo("1", 1);
    jQuery("#message").fadeOut(b);
};

//拖动
var _move = false;
var ismove = false; //移动标记
var _x, _y; //鼠标离控件左上角的相对位置
jQuery(document).ready(function ($) {
    $("#spig").mousedown(function (e) {
        _move = true;
        _x = e.pageX - parseInt($("#spig").css("left"));
        _y = e.pageY - parseInt($("#spig").css("top"));
     });
    $(document).mousemove(function (e) {
        if (_move) {
            var x = e.pageX - _x; 
            var y = e.pageY - _y;
            var wx = $(window).width() - $('#spig').width();
            var dy = $(document).height() - $('#spig').height();
            if(x >= 0 && x <= wx && y > 0 && y <= dy) {
                $("#spig").css({
                    top: y,
                    left: x
                }); //控件新位置
            ismove = true;
            }
        }
    }).mouseup(function () {
        _move = false;
    });
});