<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CompanyPost extends Component
{
    public object $company;

    public function __construct($company)
    {
     $this->company = $company;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.company-post');
    }
}
