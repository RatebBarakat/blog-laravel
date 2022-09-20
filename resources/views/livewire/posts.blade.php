<div>
    <div class="search py-2 px-3">
        @if ($category->posts)
        <input type="search" name="" wire:input="search" class="p-1" id="" wire:model="search">
        @endif
        <span wire:loading.remove wire:target="search" style="color: var(--form-text)">
            {{$category->posts_count}} post</span>
    </div>
    <div class="row mx-3 contain">
        <div class="title"
        style="border-bottom: 1px solid lightgray;border-radius: 5px 5px 0 0;color:var(--blue-color)"
         class="p-2 text-center">
            {{$category->name}}
        </div>
        @forelse ($category->posts as $post)
        <div class="col-lg-4 col-md-6 col-sm-12 my-3"wire:loading.remove wire:target="search">
            <div class="course_card">
                @if (!empty($post->image))
                <div class="course_card_img">
                    <img 
                     src="{{asset('storage/images/'.$post->image)}}" alt="course"/>
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
                <a class="text-blue text-decoration-none" href="{{route('post.details',[$post->id])}}" class="nav-item btn btn-outline-primary btn-sm">view</a>
            </div>
            </div>
        </div>
        @empty
            <div class=" m-3 text-center" style="color: var(--form-text);font-size: 27px;">no posts</div>
        @endforelse
        <h2 class="text-center " style="color: var(--form-text)"
         wire:loading wire:target="search">...searching</h2>        
        @if (count($category->posts) > 0)
        @if ($category->posts_count > count($category->posts))
        <div class="col-12 text-center">
            <button wire:click="loadmore"
        class="btn btn-outline-primary align-items-end align-self-end mb-3 mt-1"
         style="width: min(100px,30%)" wire:loading.remove wire:target="search">
           load more
       </button>  
    </div>             
          @endif
        @endif
 
    </div>
