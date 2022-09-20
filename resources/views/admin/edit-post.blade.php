@extends('layouts.admin')
@section('title')
    edit
@endsection
@section('content')

<div class="container">
    <form action="{{route('post.admin.update',[$post->id])}}" 
        method="post" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <input type="hidden" name="id" value="{{$post->id}}">
        <div class="form-group">
            <input class="form-control" 
            type="text" name="title" id="name" required placeholder="name" 
            value="{{$post->title}}">
        </div>
        <div class="form-group">
            <textarea   class="form-control" name="small_description" id="name" placeholder="small description"
             required>{{$post->small_description}}</textarea>
        </div>
        <div class="form-group">
            <textarea style="visibility: hidden" class="form-control" cols="10" name="description" 
            id="editor" 
            placeholder="description">{{$post->description}}</textarea>
            
        </div>
        <div class="form-group">
            <select name="category_id" id="cat">
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}" {{$cat->id == $post->category_id ? "selected" : ""}}
                        >{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            @if ($post->image)
            old Image : <img style="width: 200px" src="{{asset('storage/images/'.$post->image)}}" alt="">
            @endif
            <input class="form-control" type="file" name="new_image" id="name">
        </div>
        <button type="submit" class="btn btn-primary">edit</button>
    </form>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>

<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection