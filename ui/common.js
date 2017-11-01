try{
    var mySwiper = new Swiper ('.swiper-container', {
    	autoHeight: false, 
	    autoplay:3000,
		speed:1000,
		autoplayDisableOnInteraction : true,
		loop:true,
		centeredSlides : true,
		slidesPerView:2,
        pagination : '.swiper-pagination',
		paginationClickable:true,
		prevButton:'.swiper-button-prev',
        nextButton:'.swiper-button-next',
		onInit:function(swiper){
			swiper.slides[2].className="swiper-slide swiper-slide-active";//第一次打开不要动画
			},
        breakpoints: {  
                668: {
                    slidesPerView: 1,
                 }
            }
	  }) 	
} catch(e){
	alert(e)
}
     

$(function(){
	$('#m-cate-icon').on('click', function(){
		if($('.m-cate-drop').hasClass('hide'))
			$('.m-cate-drop').removeClass('hide');
		else
			$('.m-cate-drop').addClass('hide');
	});
	$('#m-packup').on('click', function(event){
		$('.m-cate-drop').addClass('hide');
		event.stopPropagation(); 
	});
	$('.m-cate-drop').on('click', function(event){
		$('.m-cate-drop').addClass('hide');
	});
	$('.m-cate-drop li a').on('click', function(event){
		event.stopPropagation(); 
	});

	$('.m-main-cate ul li').on('click', function(){
		$('.m-main-cate ul li').removeClass('current-menu-item');
		$(this).addClass('current-menu-item');
	});


	if(history.length<=1){
		$('.m-back').addClass('home')
		$('.m-back img').removeClass('hide');
	}
	
	$('#dropcate').mouseover(function(){
        $('.drop').addClass('open');
    })
    
    $('#dropcate').click(function(){
        $('.drop').addClass('open');
    })

    if(window.localStorage){
    	judge();
    }
	
});

var toast = function(text,sec){
	var div = document.createElement('div');
	div.id = 'toast';
	div.innerHTML = text;
	$(div).appendTo(document.body);
	setTimeout(function(){
		$(div).remove();
	},sec?sec:2500)
}

var timeFormat = function (time, parrent) {
    var data = new Date(time);
    var cal = function(fmt) {
        var o = {
            "M+": data.getMonth() + 1, //月份
            "d+": data.getDate(), //日
            "h+": data.getHours(), //小时
            "m+": data.getMinutes(), //分
            "s+": data.getSeconds(), //秒
            "q+": Math.floor((data.getMonth() + 3) / 3), //季度
            "S": data.getMilliseconds() //毫秒
        };
        if (/(y+)/.test(fmt)) {
            fmt = fmt.replace(RegExp.$1, (data.getFullYear() + "").substr(4 - RegExp.$1.length));
        }
        for (var k in o) {
            if (new RegExp("(" + k + ")").test(fmt)) {
                fmt = fmt.replace(RegExp.$1, (RegExp.$1.length === 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            }
        }
        return fmt;
    };
    return cal(parrent);
}

var judge = function(){
	var storage=window.localStorage;
	var current = timeFormat((new Date()).getTime(), 'yyyy-MM-dd hh:mm:ss');
	var latestTime = 0;
	if(storage.getItem("latestTime")){
		latestTime = storage.getItem("latestTime");
		storage.setItem("latestTime", current);
		tips(latestTime,current);
	} else {
		storage.setItem("latestTime", current);
	}
}

var tips = function(latestTime, current){
	var dis = (new Date(current).getTime() - new Date(latestTime).getTime())/1000/60;
	if(dis>=60*2){
		$.ajax({
	        type:"get",
	        url:"http://996shop.com/?json=get_missed&time="+latestTime,
	        dataType:"json",
	        success:function(res){
	            toast("亲，距您上次来逛半刀网，我们已经新增了 <span style='color: #ff5f5f;'><b>"+res.count+"</b></span> 件商品, 赶紧看看都错过了什么！", 6000);
	        }
	    }); 
	}	
}


//====================for single page===================//
$(function(){
    $(document).on('click','#tuwenLink',function(){
        if($('#tuwenContent').find('img').length == 0){
           $('#tuwenLoading').show();

            var itemId = $(this).attr('itemId');
            $.ajax({
                type:"get",
                url:"http://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.1/?&data={%22item_num_id%22:%22"+itemId+"%22}&type=jsonp&_=1502351053740",/*url写异域的请求地址*/
                dataType:"jsonp",
                success:function(res){
                    $('#tuwenLoading').hide();
                    var pages = res.data.images;
                    $.each(pages, function(k,v){
                        $('<img src='+v+' class="tuwenImg"/>').appendTo($('#tuwenContent'));
                    });
                }
            }); 
        }
        
    });
    
});
function getShortUrl(url){
    var request = "http://api.ft12.com/api.php?format=jsonp&url="+ encodeURIComponent(url);
    var ret = '';
    $.ajax({
        type:"get",
        url: request,
        dataType:"jsonp",
        success:function(response){
            if (response.error == 0){
                ret = response.url;
            } else {
                ret = '';
            }
            var text = $('#tkl2').val();
            var array = text.split('】');
            array[array.length-1] = ret;
            $('#tkl2').val(array.join('】'));
        }
    }); 
}

var showKL = false;
var openApp = function(url) {
    var appUrl = url.replace("http://", "").replace("https://", "");
    var ifr = document.createElement('iframe');
    ifr.src = 'taobao://' + appUrl;
    ifr.style.display = 'none';
    document.body.appendChild(ifr);
    window.location = url;
};
var openAppIos9 = function(url) {
    var appUrl = url.replace("http://", "").replace("https://", ""),
        newUrl = 'taobao://' + appUrl;
    window.location = newUrl;
    window.setTimeout(function () {
        window.location = url;
    }, 3000);
};
function jumpToTaobao(is_weixin,taobaoUrl){
    if(is_weixin == 'true'){
        $('#kouling').removeClass('hide');
        showKL = true;
        var clipboard = new Clipboard('.btn1');
        clipboard.on('success', function(e) {
            toast("复制成功，快打开' 淘宝 'APP去领券吧！");
        });
    }else {
        $("body").html("<center style='margin-top: 10px;'>唤醒手机淘宝中...</center>");

        var ua = navigator.userAgent.toLowerCase();
        if (ua.match(/iphone os 9/i) == "iphone os 9") {
            openAppIos9(taobaoUrl);
        } else {
            openApp(taobaoUrl);
        }
        // window.open();
    
    }

}

function shareWeixin(coupon_click_url,url){
    if(coupon_click_url != ''){
        getShortUrl(url);
    }
    $('#share').removeClass('hide');
    showKL = true;
    var clipboard = new Clipboard('.btn2');
    clipboard.on('success', function(e) {
        toast("内容已经复制成功，去分享吧！");
    });
}

function shareWeibo(img, content) {
    (function (s, d, e) {
        
        var f = 'http://v.t.sina.com.cn/share/share.php?', 
        u = d.location.href, 
        p = ['url=', e(u), '&title=', e(content), '&appkey=3994075567', '&pic=', e(img)].join('');

        function a() {
            if (!window.open([f, p].join(''), 'mb', ['toolbar=0,status=0,resizable=1,width=620,height=450,left=', (s.width - 620) / 2, ',top=', (s.height - 450) / 2].join('')))u.href = [f, p].join('');
        };
        if (/Firefox/.test(navigator.userAgent)) {
            setTimeout(a, 0)
        } else {
            a()
        }
    })(screen, document, encodeURIComponent);
}

$('document').on('click', '.kouling', function(e){
    var $target  = $(e.target);
    if(!$target.is(".kouling")){
        $('.kouling').addClass('hide');
        showKL = false;
    }
    
});

$(document).on('touchmove',function(e){
    if(showKL)
        e.preventDefault();
})


//====================for single page end===================//

