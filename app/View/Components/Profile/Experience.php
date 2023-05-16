<?php

namespace App\View\Components\Profile;

use Illuminate\View\Component;

class Experience extends Component
{
    public ?object $experiences;

    public function __construct($data)
    {
        $this->experiences = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.experience');
    }
}
