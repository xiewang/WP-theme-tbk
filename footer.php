<footer class="footer padding-large-top padding-large-bottom">
	<div class="container">
            <div class="line-middle text-c">
                <span class="beian">Copyright © 半刀网 2017, All Rights Reserved. 沪ICP备17030262号-1</span>
            </div>            
	</div>
    <?php if(!wp_is_mobile()){?>
        <div id='rightContact'>
            <div class="title"><span>联系客服</span></div>
            <div class="blank qrImgH" id="jiaocheng"><a href="/article"><span>使用教程</span></a></div>

            <!-- <div class="blank qrImgH" id="qunH"><span>QQ群</span></div> -->
            <div class="blank qrImgH" id="gzhH"><span>客服</span></div>
            <div class="blank"><a href="/feedback"><span>意见反馈</span></a></div>
            <div id="gotop" class="toTop icon-arrow-circle-up"></div>
        </div>
        <div id="qr">
            <div id="gzh" class="qrImg"><img src="<?php bloginfo('template_url'); ?>/img/gzh.jpg"></div>
            <div id="qun" class="qrImg"><img src="<?php bloginfo('template_url'); ?>/img/qun.jpg"></div>
        </div>
    <?php } else {?>
        <div class="rightContactMobile">
            <div class="plus"><span>+</span></div>
            <div class="bling"><a href="/feedback"><span>意见</span><span>反馈</span></a></div>
            <div class="bling" id="jiaochengC"><a href="/article"><span>使用</span><span>教程</span></a></div>

            <!-- <div class="bling" id="qunC"><span>QQ</span><span>群</span></div> -->
            <div class="bling" id="gzhC" style="line-height: 26px;"><span>客服</span></div>
        </div>
    <?php }?>

    <div class="shade" id="gzhMobile">
        <div class="content">
            <img src="<?php bloginfo('template_url'); ?>/img/gzh.jpg">
            <span id="scan">微信扫码，或长按识别</span>
        </div>
    </div>
    <div class="shade" id="qunMobile">
        <div class="content">
            <img src="<?php bloginfo('template_url'); ?>/img/qun.jpg">
        </div>
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

            $(document).on('click','.plus',function(){
                var the = this;
                if($(this).parent().hasClass('rotate')){
                    $(this).parent().removeClass('rotate');
                    $(this).parent().addClass('rotateR');
                    $(the).parent().find('.bling').removeClass('scale');
                }else if($(this).parent().hasClass('rotateR')) {
                    $(this).parent().removeClass('rotateR');
                    $(this).parent().addClass('rotate');
                    var timeout = setTimeout(function(){
                        $(the).parent().find('.bling').addClass('scale');
                        clearTimeout(timeout);
                    },800);
                } else {
                    $(this).parent().addClass('rotate');
                    var timeout = setTimeout(function(){
                        $(the).parent().find('.bling').addClass('scale');
                        clearTimeout(timeout);
                    },800);
                }
            })

            $('#gzhC').click(function(){
                // $('#gzhMobile').show();
                 $(".shade").slideUp('slow');
                $("#gzhMobile").slideToggle();
            });
            $('#qunC').click(function(){
                $(".shade").slideUp('slow');
                $('#qunMobile').slideToggle();
            });
            $(document).bind("click",function(e){  
                var target = $(e.target);  
                if((target.closest(".shade .content>*,.bling").length == 0)){  
                    $(".shade").slideUp('slow');
                }  
            });  
            
        }) 
</script>


<script src="<?php bloginfo('template_url'); ?>/ui/swiper-3.4.2.jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/ui/common-2017110101.js" type="text/javascript" ></script>
</body>
</html>