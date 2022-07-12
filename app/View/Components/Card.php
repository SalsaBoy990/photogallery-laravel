<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{

    public string $size;
    public string $height;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $size = "full", string $height = '')
    {
        $this->size = $size;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.card');
    }
}
