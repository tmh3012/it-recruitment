@extends('themeMain.master')
@section('content')
    <div class="jobs-page bg-white">
        <div class="container pt-4">
            <div class="banner-block bg-cus pt-5 pb-5 pr-1 pl-1">
                <div class="text-center">
                    <h2 class="text-cl-main text-capitalize">
                        <span class="text-cl-cus text-primary">22 Jobs </span>
                        Available Now
                    </h2>
                    <p class="text-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vero
                        repellendus magni,<br>
                        atque delectus molestias quis?</p>
                </div>

            </div>

            <div class="job-home__tab tab-show-jobs mt-4">
                <div class="row">
                    <div class="col-md-3 col-sm-12 pr-md-4">
                        <div class="filter-job-top ">
                            @include('themeMain.sidebar')
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="row show-post">
                            @foreach($posts as $post)
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <x-post :post="$post"/>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-12">
                            <ul class="pagination pagination-info">
                                {{ $posts->appends(request()->all())->links() }}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('js/ion.rangeSlider.min.js')}}"></script>

    <script src="{{asset('js/component.range-slider.js')}}"></script>
@endpush
