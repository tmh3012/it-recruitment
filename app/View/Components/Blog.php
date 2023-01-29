<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Blog extends Component
{
    public object $blog;

    public function __construct($blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blog');
    }
}
