@extends('themeMain.master')

@section('content')

    <div class="show-job-detail mt-md-2">
        <div class="container">
            <div class="box-detail-job">
                <div class="box-job__header bg-white  d-flex p-3 rounded">
                    <div class="box-right mr-2">
                        <a class="box-right__link d-flex justify-content-center align-items-center" href="#">
                            <img class="link__img"
                                 src="{{asset('storage/'.$company->logo)}}"
                                 alt="logo-company-name">
                        </a>
                    </div>
                    <div class="box-center mr-2">
                        <h1 class="text-primary font-24 mt-0">{{$post->job_title}}</h1>
                        <a href="{{route('company.show', $company->id)}}">
                            <h3 class="text-cl-main font-22 mt-0">{{$company->name}}</h3>
                        </a>
                        <div class="">
                            <i class="mdi mdi-briefcase-clock-outline"></i>
                            <span>{{__('frontPage.dl_submit')}}: {{$post->deadlineSubmit}}</span>
                        </div>
                    </div>
                    <div class="box-left ml-auto d-flex flex-column">
                        <button class="btn btn-primary open-form-apply-modal font-weight-semibold px-4">
                            <i class="mdi mdi-send mdi-18px mdi-rotate-315 "></i>
                            {{__('frontPage.btnSubmitForm')}}
                        </button>
                        <button class="btn btn-outline-primary mt-2 font-weight-semibold px-4">
                            <i class="mdi mdi-heart-outline mdi-18px"></i>
                            {{__('frontPage.btnSavePost')}}
                        </button>
                    </div>
                </div>
                <div class="box-job__body">
                    <div class="body-nav">
                        <ul class="default-ul d-flex align-items-center">
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#job-detail">{{__('frontPage.headingPostInfo')}}</a></li>
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#company-info">{{__('frontPage.headingCompanyInfo')}}</a>
                            </li>
                            <li class="mr-3 py-3"><a class="text-dark"
                                                     href="#">{{__('frontPage.headingRelatedJob')}}</a></li>
                        </ul>
                    </div>
                    <div class="body-content">
                        <div id="job-detail" class="p-3 bg-white rounded">
                            <h4 class="text-main font-22 pl-2 job-heading-main">{{__('frontPage.headingPostInfoDetail')}}</h4>
                            <div class="row">
                                <div class="col-md-9 col-sm-12">
                                    <div class="summary-post p-1">
                                        <div class="text-left">
                                            <p class="font-weight-semibold font-18">
                                                <u>{{__('frontPage.headingJobSummary')}}</u></p>
                                            <div class="mt-1 summary-box">
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                <span class="item-icon border-primary mr-2">
                                                    <i class="mdi mdi-18px text-primary mdi-currency-usd"></i>
                                                </span>
                                                    <div class="item-text">
                                                        <strong>{{__('frontPage.salaryRange')}}</strong>
                                                        <br>
                                                        <span>{{$post->salary}}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                <span class="item-icon border-primary mr-2">
                                                    <i class="mdi mdi-18px text-primary mdi-clock-outline"></i>
                                                </span>
                                                    <div class="item-text">
                                                        <strong>{{__('frontPage.workingTime')}}</strong>
                                                        <br>
                                                        <span>{{$post->workingTime}}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                <span class="item-icon border-primary mr-2">
                                                    <i class="mdi mdi-18px text-primary mdi-office-building"></i>
                                                </span>
                                                    <div class="item-text">
                                                        <strong>{{__('frontPage.workingForm')}}</strong>
                                                        <br>
                                                        <span>{{__('frontPage.' .$textWorkPlace)}}</span>
                                                    </div>
                                                </div>
                                                <div class="summary-items mb-1 d-flex align-items-center">
                                                <span class="item-icon border-primary mr-2">
                                                    <i class="mdi mdi-18px text-primary mdi-account-multiple-outline"></i>
                                                </span>
                                                    <div class="item-text">
                                                        <strong>{{__('frontPage.numberApplicants')}}</strong>
                                                        <br>
                                                        <span>{{$post->number_applicants}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="work-place-post">
                                        <p class="font-weight-semibold font-18 text-main mb-2">
                                            <u>{{__('frontPage.headingPostWorkPlace')}}</u>
                                        </p>
                                        <p class="">
                                            - {{$post->postLocation}}
                                        </p>
                                    </div>
                                    <div class="job-data">
                                        <h4 class="">{{__('frontPage.headingPostDescription')}}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_description !!}
                                        </div>
                                        <h4 class="">{{__('frontPage.headingPostRequirement')}}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_requirement !!}
                                        </div>
                                        <h4 class="">{{__('frontPage.headingPostBenefits')}}</h4>
                                        <div class="tab-content">
                                            {!! $post->job_benefit !!}
                                        </div>
                                        <div class="box-how-to-apply">
                                            <h4 class="">{{__('frontPage.headingPostApply')}}</h4>
                                            <p class="box-description">{{__('frontPage.textHowToApply')}} </p>
                                            <div class="my-1">
                                                <button class="btn btn-primary font-18 font-weight-bold open-form-apply-modal">
                                                    {{__('frontPage.btnSubmitForm')}}
                                                </button>
                                                <button class="btn btn-outline-primary ml-3 font-18 font-weight-bold ">
                                                    {{__('frontPage.btnSavePost')}}
                                                </button>
                                            </div>
                                            <span>{{__('frontPage.dl_submit')}}: {{$post->deadlineSubmit}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="post-report p-2 border">
                                        <div class="text-description">
                                            <h4 class="font-22 text-main">{{__('frontPage.headingReportPost')}}</h4>
                                        </div>
                                        <div
                                            class="post-report-icon text-danger text-error text-warning d-flex justify-content-center">
                                            <i class=" mdi mdi-close-octagon"></i>
                                        </div>
                                        <div
                                            class="btn btn-outline-danger w-100 mt-2">{{__('frontPage.headingReportPost')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="company-info" class="p-3 mt-2 bg-white rounded">
                            <div class="tab-content-introduction border-bottom">

                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="text-main font-22 pl-2 job-heading-main">{{__('frontPage.headingInfoAboutCompany'). $company->name}}</h4>
                                    <a href="#" class="text-primary font-weight-bold font-16">
                                        {{__('frontPage.headingViewCompanyPage')}}
                                        <i class="mdi mdi-arrow-top-right"></i>
                                    </a>
                                </div>
                                <div class="about-us pl-1">
                                    <span class="font-weight-semibold font-18"><u>{{__('frontPage.headingIntroduction')}}</u></span>
                                    <div class="tab-content text-justify pl-2 mt-1">
                                        {!! $company->introduction !!}
                                    </div>
                                </div>
                                <div class="scale-company pl-1">
                                    <span class="font-weight-semibold font-18"><u>{{__('frontPage.headingScale')}}</u></span>
                                    <p class="mt-1 pl-2">{{$company->number_of_employees}}</p>
                                </div>
                                <div class="location-company pl-1">
                                    <span class="font-weight-semibold font-18"><u>{{__('frontPage.location')}}</u></span>
                                    <p class="mt-1 pl-2">{{$company->addressWrap}}</p>
                                </div>
                            </div>
                            <div class="tab-content-job">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="text-main font-18 pl-2 ">
                                        <i class="mdi mdi-briefcase-clock-outline mdi-18px"></i>
                                        {{__('frontPage.headingJobSameCompany')}}</h4>
                                    <a href="#" class="text-primary font-weight-bold font-16">
                                        {{__('frontPage.watchMoreJobs')}}
                                        <i class="mdi mdi-arrow-top-right"></i>
                                    </a>
                                </div>
                                <div class="row">
                                    @foreach($relatedPosts as $relatedPost)
                                        <div class="col-md-4 col-sm-12">
                                            <x-relatedPost :relatedPost="$relatedPost"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div id="job-related" class="p-3 mt-2 bg-white rounded">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-main font-22 pl-2 job-heading-main">{{__('frontPage.headingRelatedJob')}}</h4>
                                <a href="#" class="text-primary font-weight-bold font-16">
                                    {{__('frontPage.watchMoreJobs')}}
                                    <i class="mdi mdi-arrow-top-right"></i>
                                </a>
                            </div>
                            <div class="related-list-bock">
                                @foreach($data as $post)
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
    <div class="modal fade" id="post-apply-modal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="companyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header flex-column bg-primary">
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="moodal-header__left align-self-center">
                        <h3 class="modal-title  text-white text-center text-uppercase"
                            id="companyModalLabel">{{__('frontPage.jobApplications')}}</h3>
                        <p class="font-16 text-center text-white ">{{$title}}</p>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="creat-company" action="{{route('api.handlerSubmitCv')}}"
                          method="post" id="fmSubmitCV" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">

                        @if(auth()->check())
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <div class="form-group">
                                <label class="form-label">{{__('frontPage.formFullName')}} *</label>
                                <input type="text" value="{{auth()->user()->name}}" name="name" id="company"
                                       class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="text" value="{{auth()->user()->email}}" name="email" class="form-control"
                                       required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('frontPage.formPhoneNumber')}} *</label>
                                <input type="text" value="{{auth()->user()->phone}}" name="phone" class="form-control "
                                       required>
                            </div>
                        @else
                            <div class="form-group">
                                <label class="form-label">{{__('frontPage.formFullName')}} *</label>
                                <input type="text" name="name" id="company" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email *</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label">{{__('frontPage.formPhoneNumber')}} *</label>
                                <input type="text" name="phone" class="form-control " required>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="form-label">{{__('frontPage.formCoverLetter')}}</label>
                            <textarea name="cover_letter" class="form-control" required></textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>CV</label>
                                <input type="file" name="cv" id="" class="form-control" required>
                                <span class="form-message text-danger"></span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="submitForm('#fmSubmitCV')">
                        {{__('frontPage.btnSubmitForm')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.open-form-apply-modal').click(function () {
                $('#post-apply-modal').modal()
            });

        });

        function submitForm(type) {
            const form = $(type);
            let formData = new FormData(form[0]);
            let redirect = form.attr('redirect');
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                async: false,
                cache: false,
                enctype: 'multipart/form-data',
                success: function (response) {
                    console.log(response.data);
                    notifySuccess();
                },
                error: function (response) {
                    console.log(response);
                    notifyError();
                }
            });
        }

        $('.related-list-bock').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            autoplay: true,
            autoplaySpeed: 4000,
            prevArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-prev"><i class="fa-solid fa-chevron-left text-white font-20"></i></button>',
            nextArrow: '<button type="button" class="d-flex justify-content-center align-items-center btn btn-slide rounded-circle slick-next"><i class="fa-solid fa-chevron-right text-white font-20"></i></button>',
        })

    </script>
@endpush
