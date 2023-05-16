<?php

namespace App\View\Components\Profile;

use Illuminate\View\Component;

class AboutMe extends Component
{
    public object $profile;
    public object $socials;
    public array $skills;

    public function __construct($data)
    {
        $this->profile = $data;
        $this->skills = $data->skills->pluck('name')->toArray();
        $this->socials = $data->socials;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.about-me');
    }
}
