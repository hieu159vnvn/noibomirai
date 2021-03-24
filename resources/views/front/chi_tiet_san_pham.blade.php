@extends('front.master')

@section('canonical', url($product->product_slug . '-rsp'))
@section('title', $product->product_seo_title)
@section('description', $product->product_seo_description)

@section('insert_header_tag')
  <h1>{{$product->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $product->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $product->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection

@section('content')
<script type="text/javascript">
marqueeInit({
  uniqueid: 'mycrawler2',
  style: {  
    'width': '100% !important'
  },
  inc: 4, /*speed - pixel increment for each iteration of this marquee's movement*/
  mouse: 'cursor driven', /*mouseover behavior ('pause' 'cursor driven' or false)*/
  moveatleast:1,
  neutral: 300,
  savedirection: true,
  random: true
});
</script> 
    <div class="container chitiet">
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
      <div class="col-md-12">
        <div class="title-dm"><span>Dịch vụ nổi bật</span></div>
        <p style="font-size: 16px;text-align: center;">{{$product->product_title}}</p>
        <div>{!!$product->product_content!!}</div>
      </div> 
    </div>
    <div class="container tinlienquan">
      <div class="title-dm"><span>Bài viết mới nhất</span></div>
      <div class="col-md-12 clearfix"> 
        @foreach($relativeProducts as $relativeProduct)
          <div class="col-sm-6 col-md-4 box-boibat">
              <div class="img-noibat">
                @php
                  $thumbUrl = str_replace('/source/','/thumbs/',$relativeProduct->product_feature_image);
                @endphp
                <picture>
                  <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
                  <a href="{{$relativeProduct->product_slug}}-rsp"><img src="{{$thumbUrl}}" alt="{{$relativeProduct->product_title}}"></a>
                </picture>
                <div class="content-noibat">
                  <a href="{{$relativeProduct->product_slug}}-rsp"><h2 class="text-center">{{catchuoi($relativeProduct->product_title,50)}}</h2></a>
                 {{--  <p>{{$relativeProduct->product_description}}</p></a> --}}
                </div>
              </div>         
          </div> 
        @endforeach      
      </div>
    </div>
@endsection