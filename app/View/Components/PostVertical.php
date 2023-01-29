<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PostVertical extends Component
{
   public object $post;
   public array $languages;
    public function __construct($post)
    {
        $this->post = $post;
        $this->languages =  $post->languages->pluck('name')->toArray();

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.post-vertical');
    }
}
