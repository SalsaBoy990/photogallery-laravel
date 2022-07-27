<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeleteButton extends Component
{
    public string $title;
    public string $iconName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $title = '', string $iconName = 'trash-can')
    {
        $this->title    = $title;
        $this->iconName = $iconName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.delete-button');
    }
}
