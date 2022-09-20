<?php

namespace App\Http\Livewire\Admin;

use App\Models\AdminMessage;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;

class CommentReport extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = null;
    public function search()
    {
        if (strlen($this->search) > 0) {
            $this->resetPage();
        }
    }
    public function render()
    {
        $comment_report = AdminMessage::whereNotNull('comment_id')
        ->where('body','like','%'.$this->search.'%')->with('comment','user')->paginate(10);

        return view('livewire.admin.comment-report',compact('comment_report'));
    }
    public function update()
    {
        $this->render();
    }
    public function delete_comment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $comment->delete();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'comment deleted successfully']);
        $this->render();
    }
}
