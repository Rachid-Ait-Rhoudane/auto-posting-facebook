<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DeletePage extends Component
{
    public $page;

    public function delete_page()
    {
        DB::table('pages')->where('id', '=', $this->page->id)->delete();
        $this->emitUp('refresh');
    }

    public function render()
    {
        return view('livewire.delete-page');
    }
}
