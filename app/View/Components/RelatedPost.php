<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RelatedPost extends Component
{
    public object $relatedPost;
    public array $languages;

    public function __construct($relatedPost)
    {
        $this->relatedPost = $relatedPost;
        $this->languages = $relatedPost->languages->pluck('name')->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.related-post');
    }
}
