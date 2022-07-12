<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public string $copyrightText;

    /**
     * Create a new component instance.
     *
     * @param string $copyrightText
     * 
     * @return void
     */
    public function __construct(string $copyrightText = '')
    {
        $this->copyrightText = $copyrightText;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.footer');
    }
}
