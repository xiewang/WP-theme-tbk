$(function(){
    $(".find_nav_list").css("left",sessionStorage.left+"px");
    $(".find_nav_list li").each(function(){
        if($(this).find("a").text()==sessionStorage.pagecount){
            $(".sideline").css({left:$(this).position().left});
            $(".sideline").css({width:$(this).outerWidth()});
            $(this).addClass("current-cat").siblings().removeClass("current-cat");
            navName(sessionStorage.pagecount);
            return false
        }
        else{
            $(".sideline").css({left:0});
            $(".find_nav_list li").eq(0).addClass("current-cat").siblings().removeClass("current-cat");
        }
    });
    var nav_w=$(".find_nav_list li").first().width();
    $(".sideline").width(nav_w);
    $(".find_nav_list li").on('click', function(){
        nav_w=$(this).width();
        $(".sideline").stop(true);
        $(".sideline").animate({left:$(this).position().left},300);
        $(".sideline").animate({width:nav_w});
        $(this).addClass("current-cat").siblings().removeClass("current-cat");
        var fn_w = ($(".find_nav").width() - nav_w) / 2;
        var fnl_l;
        var fnl_x = parseInt($(this).position().left);
        if (fnl_x <= fn_w) {
            fnl_l = 0;
        } else if (fn_w - fnl_x <= flb_w - fl_w) {
            fnl_l = flb_w - fl_w;
        } else {
            fnl_l = fn_w - fnl_x;
        }
        $(".find_nav_list").animate({
            "left" : fnl_l
        }, 300);
        sessionStorage.left=fnl_l;
        var c_nav=$(this).find("a").text();
        navName(c_nav);
    });
    var fl_w=$(".find_nav_list").width();
    var flb_w=$(".find_nav_left").width();
    $(".find_nav_list").on('touchstart', function (e) {
        var touch1 = e.originalEvent.targetTouches[0];
        x1 = touch1.pageX;
        y1 = touch1.pageY;
        ty_left = parseInt($(this).css("left"));
    });
    $(".find_nav_list").on('touchmove', function (e) {
        var touch2 = e.originalEvent.targetTouches[0];
        var x2 = touch2.pageX;
        var y2 = touch2.pageY;
        if(ty_left + x2 - x1>=0){
            $(this).css("left", 0);
        }else if(ty_left + x2 - x1<=flb_w-fl_w){
            $(this).css("left", flb_w-fl_w);
        }else{
            $(this).css("left", ty_left + x2 - x1);
        }
        if(Math.abs(y2-y1)>0){
            e.preventDefault();
        }
    });
});
function navName(c_nav) {
    switch (c_nav) {
        case "男装男鞋":
            sessionStorage.pagecount = "男装男鞋";
            break;
        case "女装女鞋":
            sessionStorage.pagecount = "女装女鞋";
            break;
        case "包包配饰":
            sessionStorage.pagecount = "包包配饰";
            break;
        case "运动户外":
            sessionStorage.pagecount = "运动户外";
            break;
        case "美妆彩妆":
            sessionStorage.pagecount = "美妆彩妆";
            break;
        case "童装母婴":
            sessionStorage.pagecount = "童装母婴";
            break;
        case "零食茶饮":
            sessionStorage.pagecount = "零食茶饮";
            break;
        case "内衣情趣":
            sessionStorage.pagecount = "内衣情趣";
            break;
        case "数码家电":
            sessionStorage.pagecount = "数码家电";
            break;
		case "居家生活":
            sessionStorage.pagecount = "居家生活";
            break;
		case "汽车用品":
            sessionStorage.pagecount = "汽车用品";
            break;
    }
}