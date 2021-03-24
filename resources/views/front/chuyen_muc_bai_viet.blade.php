@extends('front.master')
@section('canonical', url($category->category_slug.'.html'))
@section('title', $category->category_seo_title)
@section('description', $category->category_seo_description)

@section('insert_header_tag')
  <h1>{{$category->h1_tag}}</h1>
  @php
    $h2_tags = explode (',', $category->h2_tag);
    foreach($h2_tags as $h2_tag){
      echo '<h2>'.trim($h2_tag).'</h2>';
    }
    $h3_tags = explode (',', $category->h3_tag);
    foreach($h3_tags as $h3_tag){
      echo '<h3>'.trim($h3_tag).'</h3>';
    }
    foreach($h3_tags as $h3_tag){
      echo '<h4>'.trim($h3_tag).'</h4>';
    }
  @endphp
@endsection

@section('content')
  <div id="post-category" class="col-sm-7 col-md-9 clearfix"> <!-- product  -->
    <div class="col-sm-12 title-sp"><h2>{{$category->category_name}}</h2></div>
    <div class="col-sm-12 noi-dung-chinh"> {{-- CSS dich vu --}}
      @foreach($posts as $post) 
        <div class="col-xs-5 col-sm-5 col-md-4" style="margin-bottom: 15px;padding:5px; clear: both;">
          <a href="{{url($post->post_slug . '-bv.html')}}">
            @php
              $thumbUrl = str_replace('/source/','/thumbs/',$post->post_image);
            @endphp
            <picture>
              <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
              <img style="float: left; margin-right: 10px;" width="100%" src="{{$thumbUrl}}" alt="{{$post->post_title}}">
            </picture>
          </a>
        </div>
        <div class="col-xs-7 col-sm-7 col-md-8">
          <h3 style="margin-top:0; margin-bottom: 10px;"><a style="color: red; font-size: 16px;" href="{{url($post->post_slug . '-bv.html')}}">{{$post->post_title}}</a></h3>
          <i>{{$post->post_description}}</i>
        </div>
      @endforeach
    </div> {{-- CSS dich vu --}}
    <div class="col-sm-12 text-center">
      {{ $posts->links() }}
    </div>
    </div>     
  </div><!-- end product -->
@endsection