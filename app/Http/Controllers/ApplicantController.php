<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ApplicantController extends Controller
{
    public function profile()
    {
//        $title = 'My Profile';
        return view('applicant.profile', [
//            'title'=>$title,
        ]);
    }
    public function cvManage()
    {
        $title = 'My CV';
        return view('applicant.cvManage', [
            'title'=>$title,
        ]);
    }
}
