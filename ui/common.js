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
	
	// $('.box-img img').each(function() {
	// 	var the = $(this);
 //        var img = new Image();
 //        img.src = $(this)[0].src;
         
 //        if(img.complete) {
 //        	setTimeout(function(){
 //        		the.prev().addClass('hide');
 //            	the.removeClass('hide');
 //        	},300);
 //        } else {
 //            $(this).load(function(){
 //                // console.log($.inArray($(this)[0], $('.box-img img')));
 //                $(this).prev().addClass('hide');
 //                $(this).removeClass('hide');
 //            });
 //        }
        
 //    });  
});