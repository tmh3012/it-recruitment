<div id="experience-block">
    <h3 class="text-uppercase font-18"><i class="mdi mdi-briefcase me-1"></i>
        Experience</h3>
    <div class="box-timeline experience">
        @foreach($experiences as $experience)
            <div class="timeline-items" data-id="{{$experience->id}}">
                <div class="timeline-year">
                    <span class="h5 my-0"> {{$experience->start_date}} - {{$experience->end_date}}</span>
                </div>
                <div class="timeline-separation">
                    <i class="mdi mdi-circle timeline-icon"></i>
                </div>
                <div class="timeline-content">
                    <h5 class="title mb-3">{{$experience->position}}</h5>
                    @if(!empty($experience->company))
                        <div class="job-company d-flex">
                            <div class="block-left mr-2">
                                <a class="text-dark"
                                   href="{{route('company.show',$experience->company->id)}}">
                                    <div class="job-company__logo img-box">
                                        <img src="{{$experience->company->logo}}">
                                    </div>
                                </a>
                            </div>
                            <div class="block-left">
                                <a class="text-dark"
                                   href="{{route('company.show',$experience->company->id)}}">
                                    <h5 class="text-capitalize m-0 text-vertical l-1">{{$experience->company->name}}</h5>
                                </a>
                                <p class="mt-1"><i class="mdi mdi-map-marker-outline"> </i>
                                    {{$experience->company->location}} </p>
                            </div>
                        </div>
                    @else
                        <div class="job-company d-flex mb-2">
                            <div class="block-left mr-2">
                                <i class="fa-regular fa-building fa-2xl"></i>
                            </div>
                            <div class="block-left">
                                <h5 class="text-capitalize m-0 text-vertical l-1">{{$experience->title}}</h5>
                            </div>
                        </div>
                    @endif
                    <p class="description">
                        {{$experience->description}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
