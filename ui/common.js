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
	})
});