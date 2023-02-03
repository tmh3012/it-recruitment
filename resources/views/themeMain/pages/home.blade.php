@extends('themeMain.master')

@section('content')
    <section class="slide-show" id="slide-show">
        @include('themeMain.slideShow')
    </section>
    <div class="job-home-pg mt-md-2 pt-4 bg-white">
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
@push('js')
    <script src="{{asset('js/ion.rangeSlider.min.js')}}"></script>
    <script src="{{asset('js/component.range-slider.js')}}"></script>
    <script>
        $(document).ready(function () {
            //    handler ever search advanced
            let boxSearchAdv = $('.box-search-advance');
            let boxSearch = $('.box-search');
            const btnLessBoxSearch = boxSearch.find('.btn-less');
            boxSearch.on('focus', '.search-input input[name="keyword"]', function () {
                boxSearchAdv.slideToggle()
            })
            btnLessBoxSearch.click(function () {
                boxSearchAdv.slideToggle()
            })
        });

        $(document).ready(function () {
            const ft_jobs = $('#fr_jobs');
            const rangeSalary = $('#range_salary');
            const min_salary = $('#min_salary');
            const max_salary = $('#max_salary');

            $('#frm-search-jobs').on('change', '#range_salary', function () {
                let range = $(this).val().split(';');
                min_salary.val(range[0]);
                max_salary.val(range[1]);
                console.log('min salary: ', min_salary.val());
                console.log('max salary:', max_salary.val());
            });

            // function filter
        });
    </script>
@endpush
