@extends('front.master')
@section('canonical', url('tuyen-dung'))
@section('title', $tuyendung->seo_title)
@section('description', $tuyendung->seo_description)

@section('insert_header_tag')
  <h1>{{$tuyendung->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $tuyendung->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $tuyendung->h3_tag);
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
  <div class="title-dm"><span>{{$tuyendung->title}}</span></div>
    <div class="col-md-12 noidung" style="text-align: justify; margin: 20px 0px;">
      <p>{!!$tuyendung->content!!} </p>
    </div>  
</div>
<div class="container-fix quangcao">
  <img width="100%" src="images/front/taisao.PNG">
</div> 
@endsection