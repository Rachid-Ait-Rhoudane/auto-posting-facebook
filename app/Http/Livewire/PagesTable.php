<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Page;

class PagesTable extends Component
{
    public $pages;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->pages = Page::where('user_id', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.pages-table');
    }
}
