<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Breadcrumb extends Component
{

    public string $pageTitle;
    public string $indexPage;
    public string $parentPage;
    public string $indexPageRoute;
    public string $parentPageRoute;
    public int $entityId;
    public int $parentEntityId;


    /**
     * 
     * 
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $indexPage = 'Galériák', string $parentPage = '', string $pageTitle = '', string $indexPageRoute = 'gallery.index', string $parentPageRoute = 'gallery.show', int $entityId = 0, int $parentEntityId = 0)
    {
        $this->pageTitle = $pageTitle;
        $this->indexPage = $indexPage;
        $this->parentPage = $parentPage;
        $this->indexPageRoute = $indexPageRoute;
        $this->parentPageRoute = $parentPageRoute;
        $this->entityId = $entityId;
        $this->parentEntityId = $parentEntityId;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb');
    }
}
