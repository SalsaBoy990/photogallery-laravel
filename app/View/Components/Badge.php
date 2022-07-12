<?php

namespace App\View\Components;

use Illuminate\Validation\Rules\Enum;
use Illuminate\View\Component;

class Badge extends Component
{
    public int $tagId;
    public string $tagName;
    public int $galleryId;
    public string $mode;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $tagId, string $tagName, int $galleryId = 0, string $mode = 'detach')
    {
        $this->tagId = $tagId;
        $this->tagName = $tagName;
        $this->tagName = $tagName;
        $this->galleryId = $galleryId;
        $this->mode = $mode;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.badge');
    }
}
