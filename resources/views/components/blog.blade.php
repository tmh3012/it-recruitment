<div class="card hover-up">
    <div class="card-company rounded overflow-hidden">
        <div class="card-top">
            <a href="{{route('blog.show',$blog->slug)}}">
                <div class="company-cover">
                    <img src="{{asset('storage/'.$blog->image)}}" alt="{{$blog->name}}">
                </div>
            </a>
        </div>
        <div class="card-body">
            <a class="text-link text-cl-main" href="{{route('blog.show',$blog->slug)}}">
                <h3 class="font-18 text-uppercase font-weight-bold ">{{$blog->title}}</h3>
            </a>
            <div class="company-description">
                @isset($blog->description)
                    <a class="text-dark" href="{{route('blog.show', $blog->slug)}}">
                        <p class="text-justify text-vertical l-des">"{{Str::words($blog->description, 60)}}"</p>
                    </a>
                @endisset
            </div>
        </div>
    </div>
</div>
