<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Page;

class DeletePost extends Component
{
    public $post;

    public function delete_post()
    {
        $page = Page::where('facebook_page_id', '=', $this->post->page_id )->first();

        $response = Http::withToken($page->facebook_page_access_token)
            ->delete("https://graph.facebook.com/".$this->post->post_id);
        $body = $response->body();
        Log::alert($body);

        DB::table('posts')->where('post_id', '=', $this->post->post_id)->delete();
        $this->emitUp('refresh');
    }

    public function render()
    {
        return view('livewire.delete-post');
    }
}
