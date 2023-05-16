<?php

namespace App\View\Components\Profile;

use Illuminate\View\Component;

class Socials extends Component
{
    public object $socials;
    public function __construct($socials)
    {
        $this->socials = $socials;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.socials');
    }
}
