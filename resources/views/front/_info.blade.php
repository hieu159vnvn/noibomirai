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
                <h2>{{$tintuc[0]->post_title}}</h2>
                <p style="color: #000;">{{catchuoi($tintuc[0]->post_description,200)}}</p>
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
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
                        <div class="name-tt"><a style="color: #000;" href="{{$tt->post_slug}}-bv.html"> {{$tt->post_title}}</a></div>
                        <div class="desc-tt"><p style="color: #000;">{{ catchuoi($tt->post_description,50) }}</p></div>
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
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
        <div class="col-md-4 clearfix">
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