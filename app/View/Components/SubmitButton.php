<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SubmitButton extends Component
{
    public string $linkText;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $linkText = '')
    {
        $this->linkText = $linkText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.submit-button');
    }
}
