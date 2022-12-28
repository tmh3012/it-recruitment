@extends('themeMain.master')

@section('content')
    <section class="slide-show" id="slide-show">
        @include('themeMain.slideShow')
    </section>
    <div class="job-home-pg mt-md-5">
        <div class="container">
            <div class="job-home__head text-center">
                <h2 class="text-cl-main">Job of the day</h2>
                <p class="font-lg">Search and connect with the right candidates faster.</p>
            </div>
            <div class="job-home__tab tab-show-jobs mt-4">
                <div class="row">

                    @foreach($posts as $post)
                        <div class="col-lg-3 col-md-6 col-sm-6">
                        <x-post :post="$post"/>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
