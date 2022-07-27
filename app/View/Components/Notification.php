<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Notification extends Component
{
    public string $message;
    public string $type;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $message = '', string $type = '')
    {
        $this->message = $message;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.notification');
    }
}
