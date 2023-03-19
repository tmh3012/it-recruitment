@extends('layout.master')
@section('content')
    <div class="block-content">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <div class="upload-profile bg-white rounded p-3 ">
                    <h4 class="text-title mb-3">Update your profile</h4>
                    <div class="box-wrap">
                        <div class="box-profile box-information mb-3">
                            <div class="box-content">
                                <div class="box-profile box-image row mb-3">
                                    <div class="col-6">
                                        <div class="box-update-avatar">
                                            <div class="box-top d-flex align-items-center justify-content-between">
                                                <div class="box-text"><h5 class="text-black-50">Avatar</h5></div>
                                                <div class="box-handler">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-edit text-primary">Edit</a>
                                                </div>
                                            </div>
                                            <div class="box-content box-image-preview w-75 mx-auto text-center">
                                                @if(user()->avatar)
                                                    <img src="{{user()->avatar}}" alt="{{user()->name.'-avatar'}}"
                                                         class="rounded-circle  w-25">
                                                @else
                                                    <img src="{{asset('img/profile_avatar.svg')}}" alt=""
                                                         class="rounded-circle w-25">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="box-update-cover">
                                            <div class="box-top d-flex align-items-center justify-content-between">
                                                <div class="box-text"><h5 class="text-black-50">Wall</h5></div>
                                                <div class="box-handler">
                                                    <a href="javascript:void(0)"
                                                       class="btn btn-edit text-primary">Edit</a>
                                                </div>
                                            </div>
                                            <div class="box-content box-image-preview w-75 mx-auto text-center">
                                                @if(user()->avatar)
                                                    <img src="{{user()->avatar}}" alt="{{user()->name.'-avatar'}}"
                                                         class="rounded-circle  w-25">
                                                @else
                                                    <img src="{{asset('img/profile_wall.svg')}}" alt=""
                                                         class="rounded-circle w-75">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form id="short-info">
                                    <div class="form-row mb-2">
                                        <div class="form-group col-6">
                                            <label for="s-info__full-name">{{__('frontPage.formFullName')}}
                                                (*)</label>
                                            <input type="text" class="form-control" id="s-info__full-name"
                                                   placeholder="{{__('auth.enterName')}}"
                                                   @if(isApplicant() && !empty(user()->name)) value="{{user()->name}}"@endif >
                                            <span class="form-message"></span>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="s-info__phone">{{__('frontPage.formPhoneNumber')}}
                                                (*)</label>
                                            <input type="text" class="form-control" id="s-info__phone"
                                                   placeholder="{{__('frontPage.placeholderYourPhone')}}"
                                                   @if(isApplicant() && !empty(user()->phone)) value=" {{user()->phone}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-row mb-2">
                                        <div class="form-group col-6">
                                            <label for="s-info__email">{{__('frontPage.emailAddress')}} (*)</label>
                                            <input type="email" class="form-control" id="s-info__email"
                                                   placeholder="{{__('auth.enterEmail')}}"
                                                   @if(isApplicant() && !empty(user()->email)) value="{{user()->email}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="s-info__website">{{__('frontPage.formAddress')}} (*)</label>
                                            <input type="text" class="form-control" id="s-info__website"
                                                   placeholder="{{__('frontPage.placeholderAddress')}}"
                                                   @if(isApplicant() && !empty(user()->city)) value="{{user()->city}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="s-info__website">{{__('frontPage.formUserLink')}}</label>
                                            <input type="text" class="form-control" id="s-info__website"
                                                   placeholder="{{__('frontPage.placeholderPersonalWebsite')}}"
                                                   @if(isApplicant() && !empty(user()->link)) value="{{user()->link}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="s-info__website">{{__('frontPage.formPosition')}}</label>
                                            <input type="text" class="form-control" id="s-info__website"
                                                   placeholder="{{__('frontPage.placeholderPosition')}}"
                                                   @if(isApplicant() && !empty(user()->position)) value="{{user()->position}}"@endif >
                                            <span class="form-message"></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="s-info__bio">{{__('frontPage.bio')}}</label>
                                        <textarea class="form-control" id="s-info__bio" rows="4"
                                                  placeholder="{{__('frontPage.placeholderBio')}}">@if(isApplicant() && !empty(user()->link))
                                                {{user()->link}}
                                            @endif</textarea>
                                        <span class="form-message"></span>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary">{{__('frontPage.formUpdateBtn')}}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-sm-12 col-md-4">
            <div class="upload-profile">
                <div class="bg-white rounded p-3 ">
                    <h4 class="text-title mb-3">Social Network</h4>
                    <div class="box-profile box-content">
                        <div class="box-social-network">
                            <form id="profile-social">
                                <div class="from-group mb-3">
                                    <label class="text-capitalize" for="ps-fb">Facebook</label>
                                    <input type="text" class="form-control"  id="ps-fb" placeholder="{{__('frontPage.placeholderSocialLink')}}"
{{--                                    @if(isApplicant() && !empty(user()->socaial)) value="" @endif--}}>
                                    <span class="form-message"></span>
                                </div>
                                <div class="from-group mb-3">
                                    <label class="text-capitalize" for="ps-google">Google</label>
                                    <input type="text" class="form-control"  id="ps-google" placeholder="{{__('frontPage.placeholderSocialLink')}}"
{{--                                    @if(isApplicant() && !empty(user()->socaial)) value="" @endif--}}>
                                    <span class="form-message"></span>
                                </div>
                                <div class="from-group mb-3">
                                    <label class="text-capitalize" for="ps-github">Github</label>
                                    <input type="text" class="form-control"  id="ps-github" placeholder="{{__('frontPage.placeholderSocialLink')}}"
{{--                                    @if(isApplicant() && !empty(user()->socaial)) value="" @endif--}}>
                                    <span class="form-message"></span>
                                </div>
                                <div class="from-group mb-3">
                                    <label class="text-capitalize" for="ps-linkedin">linkedin</label>
                                    <input type="text" class="form-control"  id="ps-linkedin" placeholder="{{__('frontPage.placeholderSocialLink')}}"
{{--                                    @if(isApplicant() && !empty(user()->socaial)) value="" @endif                                    --}}>
                                    <span class="form-message"></span>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-ps-update">{{__('frontPage.formUpdateBtn')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded p-3 mt-3 d-none">
                    <h4 class="text-title mb-3">My Skill</h4>
                    <div class="box-profile box-content">

                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>
@endsection
