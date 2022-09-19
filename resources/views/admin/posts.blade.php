@extends('layouts.admin')
@section('title')
    posts
@endsection
@section('css')

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
      @endsection
@section('content')
    @livewire('admin.posts')
@endsection
