@extends('client.share.master')
@section('noi_dung')
    <div id="app">
        <section class="page-title">
            <div class="auto-container">
                <h2>Shop Detail</h2>
                <ul class="bread-crumb clearfix">
                    <li><a href="index.html">Home</a></li>
                    <li>Pages</li>
                    <li>Shop Details</li>
                </ul>
            </div>
        </section>
        <hr class="mt-1">
        <section class="shop-detail-section">
            <div class="auto-container">
                <!-- Upper Box -->
                <div class="upper-box">
                    <div class="row clearfix">
                        <!-- Gallery Column -->
                        <div class="gallery-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <div class="carousel-outer">
                                    <!-- Swiper -->
                                    <div class="swiper-container content-carousel">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <figure class="image"><a href="images/resource/products/35.png"
                                                        class="lightbox-image"><img style="height: 450px"
                                                            v-bind:src="dataDetail.hinh_anh" alt=""></a></figure>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Content Column -->
                        <div class="content-column col-lg-6 col-md-12 col-sm-12">
                            <div class="inner-column">
                                <h3>@{{ dataDetail.ten_hang_hoa }}</h3>
                                <!-- Rating -->
                                <!-- Price -->
                                <div class="price"><b>Giá Bán: </b> @{{ vnd(dataDetail.gia_hang_hoa) }}</div>
                                <div class="text">@{{ dataDetail.mo_ta }}</div>
                                <!-- Categories -->
                                <div class="d-flex align-items-center flex-wrap">
                                    <!-- Button Box -->
                                    <div class="button-box">
                                        <a v-on:click="themgio1(dataDetail.id, number)" class="theme-btn btn-style-one">
                                            <i style="margin-right: 12px" class="fa-solid fa-cart-arrow-down fa-beat"></i>THÊM VÀO GIỎ
                                        </a>
                                    </div>
                                    <i v-on:click="tru1()" class="fa-solid fa-minus m-2"></i>
                                    <input v-model="number" class="form-control text-center" style="width:50px;" type="text"
                                        value="1">
                                    <i v-on:click="cong1()" class="fa-solid fa-plus m-2"></i>
                                </div>
                            </div>
                            <div style="height: 10px; background-color: #ccc;" class="mt-4">
                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Upper Box -->


            </div>
        </section>
        <hr class="mt-1">
        <section class="products-section-six">
            <div class="auto-container">
                <!-- Sec Title -->
                <div class="sec-title">
                    <h4><span>___SẢN PHẨM LIÊN QUAN !</h4>
                </div>
                <div class="row clearfix">
                    <template v-for="(v, k) in dataSame">
                        <div class="shop-item-two col-lg-3 col-md-6 col-sm-12">
                            <div class="inner-box">
                                <div class="image">
                                    <a v-bind:href="'/detail/' + v.id"><img style="height:200px;" v-bind:src="v.hinh_anh"
                                            alt="" /></a>
                                </div>
                                <div class="content">
                                    <h6><a v-bind:href="'/detail/' + v.id">@{{ v.ten_hang_hoa }}</a></h6>
                                    <div class="lower-box">
                                        <div class="price">@{{ vnd(v.gia_hang_hoa) }}</div>
                                        <div class="d-flex justify-content-end">
                                            <button v-on:click="tru(v.id, k)" class="btn btn-outline-secondary" style="margin-right: 2px"><i
                                                    class="fa-solid fa-minus"></i></button>
                                            <input v-bind:data-index='k' class="form-control text-center" disabled
                                                value="1" style="width:40px;" type="text" ref="inputRefs">
                                            <button v-on:click="cong(v.id, k)" class="btn btn-outline-secondary" style="margin-left: 2px"><i
                                                    class="fa-solid fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="d-flex justify-content-center">
                                        <button v-on:click="themgio(v.id, k)" class="btn btn-outline-danger"><i style="margin-right: 12px" class="fa-solid fa-cart-arrow-down fa-beat"></i> THÊM VÀO
                                            GIỎ</button>
                                    </div>
                                    <!-- Select Size -->

                                    <!-- Select Size -->
                                </div>
                            </div>
                        </div>
                </div>
                </template>
            </div>
    </div>
    </section>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - Chi Tiết Sản Phẩm';
        })
    </script>
    <script>
        new Vue({
            el: '#app',
            data: {
                number: 1,
                dataDetail: {},
                dataSame: []
            },
            created() {
                this.loadData();
            },
            methods: {
                loadData() {
                    var currentURL = window.location.href;
                    var urlParts = currentURL.split('/');
                    var number = urlParts[urlParts.length - 1];
                    var id = {
                        'id': number
                    }
                    axios
                        .post('{{ Route('dataDetailPage') }}', id)
                        .then((res) => {
                            this.dataDetail = res.data.data;
                            this.dataSame = res.data.dataSame;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                vnd(number) {
                    if (number) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number)
                    } else {
                        return 0;
                    }
                },
                cong(payload, stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value++;
                    }
                },
                tru(payload, stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value > 1 ? input.value-- : 0;
                    }
                },
                cong1() {
                   this.number++;
                },
                tru1() {
                    this.number > 1 ? this.number-- : 0;
                },
                themgio1(id, number) {
                    var post = {
                        'id': id,
                        'so_luong': number
                    }
                    axios
                        .post('{{ Route('taoDonDatMon') }}', post)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                            } else {
                                toastr.error(res.data.message, 'Error');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                themgio(payload, stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        var post = {
                            'id': payload,
                            'so_luong': input.value
                        }
                        axios
                            .post('{{ Route('taoDonDatMon') }}', post)
                            .then((res) => {
                                if (res.data.status) {
                                    toastr.success(res.data.message, 'Success');
                                } else {
                                    toastr.error(res.data.message, 'Error');
                                }
                            })
                            .catch((res) => {
                                $.each(res.response.data.errors, function(k, v) {
                                    toastr.error(v[0], 'Error');
                                });
                            });
                    }
                }
            },
        });
    </script>
@endsection
