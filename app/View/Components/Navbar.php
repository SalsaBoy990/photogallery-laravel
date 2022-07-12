<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public string $userName;
    public string $avatar;

    /**
     * Create a new component instance.
     * 
     * @param string $userName
     * @param string $avatar
     *
     * @return void
     */
    public function __construct(string $userName = '', string $avatar = '')
    {
        $this->userName = $userName;
        $this->avatar = $avatar;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.navbar');
    }
}
