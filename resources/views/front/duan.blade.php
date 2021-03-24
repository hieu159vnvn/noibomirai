@extends('front.master')
@section('canonical', url('du-an'))
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
        <div class="title-dm"><span>Dự án nỗi bật</span></div>    
        @foreach($duan as $da)
        <div id="box" class="col-sm-6 col-md-4 box-dichvu" style="height: 350px;">
          <div class="img-dichvu" style="max-height: 300px;">
            @php
              $thumbUrl = str_replace('/source/','/thumbs/',$da->product_feature_image);
            @endphp
            <picture>
              <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
              <img src="{{$thumbUrl}}" alt="{{$da->product_title}}">
            </picture>
            <div class="des"><a  href="{{$da->product_slug}}-rsp" class="xemthem">CHI TIẾT</a></div>
          </div>
          <div class="content-dichvu" style="background: #00BCD4;">
              <h2 style="font-weight: bold;border-bottom:none !important;">{{catchuoi($da->product_title,50)}}</h2>
              //<p style="text-align: left;">{{catchuoi($da->product_description,130)}}</p>
          </div>
        </div>
        @endforeach
      </div> 
</div>   
@endsection