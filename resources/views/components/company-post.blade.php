<div class="card hover-up">
    <div class="card-company rounded overflow-hidden">
        <div class="card-top">
            <a href="{{route('company.show',$company)}}">
                <div class="company-cover">
                    <img src="{{asset('storage/'.$company->cover)}}" alt="{{$company->name}}">
                </div>
            </a>
            <div class="company-ava">
                <a href="{{route('company.show',$company)}}">
                    <img src="{{asset('storage/'.$company->logo)}}" alt="{{$company->name}}">
                </a>
            </div>
        </div>
        <div class="card-body">
            <a class="text-link text-cl-main" href="{{route('company.show',$company)}}">
                <h3 class="font-18 text-uppercase font-weight-bold ">{{$company->name}}</h3>
            </a>
            <div class="company-description">
                @isset($company->over_view)
                    <p class="text-justify text-vertical l-des">"{{Str::words($company->over_view, 70)}}"</p>
                @endisset
            </div>
        </div>
    </div>
</div>
