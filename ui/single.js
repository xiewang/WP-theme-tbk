$(function(){
    $('#tuwenLink').click(function(){
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