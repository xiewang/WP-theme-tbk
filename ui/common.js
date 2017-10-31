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
//====================for single page end===================//

