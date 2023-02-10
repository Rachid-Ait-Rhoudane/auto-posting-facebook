<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Post;

class PostsTable extends Component
{
    public $posts;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->posts = Post::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.posts-table');
    }
}
