<div class="mb-4 col-sm">
	<div class="projects-inner">
		<header class="projects-header d-flex" style="justify-content: space-between">
			<div class="title">Categories
    		<div class="count">[{{$categories->total()}}] <i class="zmdi zmdi-download"></i></div>
      </div>
      <div class="center">
        <input type="search" name="search" id="search" wire:model="search" 
        wire:input="search">
        <select wire:model="perPage" name="" id="">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="50">50</option>
        </select>
      </div>
      <div class="right">
        <button  
        type="button" class="btn btn-outline-primary btn-sm"
         data-toggle="modal" data-target="#exampleModal" wire:click="resetInputs()">
          add
        </button>
      </div>
    </header>
        {{-- add category --}}
          <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                  <button type="button" 
                  class="close btn btn-outline-danger btn-sm" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form wire:submit.prevent="addCategory" method="POST" autocomplete="off">
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
                            <label  for="email">name<span style="color:red">*</span></label>
                            <input wire:model="name" wire:input="slug"
                             class="form-control" type="text" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label for="email">slug<span style="color:red">*</span></label>
                          <input wire:model="slug" class="form-control" type="text" name="email" id="email">
                      </div>
                        <div class="toggle">
                          <span style="min-width: 40px">
                            visibility
                          </span>
                            <input wire:model.defer="visibility" type="checkbox" checked>
                        </div>
                        <div class="toggle">
                          <span style="min-width: 40px">
                            ads
                          </span>
                            <input wire:model.defer="ads" type="checkbox" checked>
                        </div>
                    </div>
                      <div class="modal-footer">
                        <button wire:click="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                <form wire:submit.prevent="updateCategory()" method="POST" autocomplete="off">
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
                            <label  for="email">name<span style="color:red">*</span></label>
                            <input  wire:model="name"
                             class="form-control" wire:input="slug" type="text" name="email" id="email">
                        </div>
                        <div class="form-group">
                          <label for="email">slug<span style="color:red">*</span></label>
                          <input  wire:model="slug" class="form-control" type="text" name="email" id="email">
                      </div>
                        <div class="toggle">
                          <span style="min-width: 40px">
                            visibility
                          </span>
                            <input  wire:model.defer="visibility" type="checkbox" checked>
                        </div>
                        <div class="toggle">
                          <span style="min-width: 40px">
                            ads
                          </span>
                            <input  wire:model.defer="ads" type="checkbox" checked>
                        </div>
                    </div>
                      <div class="modal-footer">
                        <button wire:click="cancel" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-primary">update</button>
                      </div>
                </form>
              </div>
            </div>
          </div>
    <div class="table-responsive">
  	<table class="projects-table table" style="color:white">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">name</th>
        <th scope="col">slug</th>
        <th scope="col">visibility</th>
        <th scope="col">ads</th>
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
        @forelse ($categories as $category)
        <tr>
        <th scope="row">1</th>
        <td>{{$category->name}}</td>
        <td>{{$category->slug}}</td>
        <td>
          @if ($category->visibility == 1)
              <div class="alertSuccess">
                visible
              </div>
          @else
          <div class="alertDanger">
                Unvisible
          </div>
          @endif
        </td>
        <td>
          @if ($category->ads == 1)
          <div class="alertSuccess">
            visible
          </div>
      @else
      <div class="alertDanger">
            Unvisible
      </div>
      @endif
        </td>
        <td>{{$category->created_at}}</td>
        <td>
          <span style="display: flex;flex-wrap: nowrap;justify-content: center;gap: 20px">
                            
            <span style="display: flex;align-items: center;gap: 10px;height: 100%">
                <button data-toggle="modal" data-target="#editModal"
                 wire:click="editData({{$category->id}})" type="submit" class="btn btn-outline-primary btn-sm">
                    edit
                </button>
            </span>
            <form method="post" wire:submit.prevent="deleteCategory({{$category->id}})">
                @csrf
                <button class="small p-1 px-3 btn btn-outline-danger btn-sm" type="submit">{{__('delete')}}</button>
            </form>
            </span>
        </td>
        @empty
            <td>
                no category
            </td>
          </tr>
        @endforelse
    </tbody>
  </table>
  {{$categories->links()}}
  <script>
    window.addEventListener('addCategory', event => { 
        $('#exampleModal').modal('hide');
    });
    window.addEventListener('updateCategory', event => { 
        $('#editModal').modal('hide');
    });
    window.addEventListener('editCategory', event => { 
        $('#editModal').modal('hide');
    });
  </script>
</div>
</div>
</div>
</div>
