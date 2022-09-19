@extends('layouts.front')
@section('css')
    <link rel="stylesheet" href="{{asset('css/posts.css')}}">
@endsection
@section('title')
    {{$category->name}} | posts
@endsection
@section('content')
    @livewire('posts', ['category_slug' => $category->slug])    
@endsection