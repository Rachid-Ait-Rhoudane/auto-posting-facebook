<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Post;
use App\Models\Page;

class EditPost extends Component
{
    use WithFileUploads;

    public $post;
    public $text;
    public $file;
    public $page_name="";
    public $page_access_token;

    public function mount()
    {
        $page = Page::where('facebook_page_id', '=', $this->post->page_id)->first();
        $this->page_name = $page->facebook_page_name;
        $this->page_access_token = $page->facebook_page_access_token;
        $this->text = $this->post->post;
    }

    public function update()
    {
        if($this->file != null)
        {
            $this->validate([
                'file' => 'file|mimes:png,jpg,mp4',
            ]);
        }

        if($this->post->type == "Text")
        {
            $response = Http::withToken($this->page_access_token)
                ->attach('message', $this->text)
                ->post("https://graph.facebook.com/".$this->post->post_id);
            $body = $response->json();
            if($body['success'])
            {
                $post_to_update = Post::where('id', $this->post->id)->first();
                $post_to_update->post = $this->text;
                $post_to_update->save();
                return redirect('/posts')->with('success','');
            }
        }
        else if($this->post->type == "Image")
        {
            Log::alert('We do not have an endpoint to update an image post for the moment ');
        }
        else if($this->post->type == "Video")
        {
            if($this->file != null)
            {
                $response = Http::withToken($this->page_access_token)
                ->attach('source', fopen($this->file->getRealPath(), 'rb'))
                ->attach('description', $this->text)
                ->post("https://graph.facebook.com/".$this->post->post_id);

                $body = $response->json();

                $fileName = $this->file->store('public/videos');

                unlink($this->file->getRealPath());
                unlink(storage_path('app/public/videos/'.$this->post->file_path));

                if($body['success'])
                {
                    $post_to_update = Post::where('id', $this->post->id)->first();
                    $post_to_update->file_path = basename($fileName);
                    $post_to_update->save();

                    return redirect('/posts')->with('success','');
                }

            }
            else if ($this->file == null)
            {
                $response = Http::withToken($this->page_access_token)
                ->attach('source', fopen(storage_path('app/public/videos/'.$this->post->file_path), 'rb'))
                ->attach('description', $this->text)
                ->post("https://graph.facebook.com/".$this->post->post_id);

                $body = $response->json();

                if($body['success'])
                {
                    $post_to_update = Post::where('id', $this->post->id)->first();
                    $post_to_update->post = $this->text;
                    $post_to_update->save();

                    return redirect('/posts')->with('success','');
                }
            }
        }
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
