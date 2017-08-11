<footer class="footer padding-large-top padding-large-bottom">
	<div class="container">
            <div class="line-middle">
                <span class="beian">沪ICP备17030262号-1</span>
            </div>            
	</div>
    <div id='rightContact'>
        <div class="title"><span>联系客服</span></div>
        <div class="blank qrImgH" id="qunH"><span>微信群</span></div>
        <div class="blank qrImgH" id="gzhH"><span>微信公众号</span></div>
        <div class="blank"><span>意见反馈</span></div>
        <div id="gotop" class="toTop icon-arrow-circle-up"></div>
    </div>
    <div id="qr">
        <div id="gzh" class="qrImg"><img src="<?php bloginfo('template_url'); ?>/img/gzh.jpg"></div>
        <div id="qun" class="qrImg"><img src="<?php bloginfo('template_url'); ?>/img/qun.jpg"></div>
    </div>
</footer>

<?php wp_footer(); ?>
<script>
        $(function(){  
            $('#gotop').hide();  
            $(function(){  
                $(window).scroll(function(){  
                    if($(window).scrollTop()>300){  
                        $('#gotop').fadeIn(300);  
                        }  
                        else{$('#gotop').fadeOut(200);}  
                    });  
                    $('#gotop').click(function(){  
                        $('body,html').animate({scrollTop:0},300);  
                        return false;    
                    })  
                })  
            $('#qunH').mouseover(function(){
                $('.qrImg').hide();
                $('#qun').show();
            })
            $('#gzhH').mouseover(function(){
                $('.qrImg').hide();
                $('#gzh').show();
            })
            $('.qrImgH').mouseout(function(){
                $('.qrImg').hide();
            })
        }) 
</script>

<script>
window._bd_share_config = {
        "common": {
            "bdSnsKey": {},
            "bdText": "",
            "bdMini": "2",
            "bdMiniList": false,
            "bdPic": "",
            "bdStyle": "1",
            "bdSize": "16"
        },
        "share": {}
    };
    with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~ ( - new Date() / 36e5)];
</script>



</body>
</html>