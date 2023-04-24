<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'My Profile';
        return view('applicant.profile', [
            'title'=>$title,
        ]);
    }

}