<?php

namespace App\Http\Livewire;

use App\Models\AdminMessage;
use Livewire\Component;
use App\Models\Comment;
use App\Models\Post;

class Comments extends Component
{
    public $body;
    public $report_reason;
    public $report_reason_other;
    public $post;
    public $rate = 3;
    public function mount($post_id)
    {
        $this->post = Post::findOrFail($post_id);
    }
    public function update_report($data)
    {
        $dataarray = array($data);
        array_merge($this->report_reason,$dataarray);
    }
    public function render()
    {
        $comments = Comment::WhereBelongsTo($this->post)->orderBy('created_at',"DESC")->with('user')->get();
        $avg_rate = $comments->avg('rate');
        return view('livewire.comments',compact('comments','avg_rate'));
    }
    public function update_comments()
    {
        $this->render();
    }
    public function resetInputs()
    {
        $this->body = null;
        $this->rate = 1;
    }
    public function addComment($post_id)
    {
        $post = Post::findOrFail($post_id);
            if (auth()->check()) {
                $this->validate([
                    'body'=>'required',
                    'rate'=>'required|integer',
                ]);
                Comment::create([
                    'name'=>auth()->user()->name,
                    'post_id'=>$post->id,
                    'user_id'=>auth()->user()->id,
                    'body'=>$this->body,
                    'rate'=>$this->rate
                ]);
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'comment added successfully']);
                $this->resetInputs();
                $this->update_comments();
               } else {
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'error',  'message' => 'you must login first']);
               }
     
       
    }
    public function delete_comment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        if (auth()->check()) {
            if ($comment->id == auth()->user()->id 
                || auth()->user()->admin == 1) {
                $comment->delete();
                $this->update_comments();
                $this->dispatchBrowserEvent('alert', 
                ['type' => 'success',  'message' => 'comment deleted successfully']);
            }else {
                abort(403);
            }
        }else {
            $this->dispatchBrowserEvent('alert', 
            ['type' => 'error',  'message' => 'you must login first']);
        }
    }
    public function reset_report ()
    {
        $this->report_reason = null;
        $this->report_reason_other = null;
    }
    public function get_data_report($id)
    {
        $this->reset_report();
        $Comment = Comment::where('id','=',$id)->first();
        if ($Comment) {
            return true;
        }else {
            $this->dispatchBrowserEvent('alert', 
                ['type' => 'error',  'message' => 'comment not found']);
            $this->dispatchBrowserEvent('closeReport');
            return redirect(request()->header('Referer'));
            
        }
    }
    public function report_comment($comment_id)
    {
        $this->validate([
            'report_reason' => 'required'
        ]);
        $data = [];
        $comment = Comment::findOrFail($comment_id);
        array_push($data,$this->report_reason);
        if (!empty($this->report_reason_other)) {
            array_push($data,'other data'.$this->report_reason_other);
        }
        AdminMessage::create([
            'type' => 'comment-report',
            'body' => $data,
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'comment_id' => $comment_id
        ]);
        $this->reset_report();
        $this->dispatchBrowserEvent('alert', 
            ['type' => 'success',  'message' => 'repport success']);
    }
}
