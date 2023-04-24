@extends('themeMain.master')
@section('content')
    <div class="profile bg-white" id="profile">
        <div class="header-introduction slide-block">
            <div class="container">
                <div class="d-flex align-items-center pt-4">
                    <div class="caption px-5">
                        <h1 class="text-primary font-weight-semibold">{{$title}}</h1>
                        <h2 class="caption">
                            Công cụ tạo dấu ấn cá nhân, gây ấn tượng với nhà tuyển dụng
                        </h2>
                        <p class="description">
                            TopCV Profile là bản hồ sơ năng lực giúp bạn xây dựng thương hiệu cá nhân,
                            thể hiện thế mạnh của bản thân thông qua việc đính kèm các dự án,
                            sản phẩm đã thực hiện - điều mà CV chưa thể hiện được. Chi tiết hơn,
                            ấn tượng hơn và hiệu quả hơn nữa.
                        </p>
                        <button class="btn btn-primary">
                            Khởi tạo E Profile
                            <i class="mdi mdi-arrow-right"></i>
                        </button>
                    </div>
                    <div class="image">
                        <img class=" w-100" src="https://www.topcv.vn/v4/image/profile/profile.png" alt="">
                    </div>
                </div>
            </div>

        </div>
        <div class="why-use pb-5">
            <div class="container"><h2 class="title text-center">Tại sao bạn nên sử dụng TopCV Profile</h2>
                <div class="content">
                    <div class="item d-flex">
                        <div class="caption"><h3 class="title">Cập nhật hình đại diện (Avatar) và ảnh bìa (Cover)</h3>
                            <div class="description">TopCV Profile là bản hồ sơ năng lực giúp bạn xây dựng thương
                                hiệu cá nhân, thể hiện thế mạnh của bản thân thông qua việc
                                đính kèm các dự án, sản phẩm đã thực hiện - điều mà CV chưa
                                thể hiện được. Chi tiết hơn, ấn tượng hơn và hiệu quả hơn nữa.
                            </div>
                        </div>
                        <div class="image"><img src="https://www.topcv.vn/v4/image/profile/1.png"
                                                alt="Cập nhật hình đại diện (Avatar) và ảnh bìa (Cover)"></div>
                    </div>
                    <div class="item d-flex item-reverse">
                        <div class="caption"><h3 class="title">Thêm video, đính link về dự án, sản phẩm</h3>
                            <div class="description">Đính kèm ảnh hay video vào hồ sơ sẽ rất tốn dung lượng,
                                đôi khi làm giảm chất lượng hay lỗi không đáng có. TopCV
                                Profile là một lựa chọn tối ưu. Khi bạn chỉ cần đính kèm link
                                và nhà tuyển dụng sẽ nhìn thấy phần prereview hấp dẫn.
                            </div>
                        </div>
                        <div class="image"><img src="https://www.topcv.vn/v4/image/profile/2.png"
                                                alt="Thêm video, đính link về dự án, sản phẩm"></div>
                    </div>
                    <div class="item d-flex">
                        <div class="caption"><h3 class="title">Theo dõi số liệu để hoàn thiện Profile</h3>
                            <div class="description">Bao nhiêu người đã xem và quan tâm tới thông tin của bạn?
                                Hãy để ý những con số biết nói này để cập nhật đúng lúc.
                                Giúp bạn đánh giá, hoàn thiện Profile thông qua báo cáo cập
                                nhật mỗi ngày, tiến gần tới công việc mơ ước
                            </div>
                        </div>
                        <div class="image"><img src="https://www.topcv.vn/v4/image/profile/3.png"
                                                alt="Theo dõi số liệu để hoàn thiện Profile"></div>
                    </div>
                </div>
                <div class="footer-content text-center">
                    <button class="btn btn-primary">Trải nghiệm ngay</button>
                </div>
            </div>
        </div>
    </div>
    @includeUnless(auth()->check(), 'modal.modalLogin')
@endsection
@push('css')
    <style>
        .header-introduction.slide-block {
            max-height: 350px !important;
        }
        .why-use .title {
            padding: 32px 0;
        }
        .why-use .item>div {
            flex: 0 0 50%;
            padding-left: 59px;
            padding-right: 59px;
        }
        .why-use .item div.caption .title {
            font-size: 19px;
            margin: initial;
            padding: 0;
        }
        .why-use .item {
            align-items: center;
            flex-flow: wrap;
            margin-bottom: 32px;
        }
        .item.item-reverse {
            flex-direction: row-reverse;
        }

    </style>

@endpush
