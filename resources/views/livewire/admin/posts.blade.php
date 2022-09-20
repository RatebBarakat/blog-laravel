<div class="mb-4 col-sm">
	<div class="projects-inner">
		<header class="projects-header d-flex" style="justify-content: space-between">
			<div class="title">Posts
    		<div class="count">[{{$posts->total()}}] <i class="zmdi zmdi-download"></i></div>
      </div>
      <div class="center">
        <input type="search" name="search" id="search" wire:model="search" placeholder="..search" 
        wire:input="search">
        <select name="select" id="select" wire:model="category_filter">
          <option value="{{null}}"></option>
          @foreach ($categories as $cat)
              <option value="{{$cat->id}}">{{$cat->name}}</option>
          @endforeach
        </select>
        <select wire:model="perPage" wire:change="filter" name="" id="">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="right">
        <a href="{{route('post.create')}}"  
        type="button" class="btn btn-outline-primary btn-sm">
          add
        </a>
      </div>
    </header>
        {{-- add Post --}}
          <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                  <button type="button" 
                  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form wire:submit.prevent="addPost" method="POST" autocomplete="off">
                    @csrf
                    @if ($errors->any())
    <div class="alert alert-danger container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label  for="email">title<span style="color:red">*</span></label>
                            <input wire:model="title" wire:input="slug"
                             class="form-control" type="text" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label for="email">slug<span style="color:red">*</span></label>
                          <input wire:model="slug" class="form-control" type="text" name="email" id="email">
                      </div>
                        <div class="form-group">
                          <span>
                            small_description
                          </span>
                          <textarea wire:model.defer="small_description"
                           class="form-control" id="exampleFormControlTextarea1" 
                           rows="3"></textarea>
                        </div>
                        <div id="addt" class="form-group" wire:ignore>
                          <span>
                            description
                          </span>
                          <textarea  style="color: black !important"
                           class="form-control"wire:model="description" 
                          id="addtextarea" rows="10"></textarea> 
                        </div>
                        <div class="form-group">
                          <input type="file" wire:model="image" class="form-control my-1">
                         @if ($image)
                             <div class="f-flex">
                              Image previou:
                              <img class="mt-1" src="{{!empty($image)?$image->temporaryUrl():
                                'storage/'.$image}}" alt="">
                             </div>
                         @endif
                        </div>
                        <div class="form-select">
                          <select name="select" id="select" wire:model="category_id">
                            <option value="" selected></option>
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                          </select>
                        </div>

                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">add</button>
                      </div>
                </form>
              </div>
            </div>
          </div>
          {{-- end add --}}
          {{-- edit --}}
          <div wire:ignore.self  class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel">update</h5>
                  <button type="button" 
                  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form wire:submit.prevent="updatePost()" method="POST" autocomplete="off">
                    @csrf
                    @if ($errors->any())
                    <div class="alert alert-danger container">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="modal-body">
                        <div class="form-group">
                            <label  for="email">title<span style="color:red">*</span></label>
                            <input  wire:model="title"
                             class="form-control" wire:input="slug" type="text" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label for="email">slug<span style="color:red">*</span></label>
                          <input  wire:model="slug" class="form-control" type="text" name="email" id="email">
                      </div>
                        <div class="form-group">
                          <span  >
                            small_description
                          </span>
                              <textarea class="form-control" 
                              wire:model.defer="small_description"
                               id="exampleFormControlTextarea1" rows="3">
                              </textarea>

                        </div>
                        <div class="form-group" @trix-blur="$dispatch('input',$description_edit)">

                          <div> <!-- top-most div don't attach livewire-->
                            <textarea style="visibility: hidden" id="body"
                             wire:model="description_edit"  value="{{$description_edit}}"
                                type="hidden" name="content">{{$description_edit}}</textarea>
                            <div class="form-group"
                            wire:ignore>
                                <label class="block text-gray-700 text-sm text-xl font-bold mb-2"
                                 for="order">
                                  description
                                </label>
                                
                                <trix-editor style="color: white;
                                border: 1px solid white !important;
                                min-height: 300px;
                                outline: none;" wire:model="description_edit"
                              
                                input="body"></trix-editor>
                                @error('description')
                                <p class="text-red-700 font-semibold mt-2">
                                    {{$message}}
                                </p>
                                @enderror
                            </div>
                        </div>

                        </div>
                        <div class="form-group">
                          <div>
                            dont put file if you wnat to change
                          </div>
                          <input type="file" wire:model="new_edit_image" class="form-control my-1"
                           placeholder="dont pu file if you wnat to change">
                          @if ($old_edit_image)
                        @if (empty($new_edit_image))
                        <div class="d-flex">
                          Photo Preview:
                        <img class="mt-1" style="width: 200px;height: auto;margin: auto;" 
                        src="{{asset('storage/'.$old_edit_image)}}" alt="" srcset="">
                        </div>
                        @else
                        @if ($new_edit_image || $image)
                        Photo Preview:
                        <img class="mt-1"  style="width: 200px;height: auto;margin: auto;" 
                        src="{{!empty($new_edit_image)?$new_edit_image->temporaryUrl(): 'storage/'.$image}}"
                         alt="" srcset="">  
                        @endif
                        p
                        @endif 
                        @else
                        @if ($new_edit_image || $image)
                        Photo Preview:
                        <img class="mt-1"  style="width: 200px;height: auto;margin: auto;" 
                        src="{{!empty($new_edit_image)?$new_edit_image->temporaryUrl(): 'storage/'.$image}}"
                         alt="" srcset="">  
                        @endif                  
                        @endif
                        </div>
                        <div class="form-select">
                          <select name="select" id="select" wire:model="category_id">
                            @foreach ($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled"
                         type="submit" class="btn btn-primary">update</button>
                      </div>
                </form>
              </div>
            </div>
          </div>
    <div class="table-responsive mb-2">
  	<table class="projects-table table" style="color:white">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">slug</th>
        <th scope="col">small desciption</th>
        <th scope="col">desciption</th>
        <th scope="col">Post</th>
        <th scope="col">image</th>
        <th scope="col">created_at</th>
        <th scope="col">action</th>
      </tr>
    </thead>
    <tr>
      <td colspan="7" class="text-center" wire:loading wire:target="search">
        ...loading
      </td>
    </tr>
    <tbody wire:loading.remove wire:target="search">
        @forelse ($posts as $post)
        <tr>
        <th scope="row">{{$loop->iteration}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->slug}}</td>
        <td style="
        ">{{$post->small_description}}</td>
        <td style="max-width: 600px;
                  max-height: 600px;overflow: auto
        ">{{$post->description}}</td>
        <td>{{$post->category->name}}</td>
        <td>
          @if (!empty($post->image))
              <img class="mt-1" src="{{asset('storage/images/'.$post->image)}}" 
              style="width: 130px;height: auto;border-radius: 5px" alt="">
          @else
          no image
          @endif
        </td>
        <td>{{$post->created_at}}</td>
        <td>
          <span style="display: flex;flex-wrap: nowrap;justify-content: center;gap: 20px">
                            
            <span style="display: flex;align-items: center;gap: 10px;height: 100%">
                <a href="{{route('post.admin.update',[$post->id])}}" type="submit"
                  class="btn btn-outline-primary btn-sm">
                    edit
                </a>
            </span>
            <form method="post" wire:submit.prevent="deletePost({{$post->id}})">
                @csrf
                <button class="small p-1 px-3 btn btn-outline-danger btn-sm" type="submit">{{__('delete')}}</button>
            </form>
            </span>
        </td>
        @empty
            <td>
                no Post
            </td>
          </tr>
        @endforelse
    </tbody>
  </table>
    </div>
  {{$posts->links()}}

  <script>
    // trix.addEventListener('change', () => {
    //   @this.set('description')
    // })
//     $('#addtextarea').summernote({
//       tabsize: 2,
//         height: 120,
//         toolbar: [
//           ['style', ['style']],
//           ['font', ['bold', 'underline', 'clear']],
//           ['color', ['color']],
//           ['para', ['ul', 'ol', 'paragraph']],
//           ['table', ['table']],
//           ['insert', ['link', 'picture', 'video']],
//           ['view', ['fullscreen', 'codeview', 'help']]
//         ],
//   callbacks: {
//     onChange: function(contents, $editable) {
//       console.log('onChange:', contents, $editable);
//       @this.set('description',contents)
//     }
//   }
// });
var element = document.querySelector("trix-editor")

var document = element.editor.getDocument()
element.oninput = () => {
  @this.set('description',element.value)
  console.log(element.value)
}
document.toString()  // is a JavaScript string
// summernote()
  </script>
    <script>
      editModalArea.addEventListener('input',()=> {
        @this.set('description',editModalArea.value)
      })
    window.addEventListener('addPost', event => { 
        $('#exampleModal').modal('hide');
        $('#addt').css('display','none');
        $('.show').css('display','none');
    });
    window.addEventListener('updatePost', event => { 
        $('#editModal').modal('hide');
    });
    window.addEventListener('editPost', event => { 
        $('#editModal').modal('hide');
    });
    window.addEventListener('edit_description', event => {
      value = event.detail[1]
     console.log(value)
     alert(value)
     $(".editModalArea").summernote("code", "your text");
})



  </script>
</div>
</div>
</div>
</div>

