@extends('front.master')
@section('canonical', url('/'))
@section('title', $homepage->seo_title)
@section('description', $homepage->seo_description)

@section('insert_header_tag')
  <h1>{{$homepage->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $homepage->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $homepage->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection

@section('content')
<content>
 @php
  function catchuoi($chuoi,$gioihan)
  {
    if(strlen($chuoi)<=$gioihan)
    {
      return $chuoi;
    }
    else
    {
      if(strpos($chuoi," ",$gioihan) > $gioihan)
      {
        $new_gioihan=strpos($chuoi," ",$gioihan);
        $new_chuoi = substr($chuoi,0,$new_gioihan)."...";
        return $new_chuoi;
      }
      $new_chuoi = substr($chuoi,0,$gioihan)."...";
      return $new_chuoi;
    }
  }
@endphp 
<div class="container dichvu" >
      <div class="col-md-12 clearfix">
        <div class="title-dm"><span>Danh mục dịch vụ</span></div>
        
        @foreach($levelOneCategories as $k => $levelOneCategory)
        <div id="box" class="col-sm-6 col-md-4 box-dichvu">
          <div class="img-dichvu">
            <img height="280" src="{{$levelOneCategory->product_category_image}}">
            <div class="des"><a href="{{$levelOneCategory->product_category_slug}}" class="xemthem">XEM CHI TIẾT</a></div>
          </div>
          <div class="content-dichvu" style="background: <?php if($k%6 == 0) echo '#d71a21'; if($k%6==1) echo '#202a45'; if($k%6==2) echo '#3c3b3b'; if($k%6==3) echo '#ea5ca4'; if($k%6==4) echo '#1690bf'; if($k%6==5) echo '#97b106'?>;">
            <div class="info">              
              <h2>{{$levelOneCategory->product_category_name}}</h2>
              <p style="font-size:14px;">{!!catchuoi($levelOneCategory->product_category_description,200)!!}</p>
            </div>
          </div>
        </div>
        @endforeach
        
      </div>
    </div>

    <div class="container-fix quangcao">
	<img width="100%" src="{{$header->quangcao}}">
    </div>

    <div class="container congtrinh">
      <div>
        <div class="title-dm"><span>Dự án tiêu biểu</span></div>   
          <ul class="grid effect-1" id="grid">
            @foreach($duan as $da)
            <li class="box-img">
                @php
                  $thumbUrl = str_replace('/source/','/thumbs/',$da->product_feature_image);
                @endphp
                <picture>
                  <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
                   <img class="popupImage" src="{{$thumbUrl}}" alt="{{$da->product_title}}" width="100%">
                </picture>
              <div class="des"><a class="popupImage" src="{{$thumbUrl}}" alt="{{$da->product_title}}" class="xemthem">Xem chi tiết</a><h2 class="hidden-xs hidden-sm" style="text-align: center !important;font-size: 16px;">{{catchuoi($da->product_title,70)}}</h2></div>
            </li>
            @endforeach

          </ul>
        <div id="modalShowImage" class="modal-Image">
        <!-- The Close Button -->
        <span class="close">&times;</span>
        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">
        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
        </div>
        <script src="{{url('libraries/grid/js/masonry.pkgd.min.js')}}"></script>
        <script src="{{url('libraries/grid/js/imagesloaded.js')}}"></script>
        <script src="{{url('libraries/grid/js/classie.js')}}"></script>
        <script src="{{url('libraries/grid/js/AnimOnScroll.js')}}"></script>
        <script>
          new AnimOnScroll( document.getElementById( 'grid' ), {
            minDuration : 0.4,
            maxDuration : 0.7,
            viewportFactor : 0.2
          } );          
        </script>
    <!-- For the demo ad -->   
    <script src="{{url('libraries/grid/js/demoad.js')}}"></script>
	
    <script>
      $(function(){
        $(".popupImage").click(function(){
          var modal = document.getElementById("modalShowImage");  
          var captionText = document.getElementById("caption"); 
          var modalImg = document.getElementById("img01"); 
          modal.style.display = "block";   
          modalImg.src = $(this).attr("src");  
             captionText.innerHTML = $(this).attr("alt");  
          });
          $(".modal-Image").click(function(){
            var modal = document.getElementById("modalShowImage");
            modal.style.display = 'none';
        });
      });
     </script>
      </div>
    </div>
    
    <div class="container tintuc">
      <div class="col-md-12 clearfix">
        <div class="title-dm"><span>Tin tức & video</span></div>    
        <div class="col-md-8 clearfix">
          <div class="box-tintuc">
            <div class="col-md-6 clearfix hidden-xs hidden-sm">
              <div class="img-tintuc">
                <picture>
                  <source media="(max-width: 500px)" srcset="{{str_replace('/source/','/thumbs/',$tintuc[0]->post_image)}}">
                  <img width="100%" src="{{$tintuc[0]->post_image}}" alt="{{$tintuc[0]->post_title}}">
                </picture>
              </div>
              <div class="info-tintuc">
                <a href="{{$tintuc[0]->post_slug}}-bv.html"><h2>{{catchuoi($tintuc[0]->post_title,70)}}</h2>
                <p style="color: #000;">{{catchuoi($tintuc[0]->post_description,200)}}</p>
              </div>
            </div>
            <div class="col-md-6">
              <ul class="tintuc-list">
                @foreach($tintuc as $tt)
                  <li>
                    <div class="content-tintuc">
                      <div class="pic-tt">
                        <a href=""><img src="{{$tt->post_image}}"></a>
                      </div>  
                      <div class="info-tt">
                        <div class="name-tt"><a style="color: #000;" href="{{$tt->post_slug}}-bv.html"> {{catchuoi($tt->post_title,70)}}</a></div>
                        <div class="desc-tt hidden-xs"><p style="color: #000;">{{ catchuoi($tt->post_description,70) }}</p></div>
                      </div>  
                    </div>
                  </li>

                @endforeach
              </ul>
              <script type="text/javascript">
                $(document).ready(function(){
                  $('.tintuc-list').slick({
                    lazyLoad: 'ondemand',
                    infinite: true,
                    accessibility:true,
                    vertical:true,           
                    slidesToShow: 3,    
                    slidesToScroll: 1, 
                    autoplay:true,  
                    autoplaySpeed:1000,  
                    arrows:true,         
                    draggable:true,         
                  });
                });
              </script>
            </div>
          </div>   
        </div>
        <div class="col-md-4 clearfix hidden-sm hidden-xs">
          <div class="video">
            @php 
            $result = str_replace('watch?v=', 'embed/', $video->video1);
            unset($video->video1);
            @endphp
            <div class="video-noibat">
              <iframe width="100%" height="278px" src="{{$result}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
            <div class="video-list wrap-owl-carousel">
              <ul id="owl-video" class="owl-carousel">
                @foreach($video as $vd)
                 @php 
                  $result1 = str_replace('watch?v=', 'embed/', $vd);
                 @endphp
                    <li>
                         <iframe width="100%" height="100px" src="{{$result1}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </li>               
                 @endforeach       
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container-fix quangcao3">      
	  <img width="100%" src="images/front/cnc.jpg">
    </div>


     <div class="container noibat">
      <div class="col-md-12 clearfix">   
      @foreach($noibat as $nb)
        <div class="col-sm-6 col-md-4 box-noibat">
          <div class="img-noibat">
              @php
                $thumbUrl = str_replace('/source/','/thumbs/',$nb->product_feature_image);
              @endphp
              <picture>
                <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
                <a href="{{$nb->product_slug}}-rsp"><img src="{{$thumbUrl}}" alt="{{$nb->product_title}}"></a>
              </picture>
          </div>
          <div class="content-noibat">
            <a style="color: black;" href="{{$nb->product_slug}}-rsp"><h2 class="text-center">{{catchuoi($nb->product_title,50)}}</h2>
            <!--<p>{{catchuoi($nb->product_description,100)}}</p></a> -->
          </div>
        </div>
      @endforeach
      </div>
    </div>

    <div class="container-fix map">
     @if(!strpos(url()->current(),'lien-he'))
          @php
            $bandoFooter = explode(';',$footer->content1);
          @endphp 
          @component('front._bando',['name'=>'footer','width'=>'100%','height'=>'400px','tieudegooglemap'=>$bandoFooter[0],'diachigooglemap'=>$bandoFooter[1],'hotlinegooglemap'=>$bandoFooter[2],'emailgooglemap'=>$bandoFooter[3],'latitude'=>$bandoFooter[4],'longitude'=>$bandoFooter[5],'info_window_status'=>1])
          @endcomponent
     @endif
	</div>

    <div class="container-fix doitac">
      <div class="wrap-owl-carousel col-xs-12">
        <div id="owl-doitac" class="owl-carousel">
             @foreach($doitac as $dt)
               <a href=""><img src="{{$dt}}"></a>
            @endforeach
          </div>
      </div>
      <script type="text/javascript">
        (function($) {
        $(document).ajaxComplete(function() {
          setTimeout(function()
          {
            $('[role="alert"]').slideUp('slow');
          }, 3600);
          });
        })(jQuery);   
        
        $('#owl-doitac').owlCarousel({
          autoplay: true,
          loop: true,
          nav: true,
          navText: ["<span class='icon icon-arrow-left7'></span>","<span class='icon icon-arrow-right7'></span>"],
          items: 5,
          responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                600:{
                    items:3,
                    nav:true
                },
                1000:{
                    items:5,
                    nav:true,
                },
                1200:{
                    items:5,
                    nav:true,
                }
            }
        });
        $('#owl-video').owlCarousel({
          autoplay: true,
          center: true,
          loop: true,
          nav: true,
          navText: ["<span class='icon icon-arrow-left7'></span>","<span class='icon icon-arrow-right7'></span>"],
          items: 5,
          responsiveClass:true,
            responsive:{
                0:{
                    items:2,
                    nav:true
                },
                600:{
                    items:3,
                    nav:true
                },
                1000:{
                    items:3,
                    nav:true,
                },
                1200:{
                    items:3,
                    nav:true,
                }
            }
        });
        $('#owl-video .owl-nav').css('display', 'inline-block');
        $('#owl-video .owl-item img').height($('#owl-video .owl-item').width()*9/20).css('padding',5);
        $('#owl-video .owl-next, #owl-video .owl-prev').css('top', ($('#owl-video .owl-item img').height()-$('#owl-video .owl-next .icon').height())/2);

        $('#owl-doitac .owl-nav').css('display', 'inline-block');
        $('#owl-doitac .owl-item img').height($('#owl-doitac .owl-item').width()*9/20).css('padding',10).width("180");
        $('#owl-doitac .owl-next, #owl-doitac .owl-prev').css('top', ($('#owl-doitac .owl-item img').height()-$('#owl-doitac .owl-next .icon').height())/3);
      </script>
    </div>
</content> 
@endsection