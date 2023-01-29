<div class="card hover-up mb-2">
    <div class="d-flex p-2">
        <div class="card-left mr-2">
            <div class="card-logo">
                <div class="card-image-logo">
                    <a class="text-dark" href="{{route('company.show',$post->company->id)}}">
                        <img width="50px" src="{{asset('storage/'.$post->company->logo)}}" alt="{{$post->company->name}}">
                    </a>
                </div>
            </div>
        </div>
        <div style="flex: auto" class="card-right">
            <div class="post-heading">
                <a class="text-dark" href="{{route('jobs-show', $post->slug)}}">
                    <h3 class="font-weight-semibold font-18 text-vertical l-1 m-0">{{$post->job_title}}</h3>
                </a>
                <a class="text-dark" href="{{route('company.show',$post->company->id)}}">
                    <h4 class=" font-weight-semibold font-16 text-vertical l-1">{{$post->company->name}}</h4>
                </a>
            </div>

            <ul class="default-ul mt-1 job-skills">
                @foreach($languages as $language)
                    <li class="btn btn-sm bg-light font-12 mb-1 font-weight-semibold">{{$language}}</li>
                @endforeach
            </ul>
            <div class="d-flex justify-content-between align-items-center">
                <span class="h5 text-primary font-weight-bold job-offer">{{$post->salary}}</span>
                <p class="m-0"><i class="mdi mdi-map-marker-outline"> </i> {{$post->location}} </p>
            </div>
        </div>
    </div>

</div>
