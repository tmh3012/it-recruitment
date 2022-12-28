<div class="card hover-up">
    <div class="card-body">
        <a href="{{route('jobs-show', $relatedPost)}}">
            <h4 class="text-cl-main text-vertical l-1">{{$relatedPost->job_title}}</h4>
        </a>
        <div class="mt-2">
            <div class="job-time">
                <i class="mdi mdi-briefcase-clock-outline mr-sm-1"></i>
                <span class="job-time">{{$relatedPost->workingTime}}</span>
            </div>
        </div>
        <ul class="default-ul mt-3 job-skills">
            @foreach($languages as $language)
                <li class="btn btn-sm bg-light mb-1 font-12 font-weight-semibold">{{$language}}</li>
            @endforeach
        </ul>
        <div class="d-flex justify-content-between align-items-center">
            <span class="h5 text-primary font-weight-bold job-offer">{{$relatedPost->salary}}</span>
            <p class="m-0"><i class="mdi mdi-map-marker-outline"> </i> {{$relatedPost->location}} </p>
        </div>
    </div>
</div>
