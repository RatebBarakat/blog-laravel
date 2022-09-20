<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

use function PHPUnit\Framework\isEmpty;

class Posts extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $title = null;
    public $image;
    public $category_filter = null;
    public $old_edit_image;
    public $new_edit_image;
    public $slug = null;
    public $search = null;
    public $description_edit;
    public $small_description = null;
    public $description;
    public $Post_id = null;
    public $category_id = null;
    public $perPage = 5;
    public function render()
    {
        if (empty($this->category_filter)) {
            $posts = Post::latest()->where(function ($q)
            {
                $q->where('title','like',"%".$this->search."%")
                ->orWhere('description','like',"%".$this->search."%");
            })
        ->with('category')
        ->paginate($this->perPage);
        }else{
            $this->resetPage();
            $posts = Post::latest()->whereBelongsTo(Category::findOrFail($this->category_filter))
            ->where(function ($q)
            {
                $q->where('title','like',"%".$this->search."%")
                ->orWhere('description','like',"%".$this->search."%");
            })->with('category')
            ->paginate($this->perPage);
        }
        $categories = Category::all();
        return view('livewire.admin.posts',compact('posts','categories'));
    }
    public function resetInputs()
    {
        $this->title = null;
        $this->slug = null;
        $this->small_description = null;
        $this->description = null;
        $this->description_edit = null;
        $this->Post_id = null;
        $this->category_id = null;
        $this->image = null;
        $this->new_edit_image = null;
        $this->old_edit_image = null;
    }
    public function slug()
    {
        $this->slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title);
    }
    public function update()
    {
        $this->render();
        $this->resetInputs();
    }
    public function search()
    {
        if (strlen($this->search) > 0) {
            $this->resetPage();
        }
    }
    public function filter()
    {
            $this->resetPage();
    }
    
    public function addPost()
    {
        $data = $this->validate([
            'title'=>'required|unique:posts',
            'small_description'=>'required|min:35',
            'description'=>'required|min:100',
            'category_id'=>'required|integer',
            'image' => 'image|max:1024', // 1MB Max
        ]);
        $filename = $this->image->store('images','public');
         $this->image = $filename;
        Post::create([
            'title'=> $this->title,
            'slug'=> preg_replace('/[^A-Za-z0-9-]+/', '-', $this->title),
            'small_description'=> $this->small_description,
            'description'=> $this->description,
            'image'=>$this->image,
            'category_id'=>$this->category_id,
            'user_id'=>auth()->user()->id,
        ]);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'Post added successfully']);
        return redirect(request()->header('Referer'));
        $this->dispatchBrowserEvent('addPost');
        $this->update();
    }
    public function editData(int $post_id)
    {
        $this->resetInputs();
        $post = Post::with('category')->findOrFail($post_id);
            $this->Post_id = $post->id;
            $this->title = $post->title;
            $this->slug = $post->slug;
            $this->small_description = $post->small_description;
            $this->description = $post->description;
            $this->category_id = $post->category->id;
            $this->old_edit_image = $post->image;
            $this->description_edit = $post->description;
            $this->dispatchBrowserEvent('edit_description',['description',$this->description]);
    }
    public function updatePost()
    {
        $category = Post::findOrFail($this->Post_id);
            $data = $this->validate([
            'title' => 'required|unique:posts,title,'.$this->Post_id, 
            'slug' => 'required|unique:posts,slug,'.$this->Post_id, 
            'small_description' => 'required|min:3',
            'description_edit' => 'required|min:40',
            'category_id' => 'required',
            'new_edit_image' => 'nullable|image|max:1024', // 1MB Max
            ]);
            $final_data = $data;
            if ($this->new_edit_image) {
            $filename = $this->new_edit_image->store('images','public');
            $this->new_edit_image = $filename;
            $new_image = array(
                'image' => $this->new_edit_image,
            );
            $final_data = array_merge($data,$new_image);
            if (!empty($this->old_edit_image)) {
                try {
                    unlink('storage/'.$this->old_edit_image);
                } catch (\Throwable $th) {
                    abort(500);
                }
            }
            }
            $new_desc = array(
                'description' => $this->description
            );
            $final_data = array_merge($final_data,$new_desc);
            $category->update($final_data);
            $category->save();
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'category updated successfully']);
            $this->dispatchBrowserEvent('updatePost');
            $this->update(); 
    }
    public function desc_edit($description_edit)
    {
        $this->description = $description_edit;
    }
    public function deletePost(int $post_id)
    {
        $post = Post::findOrFail($post_id);
            if (strlen($post->image) > 0) {
                try {
                    unlink('storage/'.$post->image);
                } catch (\Throwable $th) {
                    abort(500);
                }
            }
            $post->delete();
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'post deleted successfully']);
    }
}
