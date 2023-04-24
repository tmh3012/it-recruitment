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
                    <div class="company-follow ml-md-auto">
                        <button class="btn btn-success btn-follow @if($following) active @endif mt-2 " company-id="{{$company->id}}">
                            @if($following) {{__('frontPage.following')}} <i class="ml-1 fa-solid fa-check"></i> @else {{__('frontPage.follow')}} @endif
                        </button>
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
                    <div class="block-content p-3 rounded bg-white @empty($posts) d-none @endempty">
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
                                    <strong><a class="text-dark" target="_bank"
                                               href="{{$company->link}}">{{$company->link}}</a></strong>
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

    @includeUnless(auth()->check(), 'modal.modalLogin')

@endsection
@push('js')
    <script type="text/javascript">
        let btnFollow = document.querySelector('.btn.btn-follow');
        let isFollow = false, companyId, auth;
        @if($following) isFollow = true; @endif
        @if(auth()->check())
            auth = true;
        @else
            auth = false;
        @endif

            btnFollow.onclick = function () {
            if (auth) {
                // isFollow = this.classList.contains('active') ? false : true;
                companyId = this.getAttribute('company-id');
                let data = {
                    'company_id': companyId,
                }
                if (isFollow) {
                    this.classList.remove('active');
                    handlerEditNameButton(this, '{{__('frontPage.follow')}}')
                    handlerDestroyCompany(data);
                    isFollow = !isFollow;
                } else {
                    this.classList.add('active');
                    handlerEditNameButton(this, '{{__('frontPage.following')}}', '<i class="ml-1 fa-solid fa-check"></i>')
                    handlerFollowCompany(data);
                    isFollow = !isFollow;
                }
            } else {
                $('#post-apply-modal').modal()
            }
        }


        function handlerFollowCompany(data) {
            let url = '{{ route('api.user.companyFollow.follow') }}' + '/' + data.company_id;
            let options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            };

            fetch(url, options)
                .then((response) => {
                    return response.json();
                })
                .then((response) => {
                    if (response.success) {
                        notifySuccess('Following');
                        console.log(response)
                    } else {
                        notifyError(response.message);
                        console.log(response.message);
                    }

                })
                .catch((response) => {
                    notifyError('Error! Try again later');
                    console.log(response)
                });
        }
        function handlerDestroyCompany(data) {
            let url = '{{ route('api.user.companyFollow.unFollow') }}' + '/' + data.company_id;
            let options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            };
            fetch(url, options)
                .then((response) => response.json())
                .then((response) => {
                    notifySuccess('Successfully');
                })
        }

        $(document).ready(function () {

            $('.open-form-apply-modal').click(function () {
                $('#post-apply-modal').modal()
            });

            // $('.related-list-bock').slick({
            //     infinite: true,
            //     slidesToShow: 3,
            //     slidesToScroll: 3,
            //     autoplay: true,
            //     autoplaySpeed: 4000,
            //     prevArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-prev"><i class="fa-solid fa-chevron-left text-white font-20"></i></button>',
            //     nextArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-next"><i class="fa-solid fa-chevron-right text-white font-20"></i></button>',
            // })
        });
    </script>
@endpush
