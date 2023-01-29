<div class="card hover-up">
    <div class="card-body">
        <div class="job-company d-flex">
            <div class="block-left mr-2">
                <a class="text-dark" href="{{route('company.show',$company->id)}}">
                    <div class="job-company__logo img-box">
                        <img src="{{asset('storage/'.$post->company->logo)}}" alt="{{$post->job_title}}">
                    </div>
                </a>
            </div>
            <div class="block-left">
                <a class="text-dark" href="{{route('company.show',$company->id)}}">
                    @isset($company)
                        <h4 class="text-capitalize m-0 text-vertical l-1">{{$company->name}}</h4>
                    @endisset
                </a>
                <p class="mt-1"><i class="mdi mdi-map-marker-outline"> </i> {{$post->location}} </p>
            </div>
        </div>
        <a class="text-link text-cl-main" href="{{route('jobs-show', $post->slug)}}">
            <h4 class="job-title text-capitalize text-vertical l-2">{{$post->job_title}}</h4>
        </a>
        <div class="mt-2">
            <div class="job-time">
                <i class="mdi mdi-briefcase-clock-outline mr-sm-1"></i>
                <span class="job-time">{{$post->workingTime}}</span>
            </div>
        </div>

        <ul class="default-ul mt-3 job-skills">
            @foreach($languages as $language)
                <li class="btn btn-sm bg-light font-12 mb-1 font-weight-semibold">{{$language}}</li>
            @endforeach
        </ul>

        <div class="mt-1 d-flex flex-wrap">
            <span class="h5 text-primary text-left font-weight-bold job-offer">{{$post->salary}}</span>
            <a href="{{route('jobs-show', $post->slug)}}" class="btn btn-apply bg-light text-right ml-auto text-primary font-sm">Apply Now</a>
        </div>
    </div>

</div>
