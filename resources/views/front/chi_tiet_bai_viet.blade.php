@extends('front.master')
@section('canonical', url($post->post_slug.'-bv.html'))
@section('title', $post->post_seo_title)
@section('description', $post->post_seo_description)

@section('insert_header_tag')
  <h1>{{$post->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $post->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $post->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection

@section('content')
<div class="container dichvu" style="padding-right: 10px;padding-left: 10px;" >
      <div class="col-md-12">
        <div class="title-dm"><span>Tin tức & sự kiện </span></div>
		<h2 style="font-size: 16px;">{{$post->post_title}}</h2>
		<div style="text-align: none;">{!!$post->post_content!!}</div>
      </div>      
 </div>
@endsection