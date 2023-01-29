@extends('themeMain.master')
@section('content')

    <div class="show-company-detail mt-md-2">
        <div class="container">
            <div class="box-head bg-white rounded p-1">
                <div class="cover-wrapper">
                    <img class="rounded" height="350px" width="100%" src="{{asset('storage/'.$company->cover)}}"
                         alt="{{$title}}">
                </div>
                <div class="company-short-detail d-flex mx-5">
                    <div class="company-logo">
                        <div class="company-image-logo bg-white p-1 rounded border overflow-hidden">
                            <img class="rounded" src="{{asset('storage/'.$company->logo)}}" alt="{{$title}}">
                        </div>
                    </div>
                    <div class="company-info">
                        <h1 class="font-22 text-cl-main d-inline-block mr-2">{{$title}}</h1>
                        <span class="text-black-50 font-weight-semibold font-15"> <i
                                class="mdi mdi-map-marker-outline"></i>{{$company->city}}</span>
                        <h4 class="font-16 font-weight-semibold">@if($company->mission)
                                "{{$company->mission}}"
                            @endif</h4>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-8 com-sm-12">
                    <div class="block-content p-3 rounded bg-white mb-2">
                        <h2 class="job-heading-main font-22 pl-2">{{__('frontPage.headingIntroductionFirm')}}</h2>
                        <div class="tab-content text-justify">
                            {!! $company->introduction!!}
                        </div>
                    </div>
                    <div class="block-content p-3 rounded bg-white">
                        <h2 class="job-heading-main pl-2 font-22">{{__('frontPage.headingRecruitment')}}</h2>

                        <div class="recruitment-box">
                            @foreach($posts as $post)
                                <x-postVertical :post="$post"/>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="rounded bg-white p-3 mb-2">
                        <h2 class="job-heading-main pl-2 font-22">{{__('frontPage.moreInfoFirm')}}</h2>
                        <div class="info-list">
                            <div class="info-item-wrap mb-2 d-flex align-items-center">
                                <i class="text-black-50 mdi mdi-24px mr-2 mdi-map-marker-outline"></i>
                                <div class="d-flex flex-column">
                                    <span>{{__('frontPage.addressFirm')}}</span>
                                    <strong>{{$company->location}}</strong>
                                </div>
                            </div>
                            <div class="info-item-wrap mb-2 d-flex align-items-center">
                                <i class="text-black-50 mdi mdi-24px mr-2 mdi-email-outline"></i>
                                <div class="d-flex flex-column">
                                    <span>Email</span>
                                    <strong><a class="text-dark"
                                               href="mailto:{{$company->email}}">{{$company->email}}</a></strong>
                                </div>
                            </div>
                            <div class="info-item-wrap mb-2 d-flex align-items-center">
                                <i class="text-black-50 mdi mdi-24px mr-2 mdi-phone-outline"></i>
                                <div class="d-flex flex-column">
                                    <span>{{__('frontPage.formPhoneNumber')}}</span>
                                    <strong><a href="tel:{{$company->phone}}" class="text-dark">{{$company->phone}}</a></strong>
                                </div>
                            </div>
                            <div class="info-item-wrap mb-2 d-flex align-items-center">
                                <i class="text-black-50 mdi mdi-24px mr-2 mdi-web"></i>
                                <div class="d-flex flex-column">
                                    {{--                                    <span>{{__('frontPage.headingScale')}}</span>--}}
                                    <span>website</span>
                                    <strong><a class="text-dark" target="_bank" href="{{$company->link}}">{{$company->link}}</a></strong>
                                </div>
                            </div>
                            <div class="info-item-wrap mb-2 d-flex align-items-center">
                                <i class="text-black-50 mdi mdi-24px mr-2 mdi-office-building"></i>
                                <div class="d-flex flex-column">
                                    <span>{{__('frontPage.headingScale')}}</span>
                                    <strong>{{$company->number_of_employees}}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rounded bg-white p-3 mb-2">
                        <h2 class="job-heading-main pl-2 font-22">{{__('frontPage.shareInfoFirm')}}</h2>
                        <div class="box-copy d-flex">
                            <input class="form-control mr-2" type="text" value="{{url()->current()}}" readonly>
                            <button class="btn btn-success"><i class="mdi mdi-content-copy"></i></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript">


        // $('.related-list-bock').slick({
        //     infinite: true,
        //     slidesToShow: 3,
        //     slidesToScroll: 3,
        //     autoplay: true,
        //     autoplaySpeed: 4000,
        //     prevArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-prev"><i class="fa-solid fa-chevron-left text-white font-20"></i></button>',
        //     nextArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-next"><i class="fa-solid fa-chevron-right text-white font-20"></i></button>',
        // })

    </script>
@endpush
