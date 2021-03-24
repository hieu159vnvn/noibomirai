@extends('front.master')
@section('canonical', url('tin-tuc'))
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
        <div class="title-dm"><span>Tin tức và sự kiện</span></div>    
        @foreach($tintuc as $tt)
        <div id="box" class="col-sm-6 col-md-3 box-dichvu" style="height: 350px;">
          <div class="img-dichvu" style="max-height: 200px;">
            @php
              $thumbUrl = str_replace('/source/','/thumbs/',$tt->post_image);
            @endphp
            <picture>
              <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
              <img src="{{$thumbUrl}}" alt="{{$tt->post_title}}">
            </picture>
            <div class="des"><a href="{{$tt->post_slug}}-bv.html" class="xemthem">CHI TIẾT</a></div>
          </div>
          <div class="content-dichvu" style="text-align: left; background: #f3f3f3">
            <div class="info">
              <a style="color: black;" href="{{$tt->post_slug}}-bv.html"><p style="font-weight: bold;">{{catchuoi($tt->post_title,50)}}</p>
              <p>{{catchuoi($tt->post_description,120)}}</p></a>
            </div>
          </div>
        </div>
        @endforeach
      </div> 
</div>   
@endsection