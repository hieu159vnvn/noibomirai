@extends('front.master')
@section('canonical', url($category->product_category_slug))
@section('title', $category->product_category_seo_title)
@section('description', $category->product_category_seo_description)

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
<div class="container dichvu" style="padding-right: 10px;padding-left: 10px;" >
      <div style="margin-bottom: 50px;" class="col-md-12 clearfix">
        <div  class="title-dm"><span>{{$category->product_category_name}}</span></div>
			<div style="text-align: none;">{!!$category->product_category_description!!}</div>
		<!--<div style="margin-top: 50px;" class="title-dm"><span>Dịch vụ khác</span></div>
        @foreach($products as $k => $product)
        <div id="box" class="col-sm-6 col-md-4 box-dichvu">
          <div class="img-dichvu">
            @php
              $thumbUrl = str_replace('/source/','/thumbs/',$product->product_feature_image);
            @endphp
            <picture>
              <source media="(max-width: 500px)" srcset="{{$thumbUrl}}">
              <img src="{{$thumbUrl}}" alt="{{$product->product_title}}">
            </picture>
            <div class="des"><a href="{{$product->product_slug}}-rsp" class="xemthem">CHI TIẾT</a></div>
          </div>
          <div class="content-dichvu" style="background: <?php if($k%6 == 0) echo '#d71a21'; if($k%6==1) echo '#202a45'; if($k%6==2) echo '#3c3b3b'; if($k%6==3) echo '#ea5ca4'; if($k%6==4) echo '#1690bf'; if($k%6==5) echo '#97b106'?>;">
            <div class="info">
              <h2>{{$product->product_title}}</h2>
              <p>{{$product->product_description}}</p>
            </div>
          </div>
        </div>
        @endforeach -->
      </div>
      <div class="col-md-12 text-center">
        {{ $products->links() }}
      </div> 
</div>   
@endsection