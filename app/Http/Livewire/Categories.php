<?php

namespace App\Http\Livewire;
use Livewire\Component;
use \App\Models\Category;
use Livewire\WithPagination;

class Categories extends Component
{
    use WithPagination;
    public $name = null;
    public $slug = null;
    public $visibility = 1;
    public $ads = 1;
    public $perPage = 5;
    public $search = '';
    public $product_edit_id = null;
    protected $paginationTheme = 'bootstrap';
    public function search()
    {
        if (strlen($this->search) > 0) {
            $this->resetPage();
        }
    }
    public function render()
    {
        $categories = Category::where('name','like','%'.$this->search.'%')
        ->paginate($this->perPage);
        return view('livewire.categories',compact('categories'));
    }
    public function slug()
    {
        $this->slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $this->name);
    }
    public function resetInputs()
    {
        $this->name = null;
        $this->slug = null;
        $this->visibility = 1;
        $this->ads = 1;
        $this->product_edit_id = null;
        $this->resetErrorBag();
    }

    public function update()
    {
        $this->render();
        $this->resetInputs();
    }
    public function addCategory()
    {
        $this->validate([
            'name'=>'required|unique:categories',
            'slug'=>'required|unique:categories',
            'visibility'=>'required',
            'ads'=>'required',
        ]);
        
        Category::create([
            'name'=> $this->name,
            'slug'=> $this->slug,
            'visibility'=> $this->visibility,
            'ads'=> $this->ads,
        ]);
        $this->dispatchBrowserEvent('alert', 
        ['type' => 'success',  'message' => 'category added successfully']);
        $this->dispatchBrowserEvent('addCategory');
        $this->update();
    }
    public function deleteCategory(int $category_id)
    {
        $category = Category::findOrFail($category_id);
            $category = Category::where('id','=',$category_id)->first();
            $category->delete();
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'category deleted successfully']);
    }
    public function editData(int $category_id)
    {
        $this->resetInputs();
        $category = Category::findOrFail($category_id);
            $this->product_edit_id = $category->id;
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->visibility = $category->visibility;
            $this->ads = $category->ads;
    }
    public function cancel()
    {
        $this->resetInputs();
    }
    public function updateCategory()
    {
        $category = Category::findOrFail($this->product_edit_id);
            $data = $this->validate([
            'name' => 'required|unique:categories,name,'.$this->product_edit_id, 
            'slug' => 'required|unique:categories,slug,'.$this->product_edit_id, 
            'visibility' => 'required',
            'ads' => 'required',
            ]);
            $category->update($data);
            $category->save();
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'category updated successfully']);
            $this->dispatchBrowserEvent('updateCategory');
            $this->update(); 
    }
    
    // public function edit($category_id)
    // {
    //     $this->updateMode = true;
    //     $user = Category::where('id',$category_id)->first();
    //     $this->user_id = $category_id;
    //     $this->name = $user->name;
    //     $this->slug = $user->slug;
    //     $this->visibility = $user->visibility;
    //     $this->ads = $user->ads;
    //  }
    // public function cancel()
    // {
    //     $this->updateMode = false;
    //     $this->resetInputFields();
    // }
    
    
}
