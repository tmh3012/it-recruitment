<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ isset($title) ? $title .' - '. config('app.name', 'Laravel') : config('app.name', 'Laravel')}}</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/app-creative.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/c-slick.css')}}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="{{ asset('themeMain/style.css') }}" rel="stylesheet" type="text/css">
    @stack('css')
</head>
<body>
<div id="page">
    @include('themeMain.header')
    <section class="main-content mb-3">
        <section class="content">
            @yield('content')
        </section>
    </section>
    @include('themeMain.footer')
</div>

<!-- bundle -->
<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>
<script src="{{asset('js/slick.min.js')}}"></script>
<script src="{{asset('js/validator.js')}}"></script>
<script>
    window.editors = {};
    document.querySelectorAll('.ckeditor').forEach((el, index) => {
        ClassicEditor
            .create(el)
            .then(newEditor => {
                window.editors[index] = newEditor
            })
            .catch(error => {
                console.error(error);
            });
    })
    const header = document.querySelector('#header')
    const headerX = header.offsetHeight;
    window.onscroll = function () {
        let scrollTop = Math.round(this.scrollY);
        if (scrollTop > (headerX * 2)) {
            header.classList.add('fixed');
        } else {
            header.classList.remove('fixed');
        }
    }
</script>
@stack('js')
</body>
</html>
