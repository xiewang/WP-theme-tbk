$(function(){
	$('#m-cate-icon').on('click', function(){
		if($('.m-cate-drop').hasClass('hide'))
			$('.m-cate-drop').removeClass('hide');
		else
			$('.m-cate-drop').addClass('hide');
	});
	$('#m-packup').on('click', function(){
		$('.m-cate-drop').addClass('hide');
	});
	
});