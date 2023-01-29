@extends('themeMain.master')
@section('content')
    <div class="company-page bg-white">
        <div class="box-search-company pt-5 pb-2 ">
            <div class="container d-flex justify-content-between">
                <div class="container-left ">
                    <h1 class="title mt-0 mb-3 text-primary font-24 font-weight-bold">{{__('frontPage.companyPageDiscoverText')}}</h1>
                    <p class="description">{{__('frontPage.companyPageDiscoverTextDes')}}</p>
                    <form action="" class="fm-search-company">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" class="form-search__input"
                               placeholder="{{__('frontPage.placeholderSearchFirm')}}">
                        <button class="btn form-search__button">{{__('frontPage.search')}}</button>
                    </form>
                </div>
                <div class="container-right">
                    <div class="box-img">
                        <img src="{{asset('img/right-job-head.svg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="text-center my-4">
                <h2 class="text-cl-main text-uppercase font-22">{{__('frontPage.headingListFirm')}}</h2>
            </div>
            <div class="row">
                @foreach($data as $blog)
                    <div class="col-md-4 col-sm-6 mb-2">
                        <x-blog :blog="$blog"/>
                    </div>
                @endforeach
                <div class="col-12">
                    <ul class="pagination pagination-info">
                        {{ $data->appends(request()->all())->links() }}
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('js/ion.rangeSlider.min.js')}}"></script>

    <script src="{{asset('js/component.range-slider.js')}}"></script>
@endpush
