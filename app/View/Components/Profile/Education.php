<?php

namespace App\View\Components\Profile;

use App\Enums\EducationTypeEnum;
use Illuminate\View\Component;

class Education extends Component
{
    public array $education = [];

    public function __construct($data)
    {
        $type = EducationTypeEnum::getKeyWithLang();
        foreach ($type as $key => $value) {
            $this->education[$key] = $data->education()
                ->where('type', $value)
                ->get();
        }
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.profile.education');
    }
}
