@extends('front.master')
@section('canonical', url('dich-vu'))
@section('title', $productPage->seo_title)
@section('description', $productPage->seo_description)

@section('insert_header_tag')
  <h1>{{$productPage->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $productPage->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $productPage->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection

@section('content')
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
        <div class="title-dm"><span>Dịch vụ của chúng tôi</span></div>    
        @foreach($dichvu as $k => $dv)
        <div id="box" class="col-sm-6 col-md-4 box-dichvu">
          <div class="img-dichvu">
            @php
              $thumbUrl = str_replace('/source/','/thumbs/',$dv->product_category_image);
            @endphp
            <picture>
              <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
              <img src="{{$thumbUrl}}" alt="{{$dv->product_title}}">
            </picture>
            <div class="des"><a href="{{$dv->product_category_slug}}" class="xemthem">CHI TIẾT</a></div>
          </div>
          <div class="content-dichvu" style="background: <?php if($k%6 == 0) echo '#d71a21'; if($k%6==1) echo '#202a45'; if($k%6==2) echo '#3c3b3b'; if($k%6==3) echo '#ea5ca4'; if($k%6==4) echo '#1690bf'; if($k%6==5) echo '#97b106'?>;">
            <div class="info">
              <h2>{{$dv->product_category_name}}</h2>
              <p>{!!catchuoi($dv->product_category_description,170)!!}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div> 
</div>   
@endsection