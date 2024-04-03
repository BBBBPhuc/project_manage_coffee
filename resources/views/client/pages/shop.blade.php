@extends('client.share.master')
@section('noi_dung')
    <div id="app_shop">
        <div class="sidebar-page-container">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="content-side col-lg-9 col-md-12 col-sm-12">

                        <div class="filter-box">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <div class="left-box d-flex align-items-center">
                                    <div class="results">Showing 1–12 of 54 results</div>
                                </div>
                            </div>
                        </div>
                        <div class="shops-outer">
                            <div class="row clearfix">
                                <template v-for="(v, k) in list_items">

                                    <div class="shop-item col-lg-4 col-md-4 col-sm-12">
                                        <div class="inner-box">
                                            <hr>
                                            <div class="image">
                                                <a href="shop-detail.html"><img style="height: 300px" v-bind:src="v.hinh_anh"
                                                        alt="" /></a>
                                            </div>
                                            <div class="lower-content">
                                                <h6><a href="shop-detail.html">@{{ v.ten_hang_hoa }}</a></h6>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="price">@{{vnd(v.gia_hang_hoa)}}</div>
                                                    <!-- Quantity Box -->

                                                    <div class="d-flex justify-content-end">
                                                        <button v-on:click="tru(k)" class="btn btn-outline-secondary" style="margin-right: 2px"><i
                                                                class="fa-solid fa-minus"></i></button>
                                                        <input class="form-control text-center" disabled
                                                            value="1" style="width:40px;" type="text" ref="inputRefs">
                                                        <button v-on:click="cong(k)" class="btn btn-outline-secondary" style="margin-left: 2px"><i
                                                                class="fa-solid fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="d-flex justify-content-center">
                                                    <button v-on:click="themgio(v.id, k)" class="btn btn-outline-danger"><i style="margin-right: 12px" class="fa-solid fa-cart-arrow-down fa-beat"></i> THÊM VÀO
                                                        GIỎ</button>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>

                            <!-- Styled Pagination -->
                            <ul class="styled-pagination text-center">
                                <li class="next"><a href="#"><span class="fa fa-angle-double-left"></span></a></li>
                                <li><a href="#" class="active">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li class="next"><a href="#"><span class="fa fa-angle-double-right"></span></a></li>
                            </ul>
                            <!-- End Styled Pagination -->

                        </div>

                    </div>

                    <!-- Sidebar Side -->
                    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
                        <aside class="sidebar sticky-top">
                            <div class="sidebar-widget trending-widget">
                                <div class="widget-content">
                                    <div class="content">
                                        <div class="vector-icon" style="background-image: url(images/icons/vector-3.png)">
                                        </div>
                                        <div class="title">Trending</div>
                                        <h4>2022 <span>Laptop</span> <br> Collection</h4>
                                        <a class="buy-btn theme-btn" href="#">Buy Now</a>
                                        <div class="icon">
                                            <img src="/assets_client/images/resource/lamp-4.png" alt="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Category Widget -->
                            <div class="sidebar-widget category-widget">
                                <div class="widget-content">
                                    <!-- Sidebar Title -->
                                    <div class="sidebar-title">
                                        <h6>Product Catagories</h6>
                                    </div>
                                    <!-- Category List -->
                                    <ul class="category-list">
                                        <template v-for="(v, k) in list_types">
                                            <li><a href="">@{{v.ten_loai_hang}}<span>(@{{v.so_luong}})</span></a></li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                            <!-- Trending Widget -->
                        </aside>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - Cửa Hàng Sản Phẩm';
        })
    </script>
    <script>
        new Vue({
            el      :   '#app_shop',
            data    :   {
                list_items: [],
                list_types: [],
            },
            created()   {
                this.loadData();
            },
            methods :   {
                loadData() {
                    axios
                        .post('{{Route('dataShopPage')}}')
                        .then((res) => {
                            this.list_items = res.data.items;
                            this.list_types = res.data.types;
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                vnd(number) {
                    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number)
                },
                cong(stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value++;
                    }
                },
                tru(stt) {
                    var input = this.$refs.inputRefs[stt];
                    if (input) {
                        input.value > 1 ? input.value-- : 0;
                    }
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
