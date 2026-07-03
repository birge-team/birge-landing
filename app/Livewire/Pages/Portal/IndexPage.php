<?php

namespace App\Livewire\Pages\Portal;

use App\Models\Article;
use App\Models\Expert;
use Livewire\Component;

class IndexPage extends Component
{
    public array $expertise = [];

    public $experts;
    public $articles;

    public function render()
    {
        return view('livewire.pages.portal.index-page');
    }

    public function mount() {
        $this->expertise = __('portal.items');
        $this->experts = Expert::query()->with('media')->get();
        $this->articles = Article::query()->with('media')->get();
    }
}
