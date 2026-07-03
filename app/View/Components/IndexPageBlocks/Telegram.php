<?php

namespace App\View\Components\IndexPageBlocks;

use App\Models\TelegramPost;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Telegram extends Component
{
    public array $telegramPosts;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->telegramPosts = TelegramPost::query()->get()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.index-page-blocks.telegram');
    }
}
