@extends('themeMain.master')

@section('content')
    <div class="show-job-detail mt-md-2">
        <div class="container">
            <div class="box-detail-job">
                <div class="box-job__header bg-white  d-flex p-3 rounded">
                    <div class="box-right mr-2">
                        <a class="box-right__link d-flex justify-content-center align-items-center"
                           href="{{ route('company.show', $company->id) }}">
                            <img class="link__img" src="{{ asset('storage/' . $company->logo) }}"
                                 alt="logo-company-name">
                        </a>
                    </div>
                    <div class="box-center mr-2">
                        <h1 class="text-primary font-24 mt-0">{{ $post->job_title }}</h1>
                        <a href="{{ route('company.show', $company->id) }}">
                            <h3 class="text-cl-main font-22 mt-0">{{ $company->name }}</h3>
                        </a>
                        <div class="">
                            <i class="mdi mdi-briefcase-clock-outline"></i>
                            <span>{{ __('frontPage.dl_submit') }}: {{ $post->deadlineSubmit }}</span>
                        </div>
                    </div>
                    <div class="box-left ml-auto d-flex flex-column">
                        <button class="btn btn-primary open-form-apply-modal font-weight-semibold px-4"
                                @if (!$postReceived) disabled @endif>
                            <i class="mdi mdi-send mdi-18px mdi-rotate-315 "></i>
                            {{ __('frontPage.btnSubmitForm') }}
                        </button>
                        <button
                            class="btn btn-outline-success btn-save-post @if($postSaved) active @endif mt-2 font-weight-semibold px-4"
                            post-id="{{$post->id}}">
                            @if($postSaved) {{ __('frontPage.btnSavedPost') }} @else {{ __('frontPage.btnSavePost') }} @endif
                        </button>
                    </div>
                </div>
                <div class="box-job__body">
                    <div class="body-nav">
                        <ul class="default-ul d-flex align-items-center">
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#job-detail">{{ __('frontPage.headingPostInfo') }}</a></li>
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#company-info">{{ __('frontPage.headingCompanyInfo') }}</a>
                            </li>
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#">{{ __('frontPage.headingRelatedJob') }}</a></li>
                        </ul>
                    </div>
                    <div class="body-content">
                        <div id="job-detail" class="p-3 bg-white rounded">
                            <h4 class="text-main font-22 pl-2 job-heading-main">{{ __('frontPage.headingPostInfoDetail') }}
                            </h4>
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="summary-post p-1">
                                        <div class="text-left">
                                            <p class="font-weight-semibold font-18">
                                                <u>{{ __('frontPage.headingJobSummary') }}</u>
                                            </p>
                                            <div class="mt-1 summary-box">
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                    <span class="item-icon border-primary mr-2">
                                                        <i class="mdi mdi-18px text-primary mdi-currency-usd"></i>
                                                    </span>
                                                    <div class="item-text">
                                                        <strong>{{ __('frontPage.salaryRange') }}</strong>
                                                        <br>
                                                        <span>{{ $post->salary }}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                    <span class="item-icon border-primary mr-2">
                                                        <i class="mdi mdi-18px text-primary mdi-clock-outline"></i>
                                                    </span>
                                                    <div class="item-text">
                                                        <strong>{{ __('frontPage.workingTime') }}</strong>
                                                        <br>
                                                        <span>{{ $post->workingTime }}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                    <span class="item-icon border-primary mr-2">
                                                        <i class="mdi mdi-18px text-primary mdi-office-building"></i>
                                                    </span>
                                                    <div class="item-text">
                                                        <strong>{{ __('frontPage.workingForm') }}</strong>
                                                        <br>
                                                        <span>{{ __('frontPage.' . $textWorkPlace) }}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                    <span class="item-icon border-primary mr-2">
                                                        <i
                                                            class="mdi mdi-18px text-primary mdi-account-multiple-outline"></i>
                                                    </span>
                                                    <div class="item-text">
                                                        <strong>{{ __('frontPage.numberApplicants') }}</strong>
                                                        <br>
                                                        <span>{{ $post->number_applicants }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="work-place-post">
                                        <p class="font-weight-semibold font-18 text-main mb-2">
                                            <u>{{ __('frontPage.headingPostWorkPlace') }}</u>
                                        </p>
                                        <p class="">
                                            - {{ $post->postLocation }}
                                        </p>
                                    </div>
                                    <div class="job-data">
                                        <h4 class="">{{ __('frontPage.headingPostDescription') }}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_description !!}
                                        </div>
                                        <h4 class="">{{ __('frontPage.headingPostRequirement') }}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_requirement !!}
                                        </div>
                                        <h4 class="">{{ __('frontPage.headingPostBenefits') }}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_benefit !!}
                                        </div>
                                        <div class="box-how-to-apply">
                                            <h4 class="">{{ __('frontPage.headingPostApply') }}</h4>
                                            <p class="box-description">{{ __('frontPage.textHowToApply') }} </p>
                                            <div class="my-1">
                                                <button
                                                    class="btn btn-primary font-18 font-weight-bold open-form-apply-modal "
                                                    @if (!$postReceived) disabled @endif>
                                                    {{ __('frontPage.btnSubmitForm') }}
                                                </button>
                                                <button
                                                    class="btn btn-outline-success btn-save-post @if($postSaved) active @endif ml-3 font-18 font-weight-bold"
                                                    post-id="{{$post->id}}">
                                                    @if($postSaved) {{ __('frontPage.btnSavedPost') }} @else {{ __('frontPage.btnSavePost') }} @endif
                                                </button>
                                            </div>
                                            <span>{{ __('frontPage.dl_submit') }}: {{ $post->deadlineSubmit }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="post-report p-2 border">
                                        <div class="text-description">
                                            <h4 class="font-22 text-main">{{ __('frontPage.headingReportPost') }}</h4>
                                        </div>
                                        <div
                                            class="post-report-icon text-danger text-error text-warning d-flex justify-content-center">
                                            <i class=" mdi mdi-close-octagon"></i>
                                        </div>
                                        <div class="btn btn-outline-danger w-100 mt-2">
                                            {{ __('frontPage.headingReportPost') }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-info" class="p-3 mt-2 bg-white rounded">
                            <div class="tab-content-introduction border-bottom">

                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="text-main font-22 pl-2 job-heading-main">
                                        {{ __('frontPage.headingInfoAboutCompany') . $company->name }}</h4>
                                    <a href="{{ route('company.show', $company->id) }}"
                                       class="text-primary font-weight-bold font-16">
                                        {{ __('frontPage.headingViewCompanyPage') }}
                                        <i class="mdi mdi-arrow-top-right"></i>
                                    </a>
                                </div>
                                <div class="about-us pl-1 @empty($company->introduction) d-none @endempty ">
                                    <span
                                        class="font-weight-semibold font-18"><u>{{ __('frontPage.headingIntroduction') }}</u></span>
                                    <div class="tab-content text-justify pl-2 mt-1">
                                        {!! $company->introduction !!}
                                    </div>
                                </div>
                                <div class="scale-company pl-1 @empty($company->number_of_employees)d-none  @endempty ">
                                    <span
                                        class="font-weight-semibold font-18"><u>{{ __('frontPage.headingScale') }}</u></span>
                                    <p class="mt-1 pl-2">{{ $company->number_of_employees }}</p>
                                </div>
                                <div class="location-company pl-1">
                                    <span
                                        class="font-weight-semibold font-18"><u>{{ __('frontPage.location') }}</u></span>
                                    <p class="mt-1 pl-2">{{ $company->addressWrap }}</p>
                                </div>
                            </div>
                            <div class="tab-content-job @isset($relatedPosts) d-none @endisset">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="text-main font-18 pl-2 ">
                                        <i class="mdi mdi-briefcase-clock-outline mdi-18px"></i>
                                        {{ __('frontPage.headingJobSameCompany') }}
                                    </h4>
                                    <a href="{{ route('company.show', $company->id) }}"
                                       class="text-primary font-weight-bold font-16">
                                        {{ __('frontPage.watchMoreJobs') }}
                                        <i class="mdi mdi-arrow-top-right"></i>
                                    </a>
                                </div>
                                <div class="row">
                                    @foreach ($relatedPosts as $relatedPost)
                                        <div class="col-md-4 col-sm-12">
                                            <x-relatedPost :relatedPost="$relatedPost"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="job-related" class="p-3 mt-2 bg-white rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-main font-22 pl-2 job-heading-main">
                                    {{ __('frontPage.headingRelatedJob') }}</h4>
                                <a href="{{ route('jobs-page') }}" class="text-primary font-weight-bold font-16">
                                    {{ __('frontPage.watchMoreJobs') }}
                                    <i class="mdi mdi-arrow-top-right"></i>
                                </a>
                            </div>
                            <div class="related-list-bock">
                                @foreach ($data as $post)
                                    <x-post :post="$post"/>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->

    @includeWhen(auth()->check(), 'modal.formApplyPost')
    @includeUnless(auth()->check(), 'modal.modalLogin')
@endsection
@push('js')
    <script type="text/javascript">
        let btnSavePost = document.querySelectorAll('.btn.btn-save-post');
        let handlerSave, postId, auth;
        @if(auth()->check())
            auth = true;
        @else
            auth = false;
        @endif
            for (const btnSave of btnSavePost) {
            btnSave.onclick = function () {
                if (auth) {
                    handlerSave = this.classList.contains('active') ? false : true;
                    postId = this.getAttribute('post-id');
                    let data = {
                        'post_id': postId,
                    }
                    if (handlerSave) {
                        handlerSavedPost(data)
                        Array.from(btnSavePost).forEach(function (el) {
                            el.classList.add('active');
                            handlerEditNameButton(el, '{{__('frontPage.btnSavedPost')}}');
                        });
                    } else {
                        handlerUnSavedPost(data);
                        Array.from(btnSavePost).forEach(function (el) {
                            el.classList.remove('active');
                            handlerEditNameButton(el, '{{__('frontPage.btnSavePost')}}');
                        });
                    }
                } else {
                    $('#post-apply-modal').modal()
                }
            }
        }


        function handlerSavedPost(data) {
            let url = '{{ route('api.user.postUser.store') }}' + '/' + data.post_id;
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
                        notifySuccess('Successfully saved post');
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

        function handlerUnSavedPost(data) {
            console.log('delete item ' + data.post_id);

            let url = '{{ route('api.user.postUser.destroy') }}' + '/' + data.post_id;
            let options = {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            };
            fetch(url, options)
                .then((response) => {
                    return response.json()
                })
                .then((response) => {
                    notifySuccess('Successfully');
                })

        }


        $(document).ready(function () {

            $('.open-form-apply-modal').click(function () {
                $('#post-apply-modal').modal()
            });

            $('.related-list-bock').slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 3,
                autoplay: true,
                autoplaySpeed: 4000,
                prevArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-prev"><i class="fa-solid fa-chevron-left text-white font-20"></i></button>',
                nextArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-next"><i class="fa-solid fa-chevron-right text-white font-20"></i></button>',
            })
        });
    </script>
@endpush
