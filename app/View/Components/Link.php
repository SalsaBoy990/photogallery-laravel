<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Link extends Component
{

    public string $route;
    public string $iconName;
    public string $linkText;
    public string $title; // title attribute
    public string $linkType; // title attribute

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $route = '', string $iconName = '', string $linkText = '', string $title = '', string $linkType = 'primary')
    {
        $this->route    = $route;
        $this->iconName = $iconName;
        $this->linkText = $linkText;
        $this->title    = $title;
        $this->linkType = $linkType;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.generic.link');
    }
}
