<section class="main-slider-three">
    <div class="container">
        <div class="main-slider-carousel owl-carousel owl-theme">
            @foreach ($data_products as $key => $value)
                <div class="slide">
                    <div class="row clearfix">
                        <!-- Content Column -->
                        <div class="content-column col-lg-5 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="vector-icon"
                                    style="background-image: url(/assets_client/images/main-slider/vector-5.png)"></div>
                                <div class="title">100% organic Food</div>
                                <h1>{{ $value->ten_hang_hoa }}</h1>
                                <div class="text">{{ $value->mo_ta }}</div>
                                <div class="price slider">Starting From <span>{{ $value->gia_hang_hoa }}</span>
                                </div>
                                <!-- Button Box -->
                                <div class="button-box">
                                    <a href="/detail/{{ $value->id }}" class="theme-btn btn-style-one">
                                        Đặt Món Này! <span class="icon flaticon-right-arrow"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Image Column -->
                        <div class="image-column col-lg-7 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="circle-box"></div>
                                <div class="vector-icon-two"
                                    style="background-image: url(/assets_client/images/icons/pattern-1.png)"></div>
                                <div class="vector-icon-three"
                                    style="background-image: url(/assets_client/images/main-slider/vector-6.png)"></div>
                                <div class="image" style="margin-left: 50px; margin-bottom: 20px">
                                    <img class="mb-5" style="height: 470px;width: 550px" src="{{ $value->hinh_anh }}"
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    </div>
</section>
<script>
    $(document).ready(function() {
        $('#priceSile').innerText;
        function vnd(number) {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(number)
        }
        // console.log($('#priceSile')[0].innerText);
        var i = 0;
        var minNumber = 0;
        while(true) {
            var a = $('.price.slider')[i].innerText;
            var valueNumber =  parseFloat(a.slice(14));
            $('.price.slider')[i].innerText = vnd(valueNumber);
            i++;
            if (i > $('.price.slider').length) {
                break;
            }
        }
    });
</script>
