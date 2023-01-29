<footer id="footer" class="bg-white pt-3">
    <div class="container">
        <div class="footer-newsletter">
            <div class="row">
                <div class="col-xl-3 text-center d-none d-xl-block">
                    <img src="../img/newsletter-left.png" alt="">
                </div>
                <div class="col-md-6 col-12">
                    <h2 style="line-height: inherit;" class="text-center text-white text-uppercase mb-3">
                        {!! (__('frontPage.footerNewsletterHeading')) !!}
                    </h2>
                    <form action="" class="form-newsletter" id="form-newsletter">
                        <i class="fa-solid fa-envelope text-black-50"></i>
                        <input type="text" placeholder="{{__('frontPage.placeholderNewsletter')}}"
                               class="form-newsletter__input">
                        <button class="btn btn-primary form-newsletter__button">
                            <i class="fa-regular fa-circle-check"></i>
                            {{__('frontPage.footerNewsletterButton')}}
                        </button>
                    </form>
                </div>
                <div class="col-xl-3 text-center d-none d-xl-block">
                    <img src="../img/newsletter-right.png" alt="">
                </div>
            </div>
        </div>

        <div class="footer-main mt-3 pb-3">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-4">
                        <div class="footer-left">
                            <a href="{{route('home')}}">
                                <h2 class="text-cl-main font-24">IT Recruitment</h2>
                            </a>
                            <p class="description mt-2">JobBox is the heart of the design community and the best
                                resource to discover and connect with designers and jobs worldwide.</p>
                        </div>
                        <div class="footer-social">
                            <ul class="default-ul d-flex">
                                <li class="mr-2"><a href="#"><i class="fa-brands fa-facebook text-primary font-24"></i></a>
                                </li>
                                <li class="mr-2"><a href="#"><i
                                            class="fa-brands fa-square-twitter text-primary font-24"></i></a></li>
                                <li class="mr-2"><a href="#"><i class="fa-brands fa-linkedin text-primary font-24"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6 ">
                        <h3 class="text-cl-main font-16 font-weight-bold mb-2">{{__('frontPage.quickLinks')}}</h3>
                        <ul class="default-ul d-flex">
                            <li class="font-weight-normal font-18 mr-2 ">
                                <a class="text-dark" href="{{route('home')}}">{{__('frontPage.homePage')}}</a>
                            </li>
                            <li class="font-weight-normal font-18 mr-2 ">
                                <a class="text-dark" href="{{route('jobs-page')}}">{{__('frontPage.jobsPage')}}</a>
                            </li>

                            <li class="font-weight-normal font-18 mr-2 ">
                                <a class="text-dark" href="{{route('company.index')}}">{{__('frontPage.companyPage')}}</a>
                            </li>
                            <li class="font-weight-normal font-18 mr-2 ">
                                <a class="text-dark" href="">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p class="text-left">&#169; Laravel Course From J2Team | Project IT Recruitment</p>
        <p class="text-right"><u>Made with <i class="fas fa-heart"></i> by TMH</u> </p>
    </div>
</footer>
