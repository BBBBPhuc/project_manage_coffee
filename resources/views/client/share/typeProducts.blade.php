<section class="products-section-two">
    <div class="bottom-white-border"></div>
    <div class="auto-container">
        <!-- Sec Title -->
        <div class="sec-title centered">
            <h4><span>Populer</span> Products For You !</h4>
        </div>
        <div class="inner-container">
            <div class="single-item-carousel owl-carousel owl-theme">
                <!-- Slide -->
                <div class="slide">
                    <div class="row clearfix">
                        @foreach ($data_types as $key => $value)
                            <!-- Product Block Four -->
                            <div class="product-block-four col-lg-3 col-md-6 col-sm-6">
                                <div class="inner-box d-flex justify-content-between align-items-center flex-wrap">
                                    <div class="image">
                                        <span class="number">{{ $key + 1 }}</span>
                                        <img style="height: 90px; width: 90px;" src="{{ $value->hinh_anh }}" alt="" />
                                    </div>
                                    <div class="content">
                                        <h6><a href="/assets_client/shop-detail.html">{{ $value->ten_loai_hang }}</a>
                                        </h6>
                                        <div class="total-products">({{ $value->so_luong }} Product)</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
