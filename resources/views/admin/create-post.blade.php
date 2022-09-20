@extends('layouts.admin')
@section('title')
    edit
@endsection
@section('content')

<div class="container">
    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" >
        <div class="form-group">
            <input class="form-control" 
            type="text" name="title" id="name" required placeholder="name" 
            >
        </div>
        <div class="form-group">
            <textarea   class="form-control" name="small_description"
             id="name"
             required></textarea>
        </div>
        <div class="form-group">
            <textarea style="visibility: hidden" class="form-control"
             cols="10" name="description" 
            id="editor" 
            placeholder="description"></textarea>
        </div>
        <div class="form-group">
            <select required class="form-control" name="category_id" id="cid">
                @foreach ($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="image" id="image">
        </div>
        
        <button type="submit" class="btn btn-primary">add post</button>
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