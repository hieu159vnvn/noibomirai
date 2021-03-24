<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="alternate" href="<?php echo e(url('/')); ?>" hreflang="vi-vn" />
  <link rel="shortcut icon" href="<?php echo e($header->favicon); ?>" type="image/x-icon" />
  <meta name="robots" content="index, follow">
  <meta http-equiv="audience" content="general" />
  <meta name="resource-type" content="document" />
  <meta name="revisit-after" content="1 days" />
  <link rel="canonical" href="<?php echo $__env->yieldContent('canonical'); ?>"/>
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>" />  
  

  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/bootstrap/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/ihover.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/popupimage.css')); ?>">

  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/grid/css/component.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/awesome/css/font-awesome.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/owlcarousel/owl.carousel.min.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/owlcarousel/owl.theme.default.min.css')); ?>" />
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/mmenu/jquery.mmenu.all.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/mmenu/style_mmenu.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/slick/slick.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('libraries/slick/slick-theme.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/front/style.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(url('css/front/responsive.css')); ?>">

  <script type="text/javascript" src="<?php echo e(url('js/front/jquery.min.js')); ?>"></script>  
  <script type="text/javascript" src="<?php echo e(url('libraries/grid/js/modernizr.custom.js')); ?>"></script>   
  <script type="text/javascript" src="<?php echo e(url('libraries/bootstrap/js/bootstrap.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('libraries/owlcarousel/owl.carousel.min.js')); ?>"></script>
  <script type="text/javascript" src="<?php echo e(url('libraries/slick/slick.min.js')); ?>"></script>
  <script type="text/javascript" src="https://www.youtube.com/iframe_api"></script>
  <script type="text/javascript" src="<?php echo e(url('js/front/masonry.pkgd.min.js')); ?>"></script>  
  <script type="text/javascript" src="<?php echo e(url('js/front/jssor.slider-27.1.0.min.js')); ?>"></script>

  
  <script type="text/javascript">
    $('#wrap-main-content').ready(function() {
      $('#status').fadeOut(100);
      $("#preloader").delay(1000).fadeOut("slow");
    });
  </script>
  
</head>

<body>
  <?php echo $insertHeaderCode; ?>

  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <div style="position: absolute;display: none;z-index: -1;">
    <?php $__env->startSection('insert_header_tag'); ?>
    <?php echo $__env->yieldSection(); ?>
  </div>
  <div class="thanhbar hidden-sm hidden-xs">
    <div class="col-md-12 noidung-bar">
      <div class="col-md-4 call-nd" style="margin-top: 10px;"><img src="images/front/call.png"><a>Hotline 24/7: <?php echo e($header->hotline1); ?></a></div>
      <form action="lien-he#lienhe" class="col-md-4 form-nd">
        <input type="" name="" placeholder="ex: yourmail@gmail.com">
        <button type="">Gửi</button>
      </form>
      <div class="col-md-4 mail-nd" style="margin-top: 10px;"><img src="images/front/mail.png"><a href=""> <?php echo e($header->hotline2); ?></a></div>
    </div>
  </div>
  <header class="hidden-xs hidden-sm hidden-md">
    <div class="container">
      <div class="col-md-4 logo">
         <a href="/"><img src="<?php echo e($header->logo); ?>"></a>
      </div>
      <div class="col-md-8 menu">
        <ul>
          <a href="/"><li>Trang chủ</li></a>
          <a href="gioi-thieu"><li>Giới thiệu</li></a>
          <a><li class="menuduan">Dự án</li></a>
          <a href="dich-vu"><li>Dịch vụ</li></a>
          <a href="tin-tuc"><li>Tin tức</li></a>
          <a href="tuyen-dung"><li>Tuyển dụng</li></a>
          <a href="lien-he"><li>Liên hệ</li></a>     
        </ul>
      </div>
    </div>    
  </header>
  <script type="text/javascript">
    jQuery(document).ready(function($) {    
        var TopFixMenu = $("header");
          $(window).scroll(function(){

              if($(this).scrollTop()>150){
              TopFixMenu.hide();

              }else{
                  TopFixMenu.show();

              }}

          )

      })
  </script>
  <script>
  $(document).ready(function() {
	$(".menuduan").click(function() {
		 $('html, body').animate({
			 scrollTop: $(".congtrinh").offset().top
		 }, 1500);
	 });
	});
  </script>

    <div class="container hidden-lg">
      <div class="logo">
         <a href="/"><img src="<?php echo e($header->logo); ?>"></a>
      </div>
    </div>

    <!-- MMENU -->
            <div id="mobilemenu" class="hidden-lg" style="position: fixed;"> 
                <nav class="invi_loading" id="mmenu">
                  
                    <ul id="main-menu">                     
                      <li><a href="/">Trang chủ</a></li>
                      <li><a href="gioi-thieu">Giới thiệu</a></li>
                      <li><a href="du-an">Dự án</a></li>
                      <li><a href="dich-vu">Dịch vụ</a>
						<ul id="menu-sidebar">
						  <?php $__currentLoopData = $levelOneCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $levelOneCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						  <li><a href="<?php echo e($levelOneCategory->product_category_slug); ?>"><i class="fa fa-angle-right"  style="color: #fff;" aria-hidden="true"></i> <?php echo e($levelOneCategory->product_category_name); ?></a>
						  </li>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                        </ul>
					  </li>
                      <li><a href="tin-tuc">Tin tức</a></li>
                      <li><a href="tuyen-dung">Tuyển dụng</a></li>
                      <li><a href="lien-he">Liên hệ</a></li>                              
                    </ul>
                </nav>
                <script type="text/javascript" src="<?php echo e(url('libraries/mmenu/jquery.mmenu.min.all.js')); ?>"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $('nav#mmenu').mmenu();
                        /* Load Menu Khi Page Load Complete */
                        $('.invi_loading').removeClass('invi_loading');
                    });
                </script>
                <!-- End JS Mmenu -->
                <a href="#mmenu" title="Menu" id="hamburger"><span></span></a>
            </div>
    <!-- MMENU -->
  <?php echo $__env->make('front._slide', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php $__env->startSection('content'); ?>
    <?php echo $__env->yieldSection(); ?>        

  <footer style="clear: both;">
    <div class="container footer">
      <div class="col-md-5 thongtin" >
        <h2>Thông tin liên hệ</h2>
        <?php echo $footer->content; ?>

        <div class="social" style="margin-top: 10px;">Mạng xã hội:
            <a href="<?php echo e($header->facebook); ?>"><i class="fa fa-facebook" aria-hidden="true"></i> </a>
            <a href="<?php echo e($header->skype); ?>"><i class="fa fa-skype" aria-hidden="true"></i> </a>
            <a href="<?php echo e($header->youtube); ?>"><i class="fa fa-youtube" aria-hidden="true"></i>  </a> 
            <a href="<?php echo e($header->linkedin); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i>  </a>        
        </div>
      </div>
      <div class="col-md-3 ft-dichvu" >
        <h2>Dịch vụ của chúng tôi</h2>
        <ul> <?php $__currentLoopData = $levelOneCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $levelOneCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li><i class="fa fa-play" aria-hidden="true"><a style="color: white;text-decoration: none;" href="<?php echo e($levelOneCategory->product_category_slug); ?>"> <?php echo e($levelOneCategory->product_category_name); ?></a></i></li>
             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
      </div>
      <div class="col-md-4 fp-face hidden-xs hidden-sm">
        <h2>Fanpage Facebook</h2>
        <div class="fb-page" data-href="<?php echo e($footer->content3); ?>" data-tabs="timeline" height="200" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="<?php echo e($footer->content3); ?>" class="fb-xfbml-parse-ignore"><a href="<?php echo e($footer->content3); ?>"></a></blockquote></div>
      </div>
      <div id="fb-root"></div>
      <script>
        (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=528443350851614&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
      </script>
    </div>

<style>
  div.phone_mobi{background:rgb(230, 0, 0);width:100%;position:fixed;left:0;bottom:0;height:45px;line-height:40px;color:#fff;z-index: 111;}
    div.phone_mobi ul{list-style:none;}
    div.phone_mobi ul li{display:inline-block;vertical-align:top;width:32%;text-align:center;}
    div.phone_mobi ul li a{color:#fff;text-decoration:none;font-size:14px;}
    div.phone_mobi ul li a i{font-size:22px;margin-right:10px;margin-top:3px;}
    .blink_me {-webkit-animation-name: blinker;-webkit-animation-duration: 1s;-webkit-animation-timing-function: linear;-webkit-animation-iteration-count: infinite;-moz-animation-name: blinker;-moz-animation-duration: 1s;-moz-animation-timing-function: linear;-moz-animation-iteration-count: infinite;animation-name: blinker;
    animation-duration: 1s;animation-timing-function: linear;animation-iteration-count: infinite;}
    @-moz-keyframes blinker {  0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}
    @-webkit-keyframes blinker {  0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}  
    @keyframes  blinker {0% { opacity: 1.0; }50% { opacity: 0.0; }100% { opacity: 1.0; }}
</style>
<div class="phone_mobi hidden-lg hidden-md">
  <ul>
      <li><a class="blink_me" href="tel:<?php echo e($header->hotline1); ?>"><i class="fa fa-phone" aria-hidden="true"></i>Gọi điện</a></li>
      <li><a href="sms:<?php echo e($header->hotline1); ?>"><i class="fa fa-comments" aria-hidden="true"></i>Nhắn tin</a></li>
      <li><a href="<?php echo e(url('lien-he')); ?>"><i class="fa fa-map-marker" aria-hidden="true"></i>Chỉ đường</a></li>
  </ul>
</div>

  </footer>
</body>
</html>
