@extends('themeMain.master')
@section('content')
    <div class="blog-page">
        <div class="block-bg-top">
            <img src="../img/img-single.png" alt="">
        </div>
        <div class="container">
            <div class="blog-main bg-white p-3 mt-md-2">
                <div class="blog-detail">
                    <h1 class="title text-cl-main text-center">{{$blog->title}}</h1>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="blog-date mr-2"><i class="fa-regular fa-calendar-days mr-1"></i><span>{{$createDate}}</span></div>
                        <div class="blog-date mr-2 mr-1"><i class="fa-regular fa-clock mr-1"></i><span>{{$createDiffTime}}</span></div>
                    </div>
                    <p class="font-weight-semibold h4 description">{{$blog->description}}</p>
                    <div class="tab-content">
                        {!! $blog->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="text/javascript">

    </script>
@endpush
