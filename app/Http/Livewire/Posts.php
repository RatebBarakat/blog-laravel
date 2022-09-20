<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    public $category_slug;
    public $search = null;
    public $loaditem = 10;
    public function mount($category_slug)
    {
        $this->category_slug = $category_slug;
    }
    public function loadmore()
    {
        $this->loaditem+=10;
    }
    public function render()
    {
        $category = Category::where('slug','=',$this->category_slug)
            ->where('visibility','=',1)
            ->with('posts',function($q){
                $q->where('title','like','%'.$this->search.'%')->take($this->loaditem);
            })->withCount(['posts' => function($q){
                $q->where('title','like','%'.$this->search.'%');}])->first();
        return view('livewire.posts',compact('category'));
    }
    public function search()
    {
        
    }
    
}
