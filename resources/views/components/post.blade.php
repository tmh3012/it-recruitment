
    <div class="card hover-up">
        <div class="card-body">
            <div class="job-company d-flex">
                <div class="block-left mr-2">
                    <div class="job-company__logo img-box">
                        <img src="https://wp.alithemes.com/html/jobbox/demos/assets/imgs/brands/brand-1.png" alt="logo-company-name">
                    </div>
                </div>
                <div class="block-left">
                    <a class="text-link text-cl-main" href="#">
                        @isset($company)
                            <h4 class="text-capitalize m-0 text-vertical l-1">{{$company->name}}</h4>
                        @endisset
                    </a>
                    <p class="mt-1"><i class="mdi mdi-map-marker-outline"> </i> {{$post->location}} </p>
                </div>
            </div>
            <a class="text-link text-cl-main" href="{{route('jobs-show', $post)}}">
                <h4 class="job-title text-capitalize text-vertical l-2">{{$post->job_title}}</h4>
            </a>
            <div class="mt-2">
                <div class="job-time">
                    <i class="mdi mdi-briefcase-clock-outline mr-sm-1"></i>
                    <span class="job-time">{{$post->workingTime}}</span>
                </div>
            </div>
            <p class="mt-2 job-description font-sm d-none">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae architecto
                eveniet, dolor quo repellendus pariatur
            </p>
            <ul class="default-ul mt-3 job-skills">
                @foreach($languages as $language)
                    <li class="btn btn-sm bg-light font-12 mb-1 font-weight-semibold">{{$language}}</li>
                @endforeach
            </ul>
            <div class="mt-4 row no-gutters align-items-center d-none">
                <div class="col-md-7 col-sm-12">
                    <span class="h5 text-primary font-weight-bold job-offer">{{$post->salary}}</span>
                </div>
                <div class="col-md-5 col-sm-12">
                    <button class="btn btn-apply bg-light d-block ml-auto text-primary font-sm">Apply Now</button>
                </div>
            </div>

                <div class="mt-1 d-flex flex-wrap">
                    <span class="h5 text-primary text-left font-weight-bold job-offer">{{$post->salary}}</span>
                    <button class="btn btn-apply bg-light text-right ml-auto text-primary font-sm">Apply Now</button>
                </div>
            </div>

    </div>
