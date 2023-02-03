<div class="slide-block bg-gradient bg-info d-flex align-items-center justify-content-center">
    <div class="container px-5">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <h2 class="text-cl-main my-3">Tìm việc phù hợp với bạn</h2>
                <div class="form-search">
                    <form action="{{route('jobs-page')}}" id="frm-search-jobs">
                        <div class="box-search">
                            <div class="search-input">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input type="text" name="keyword" placeholder="Tên vị trị bạn muốn ứng tuyển"
                                       autocomplete="off">
                                <div class="box-search-advance">
                                    <div class="d-flex mt-2">
                                        <p class="title font-weight-bold">{{__('frontPage.searchAdv')}}</p>
                                        <div class="btn-less">{{__('frontPage.btnLess')}}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-items">
                                            <select class="form-control" name="city" id="">
                                                <option value="">Chọn thành phố</option>
                                                @foreach($cities as $city)
                                                    <option value="{{$city}}">{{$city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-items">
                                            <select class="form-control" name="remote" id="">
                                                @foreach($workFrom as $key=>$value)
                                                    <option value="{{$value}}">  {{__('frontPage.'.$key)}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-items">
                                            <label for="range_salary"
                                                   class="text-cl-main d-block">{{__('frontPage.salaryRange')}}</label>
                                            <input type="text" id="range_salary" data-plugin="range-slider"
                                                   data-type="double"
                                                   data-grid="true"
                                                   data-from="{{$configs['filter_min_salary']}}"
                                                   data-to="{{$configs['filter_max_salary']}}"
                                                   data-min="{{$configs['filter_min_salary']}}"
                                                   data-max="{{$configs['filter_max_salary']}}"
                                                   data-prefix="$"/>
                                            <input type="hidden" name="min_salary" id="min_salary">
                                            <input type="hidden" name="max_salary" id="max_salary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="search-btn w-25">
                                <button class="btn btn-primary btn-search">{{__('frontPage.searchJob')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="text-left d-flex align-items-center mt-3">
                    <span class="font-weight-semibold font-16 mr-2">{{__('frontPage.popular')}}:</span>
                    <ul class="default-ul d-flex align-items-center">
                        <li class="mr-1">PHP,</li>
                        <li class="mr-1">Laravel,</li>
                        <li class="mr-1">Javascript,</li>
                        <li class="mr-1">React Js,</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="home-slide-image text-center">
                    <img src="https://wp.alithemes.com/html/jobbox/demos/assets/imgs/page/job-single/right-job-head.svg"
                         alt="">
                </div>
            </div>
        </div>
    </div>
</div>
