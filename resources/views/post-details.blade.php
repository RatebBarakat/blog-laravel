@extends('layouts.front')
@section('css')
<style>
.card-header{
  background: var(--card-header) !important;
    font-size: 12px !important;
    min-height: unset !important;
    letter-spacing: initial !important;
}
.description *{
  overflow-wrap: break-word;
  text-align: initial;
  color: var(--form-text);
}
.description table{
  width: 100%;
  margin: auto;
  border-color: var(--form-text);
  color: var(--form-text);
}
.description th,td,tr{
  border: 1px solid var(--form-text);
  text-align: center !important;
  padding: 3px !important;
}
.description h1,h2,h3{
  color: var(--blue-color) !important
}
.comment.active{
  box-shadow: 0 0 10px 4px red;
  opacity: 1 !important;
}
.comment.no_active{
  opacity: .4;
}
.rating {
  margin: auto;
}
.rating__display {
  font-size: 1em;
  font-weight: 500;
  min-height: 1.25em;
  position: absolute;
  top: 100%;
  width: 100%;
  text-align: center;
}
input[type="radio"]:focus{
    border: none !important
}
select{
  outline: initial !important;
  border: initial !important;
}
textarea{
    border: 2px solid transparent;
    color: var(--form-text);
}
textarea:focus{
    outline: none;
    border: 2px solid var(--blue-color)
}
.rating__stars {
  display: flex;
  padding-bottom: 0.375em;
  position: relative;
}
.rating__star {
  display: block;
  overflow: visible;
  pointer-events: none;
  width: 2em;
  height: 2em;
}
.rating__star-ring, .rating__star-fill, .rating__star-line, .rating__star-stroke {
  animation-duration: 1s;
  animation-timing-function: ease-in-out;
  animation-fill-mode: forwards;
}
.rating__star-ring, .rating__star-fill, .rating__star-line {
  stroke: var(--blue-color);
}
.rating__star-fill {
  fill: var(--blue-color);
  transform: scale(0);
  transition: fill var(--trans-dur) var(--bezier), transform var(--trans-dur) var(--bezier);
}
.rating__star-stroke {
  stroke: #c7cad1;
  transition: stroke var(--trans-dur);
}
.rating__label {
  cursor: pointer;
  padding: 0.125em;
}
.rating__label--delay1 .rating__star-ring, .rating__label--delay1 .rating__star-fill, .rating__label--delay1 .rating__star-line, .rating__label--delay1 .rating__star-stroke {
  animation-delay: 0.05s;
}
.rating__label--delay2 .rating__star-ring, .rating__label--delay2 .rating__star-fill, .rating__label--delay2 .rating__star-line, .rating__label--delay2 .rating__star-stroke {
  animation-delay: 0.1s;
}
.rating__label--delay3 .rating__star-ring, .rating__label--delay3 .rating__star-fill, .rating__label--delay3 .rating__star-line, .rating__label--delay3 .rating__star-stroke {
  animation-delay: 0.15s;
}
.rating__label--delay4 .rating__star-ring, .rating__label--delay4 .rating__star-fill, .rating__label--delay4 .rating__star-line, .rating__label--delay4 .rating__star-stroke {
  animation-delay: 0.2s;
}
.rating__input {
  -webkit-appearance: none;
  appearance: none;
}
.rating__input:hover ~ [data-rating]:not([hidden]) {
  display: none;
}
.rating__input-1:hover ~ [data-rating="1"][hidden], .rating__input-2:hover ~ [data-rating="2"][hidden], .rating__input-3:hover ~ [data-rating="3"][hidden], .rating__input-4:hover ~ [data-rating="4"][hidden], .rating__input-5:hover ~ [data-rating="5"][hidden], .rating__input:checked:hover ~ [data-rating]:not([hidden]) {
  display: block;
}
.rating__input-1:hover ~ .rating__label:first-of-type .rating__star-stroke, .rating__input-2:hover ~ .rating__label:nth-of-type(-n + 2) .rating__star-stroke, .rating__input-3:hover ~ .rating__label:nth-of-type(-n + 3) .rating__star-stroke, .rating__input-4:hover ~ .rating__label:nth-of-type(-n + 4) .rating__star-stroke, .rating__input-5:hover ~ .rating__label:nth-of-type(-n + 5) .rating__star-stroke {
  stroke: var(--blue-color);
  transform: scale(1);
}
.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-ring, .rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-ring, .rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-ring, .rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-ring, .rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-ring {
  animation-name: starRing;
}
.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-stroke, .rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-stroke, .rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-stroke, .rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-stroke, .rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-stroke {
  animation-name: starStroke;
}
.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-line, .rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-line, .rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-line, .rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-line, .rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-line {
  animation-name: starLine;
}
.rating__input-1:checked ~ .rating__label:first-of-type .rating__star-fill, .rating__input-2:checked ~ .rating__label:nth-of-type(-n + 2) .rating__star-fill, .rating__input-3:checked ~ .rating__label:nth-of-type(-n + 3) .rating__star-fill, .rating__input-4:checked ~ .rating__label:nth-of-type(-n + 4) .rating__star-fill, .rating__input-5:checked ~ .rating__label:nth-of-type(-n + 5) .rating__star-fill {
  animation-name: starFill;
}
.rating__input-1:not(:checked):hover ~ .rating__label:first-of-type .rating__star-fill, .rating__input-2:not(:checked):hover ~ .rating__label:nth-of-type(2) .rating__star-fill, .rating__input-3:not(:checked):hover ~ .rating__label:nth-of-type(3) .rating__star-fill, .rating__input-4:not(:checked):hover ~ .rating__label:nth-of-type(4) .rating__star-fill, .rating__input-5:not(:checked):hover ~ .rating__label:nth-of-type(5) .rating__star-fill {
  fill: var(--blue-color);
}
.rating__sr {
  clip: rect(1px, 1px, 1px, 1px);
  overflow: hidden;
  position: absolute;
  width: 1px;
  height: 1px;
}

@media (prefers-color-scheme: dark) {
  :root {
    --bg: #17181c;
    --fg: #e3e4e8;
  }

  .rating {
    margin: auto;
  }
  .rating__star-stroke {
    stroke: #454954;
  }
}
@keyframes starRing {
  from, 20% {
    animation-timing-function: ease-in;
    opacity: 1;
    r: 8px;
    stroke-width: 16px;
    transform: scale(0);
  }
  35% {
    animation-timing-function: ease-out;
    opacity: 0.5;
    r: 8px;
    stroke-width: 16px;
    transform: scale(1);
  }
  50%, to {
    opacity: 0;
    r: 16px;
    stroke-width: 0;
    transform: scale(1);
  }
}
@keyframes starFill {
  from, 40% {
    animation-timing-function: ease-out;
    transform: scale(0);
  }
  60% {
    animation-timing-function: ease-in-out;
    transform: scale(1.2);
  }
  80% {
    transform: scale(0.9);
  }
  to {
    transform: scale(1);
  }
}
@keyframes starStroke {
  from {
    transform: scale(1);
  }
  20%, to {
    transform: scale(0);
  }
}
@keyframes starLine {
  from, 40% {
    animation-timing-function: ease-out;
    stroke-dasharray: 1 23;
    stroke-dashoffset: 1;
  }
  60%, to {
    stroke-dasharray: 12 12;
    stroke-dashoffset: -12;
  }
}
    .contain img,.no_image{
        width: min(95%,450px);
        height: 300px;
        object-fit: contain;
        margin: auto;
    }
    .no_image{
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 27px;
        background: grey;
        color: lightgray;
    }
    .image{
        display: flex;
        justify-content: center;
        align-self: stretch
    }
    .data{
        border-bottom: 1px solid lightgrey;
        border-top: 1px solid lightgrey;
        justify-content: space-around;
        flex-wrap: wrap
    }
    .data-container{
        display: flex;
        flex-direction: column;
        margin: auto;
    }
</style>
    @if (strlen($post->small_description) > 0)
        <meta name="description" content="{{$post->small_description}}">
    @endif
@endsection
@section('title')
    {{$post->title}} | details
@endsection
@section('content')
    <div class="contain blackwhite m-3 p-2">
        <div class="title text-center">
            <h3 style="color:var(--blue-color)">{{$post->title}}</h3>
        </div>
        <div class="data-container">
            <div class="image">
                @if (!empty($post->image))
                    <img class="my-4" src="{{asset('storage/images/'.$post->image)}}" alt="" srcset="">
                @else
                    <div class="no_image my-2">
                        No image
                    </div>
                @endif
            </div>
            <div class="data p-2 d-flex">
            <div class="left">
                <span style="color: var(--form-text)">
                    Category:</span>
                <a class="text-blue text-decoration-none" href="{{route('category',[$post->category->slug])}}">
                    {{$post->category->name}}
                </a>
            </div>
            <div class="right">
                 {{$post->created_at->diffForHumans()}}
            </div>
            </div>
        </div>
        <div style="opacity: .8" class="text-center pt-2 px-3 description"
        >{!!$post->description!!}</div>

    </div>
    @livewire('comments', ['post_id' => $post->id])
    <script>
      const url = window.location.href.split('#')
  const comment =  document.getElementById(url[1])
  if (comment) {
    document.querySelectorAll('.comment').forEach(comment => {
    comment.classList.remove('active')
    comment.classList.add('no_active')
  });
  comment.classList.add('active')   
  }

    </script>
@endsection