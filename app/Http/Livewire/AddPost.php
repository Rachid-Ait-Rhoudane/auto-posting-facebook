<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Page;
use App\Models\Post;
use DateTime;

class AddPost extends Component
{
    use WithFileUploads;

    public $pages;
    public $page = "";
    public $text = "";
    public $schedule;
    public $file;

    public function mount()
    {
        $this->pages = Page::where('user_id', auth()->user()->id)->get();
        $this->page = $this->pages[0]->id;
    }


    public function post()
    {
        $facebook_page = Page::where('id', $this->page)->first();

        if($this->file != null)
        {
            $this->validate([
                'file' => 'file|mimes:png,jpg,mp4',
            ]);
        }

        if($this->schedule != null)
        {
            $this->validate([
                'schedule' => 'date|after_or_equal:now',
            ]);

            if($this->file == null)
            {
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('message', $this->text)
                    ->attach('published', 'false')
                    ->attach('scheduled_publish_time', strtotime($this->schedule))
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/feed");
                $body = $response->json();

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'type' => "Text",
                    'date' => date('Y-m-d H:i:s', strtotime($this->schedule)),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                return redirect('/posts')->with('success_scheduled','');

            }
            else if($this->file->getMimeType() =='image/png' || $this->file->getMimeType() =='image/jpg')
            {
                $this->file->store('public/photos');
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('images', fopen($this->file->getRealPath(), 'rb'))
                    ->attach('caption', $this->text)
                    ->attach('published', 'false')
                    ->attach('scheduled_publish_time', strtotime($this->schedule))
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/photos");
                $body = $response->json();

                $fileName = $this->file->store('public/photos');

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'file_path' =>basename($fileName),
                    'type' => "Text",
                    'date' => date('Y-m-d H:i:s', strtotime($this->schedule)),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                unlink($this->file->getRealPath());

                return redirect('/posts')->with('success_scheduled','');

            }
            else if($this->file->getMimeType() == 'video/mp4')
            {
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('source', fopen($this->file->getRealPath(), 'rb'))
                    ->attach('description', $this->text)
                    ->attach('published', 'false')
                    ->attach('scheduled_publish_time', strtotime($this->schedule))
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/videos");
                $body = $response->json();

                $fileName = $this->file->store('public/videos');

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'file_path' =>basename($fileName),
                    'type' => "Text",
                    'date' => date('Y-m-d H:i:s', strtotime($this->schedule)),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                unlink($this->file->getRealPath());

                return redirect('/posts')->with('success_scheduled','');

            }

        }
        else
        {
            if($this->file == null)
            {
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('message', $this->text)
                    ->attach('is_hidden', 'false')
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/feed");
                $body = $response->json();

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'type' => "Text",
                    'date' => now(),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                return redirect('/posts')->with('success_published','');

            }
            else if($this->file->getMimeType() =='image/png' || $this->file->getMimeType() == 'image/jpg')
            {
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('images', fopen($this->file->getRealPath(), 'rb'))
                    ->attach('caption', $this->text)
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/photos");
                $body = $response->json();

                $fileName = $this->file->store('public/photos');

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'file_path' =>basename($fileName),
                    'type' => "Image",
                    'date' => now(),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                unlink($this->file->getRealPath());

                return redirect('/posts')->with('success_published','');
            }
            else if($this->file->getMimeType() == 'video/mp4')
            {
                $response = Http::withToken($facebook_page->facebook_page_access_token)
                    ->attach('source', fopen($this->file->getRealPath(), 'rb'))
                    ->attach('description', $this->text)
                    ->post("https://graph.facebook.com/".$facebook_page->facebook_page_id."/videos");
                $body = $response->json();

                $fileName = $this->file->store('public/videos');

                Post::create([
                    'post_id' => $body['id'],
                    'post' => $this->text,
                    'file_path' =>basename($fileName),
                    'type' => "Video",
                    'date' => now(),
                    'user_id' => auth()->user()->id,
                    'page_id' => $facebook_page->facebook_page_id
                ]);

                unlink($this->file->getRealPath());

                return redirect('/posts')->with('success_published','');;

            }

        }
    }

    public function render()
    {
        return view('livewire.add-post');
    }
}
