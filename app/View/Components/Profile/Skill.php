<?php

namespace App\View\Components\Profile;

use Illuminate\View\Component;

class Skill extends Component
{
   public array $skills;

    public function __construct($skills)
    {
        $this->skills = $skills;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.skill');
    }
}
