@extends('layouts.front')
@section('title')
    home
@endsection
@section('css')
    <style>
@import url(vaiables.css);
.course_card{
    background-color: var(--card-content);
    border: 1px solid var(--form-text);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.course_card:hover{
  box-shadow: 0 0 10px var(--box-shadow);
}
input[type="search"]{
    background: var(--input-color);
    border: 2px solid rgb(90, 90, 90);
    width: min(200px,30%);
}
input:focus {
    outline: none !important;
    border: 2px solid #2188f1;
    box-shadow: 0 0 2px #2196F3;
  }
.course_card p{
    color: var(--form-text);
    text-align: center;
    padding: 4px;
    overflow-wrap: break-word;
}
.course_card_img img{  
    width: 100%;
    height: 200px;
    object-fit: cover;
    /* border-bottom: 1px solid lightgray; */
    transition: scale 0.3s ease-in-out;
}
.text-blue{
    color: var(--blue-color) !important;
}
.course_card_img{
    overflow: hidden;
}
.course_card:hover img{
    scale: 1.05;
}
.course_card{
    overflow: hidden !important;
}
.no-image{
    width: 100%;
    height: 200px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: lightgrey;
    background-color: gray;
    font-size: 22px;
}
.course_card_footer{
    border-top: 1px solid lightgray;
}
    </style>
@endsection
@section('content')
<div class="row gap-2 px-4 my-3">
    <div class="contain col-sm-8">
        <div class="title">who we are?</div>
        
        <div class="content">
            we are a blog to share ehat happening in world
        </div>
    </div>
    <div class="col contain col-sm" style="min-height: unset !important;height: fit-content;">
        <div class="card w-100 h-100">
            <div class="card-header">
              categories
            </div>
            <ul class="list-group">
              @foreach ($categories as $cat)
              <li class="list-group-item">
                <a class="text-blue text-decoration-none" href="{{route('category',[$cat->slug])}}">{{$cat->name}}</a>
              </li>
              @endforeach
            </ul>
          </div>
    </div>
</div>
<div class="row mx-3 contain">
  <div class="title"
  style="border-bottom: 1px solid lightgray;border-radius: 5px 5px 0 0"
   class="p-2 text-center">
      latest_posts
  </div>
  @foreach ($latest_posts as $post)
  <div class="col-lg-4 col-md-6 col-sm-12 my-3">
    <div class="course_card">
      @if (!empty($post->image))
      <div class="course_card_img">
          <img 
           src="{{asset('storage/'.$post->image)}}" alt="course"/>
          </div>
      @else
          <div class="course_card_img no-image">
              no image
          </div>
      @endif  
    <div class="course_card_content">
      <h4 style="color: var(--blue-color);background: transparent;border-bottom: unset;"
       class="title">{{$post->title}}</h4>
       <p class="description pt-2">small description: {{$post->small_description}}</p>
      
    </div>
    <div class="course_card_footer p-2"
    style="display: flex;align-items: center;justify-content: space-between;">
      <div style="color: var(--form-text);">{{$post->created_at->diffForHumans()}}</div>
      <a class="text-blue text-decoration-none"
       href="{{route('post.details',[$post->id])}}" 
       class="nav-item btn btn-outline-primary btn-sm">view</a>
  </div>
  </div>
  </div>
@endforeach
@endsection