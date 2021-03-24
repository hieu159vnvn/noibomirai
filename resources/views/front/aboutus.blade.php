@extends('front.master')
@section('canonical', url('gioi-thieu'))
@section('title', $gioithieu->seo_title)
@section('description', $gioithieu->seo_description)

@section('insert_header_tag')
  <h1>{{$gioithieu->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $gioithieu->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $gioithieu->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection
@section('content')
<div class="container gioithieu">
      <div class="title-dm"><span>Về chúng tôi</span></div>
      <div class="col-md-6 text-center">
          <h3>Giới thiệu</h3>
          <p>{{$gioithieu->description}} </p>
        </div>
        <div class="col-md-6">
          <img src="images/front/slide.png">
        </div>
        <div class="col-md-12 noidung" style="text-align: justify; margin: 20px 0px;">
          <p>{!!$gioithieu->content!!} </p>
        </div>     
        
</div>
<div class="container-fix quangcao">
  <img width="100%" src="images/front/taisao.PNG">
</div> 
@endsection