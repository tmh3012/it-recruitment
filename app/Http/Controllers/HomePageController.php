<?php

namespace App\Http\Controllers;

use App\Enums\PostRemoteEnum;
use App\Models\Config;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->postApproved()
//            ->postReceived()
            ->take(8)
            ->get();
        $arrCities = getAndCachePostCities();
        $workFrom = PostRemoteEnum::getArrayWithLowerKey();
        $configs = Config::getAndCache(0);
        return view('themeMain/pages.home', [
            'posts' => $posts,
            'cities' => $arrCities,
            'workFrom' => $workFrom,
            'configs' => $configs,
        ]);
    }

    public function jobs(Request $request)
    {
        $configs = Config::getAndCache(0);
        $ft_key_word = $request->get('keyword');
        $ft_city = $request->get('city');
        $fr_min_salary = $request->get('min_salary');
        $fr_max_salary = $request->get('max_salary', $configs['filter_max_salary']);
        $fr_remote = $request->get('remote');
        $fr_can_part_time = $request->get('can_parttime');
        $arrCities = getAndCachePostCities();
        $arrRemote = PostRemoteEnum::getArrayWithLowerKey();
        $filters = [];
        if (!empty($ft_key_word)) {
            $filters['ft_key_word'] = $ft_key_word;
        }
        if (!empty($ft_city)) {
            $filters['ft_city'] = $ft_city;
        }
        if (!empty($fr_min_salary)) {
            $filters['fr_min_salary'] = $fr_min_salary;
        }
        if (!empty($fr_max_salary)) {
            $filters['fr_max_salary'] = $fr_max_salary;
        }
        if (!empty($fr_remote)) {
            $filters['fr_remote'] = $fr_remote;
        }
        if (!empty($fr_can_part_time)) {
            $filters['fr_can_part_time'] = $fr_can_part_time;
        }

        $posts = Post::query()
            ->jobsPage($filters)
            ->paginate();
        return view('themeMain/pages.jobs', [
            'posts' => $posts,
            'arrCities' => $arrCities,
            'ft_key_word' => $ft_key_word,
            'ft_city' => $ft_city,
            'fr_min_salary' => $fr_min_salary,
            'fr_max_salary' => $fr_max_salary,
            'fr_remote' => $fr_remote,
            'configs' => $configs,
            'arrRemote' => $arrRemote,
        ]);
    }

    public function show($slug)
    {
        $post = Post::query()
            ->with('company')
            ->where('slug', $slug)
            ->firstOrFail();
        $title = $post->job_title;
        $company = $post->company;
        $relatedPosts = Post::relatedPosts($post->id, $company->id)->take(3);
        $textWorkPlace = strtolower(PostRemoteEnum::getKey($post->remote));
        $languageIds = $post->languages->pluck('id')->toArray();
        $data = Post::query()
            ->select('posts.*')
            ->join('object_language', 'object_language.object_id', 'posts.id')
            ->where(function ($q) use ($slug, $languageIds) {
                $q->where('slug', '!=', $slug);
                $q->whereIn('language_id', $languageIds);
            })
            ->distinct('id')
            ->latest()
            ->get();

        $postSaved = User::checkPostSaved($post->id);
        $postReceived = $post::canApply($slug);
        return view('themeMain/pages.post_detail', [
            'data' => $data,
            'post' => $post,
            'title' => $title,
            'postSaved' => $postSaved,
            'company' => $company,
            'postReceived' => $postReceived,
            'relatedPosts' => $relatedPosts,
            'textWorkPlace' => $textWorkPlace,
        ]);
    }


    public function profile()
    {
        $title = 'E Profile';
        return view('themeMain.pages.profile', [
            'title' => $title,
        ]);
    }

    public function showProfile($userId)
    {
        $data = User::query()
            ->where('id', $userId)
            ->firstOrFail();
        $socials = $data->socials;
        $skills = $data->skills->pluck('name');
        $education = $data->education;
        $experience = $data->experience;
        $title = "$data->name | E Profile";
        return view('themeMain.pages.e-profile', [
            'data' => $data,
            'title' => $title,
            'skills' => $skills,
            'socials' => $socials,
            'education' => $education,
            'experience' => $experience,
        ]);
    }

}

