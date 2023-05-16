@foreach($education as $key => $values)
    <div id="{{$key}}-block" class="mt-3">
        <h3 class="text-uppercase font-18">
            <i class="mdi mdi-school-outline  mr-2"></i>
            {{$key}}
        </h3>
        <div class="box-timeline">
            @foreach($values as $each)
                <div class="timeline-items mt-2">
                    <div class="timeline-year">
                        <span class="h5 my-0"> {{$each->start_date}} - {{$each->end_date}}</span>
                    </div>
                    <div class="timeline-separation">
                        <i class="mdi mdi-circle timeline-icon"></i>
                    </div>
                    <div class="timeline-content pr-2">
                        <h5 class="title mb-3">
                            <span class="title-icon mr-1"> <i class="fa-solid fa-graduation-cap fa-xl"></i></span>
                            {{$each->title}}
                        </h5>
                        <div class="job-company mb-2">
                            <h5 class="text-capitalize m-0 text-vertical l-1">{{$each->major}}</h5>
                        </div>
                        <p class="description"> {{$each->description}} </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

