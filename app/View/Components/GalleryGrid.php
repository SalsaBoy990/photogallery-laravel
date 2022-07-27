<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GalleryGrid extends Component
{

    public string $galleryId;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $galleryId = '')
    {
        $this->galleryId = $galleryId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.gallery-grid');
    }
}
