<footer class="footer padding-large-top padding-large-bottom">
	<div class="container">
            <div class="line-middle">
                <span class="beian">沪ICP备17030262号-1</span>
            </div>            
	</div>
	<div id="gotop" class="toTop icon-arrow-circle-up"></div>
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