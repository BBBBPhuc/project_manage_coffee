@extends('client.share.master')
@section('noi_dung')
    <section style="height: 100px" class="page-title">
        <div class="auto-container">
            <h2>GIỎ HÀNG CỦA TÔI</h2>
            <ul class="bread-crumb clearfix">
                <li><a href="/">HOME</a></li>
                <li>GIỎ HÀNG</li>
            </ul>
        </div>
    </section>
    <div id="app_order">
        <section class="shoping-cart-section">
            <div class="auto-container">
                <div class="row clearfix">

                    <!-- Cart Column -->
                    <div class="cart-column col-lg-8 col-md-12 col-sm-12">
                        <div class="inner-column">

                            <!--Cart Outer-->
                            <div class="cart-outer">
                                <div class="table-outer">
                                    <table class="cart-table">
                                        <thead class="cart-header">
                                            <tr>
                                                <th class="prod-column">MÓN ĐÃ ĐẶT</th>
                                                <th>&nbsp;</th>
                                                <th>GIÁ BÁN</th>
                                                <th>SỐ LƯỢNG</th>
                                                <th>SỐ TIỀN</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <template>
                                                <tr v-for="(v, k) in list_order">
                                                    <td colspan="2" class="prod-column text-center align-middle">
                                                        <div class="column-box">
                                                            <figure class="prod-thumb">
                                                                <span v-on:click="xoaMon(v.id, k)" class="cross-icon flaticon-cancel-1"></span>
                                                                <a href="#"><img v-bind:src="v.hinh_anh"
                                                                        alt=""></a>
                                                            </figure>
                                                            <h6 class="prod-title">@{{ v.ten_hang_hoa }}</h6>
                                                            <div class="prod-text">Color : Brown <br> Số lượng :
                                                                @{{ v.so_luong }}</div>
                                                        </div>
                                                    </td>

                                                    <td class="price">@{{ vnd(v.gia_hang_hoa) }}</td>
                                                    <!-- Quantity Box -->
                                                    <td
                                                        class="quantity-box d-flex justify-content-center align-items-center col-md-5 mt-4">
                                                        <i v-on:click="tru(v.gia_hang_hoa, k)"
                                                            class="fa-solid fa-minus m-2"></i>
                                                        <input v-model="v.so_luong" class="form-control text-center inputSL"
                                                            style="width:50px;" type="text">
                                                        <i v-on:click="cong(v.gia_hang_hoa, k)"
                                                            class="fa-solid fa-plus m-2"></i>
                                                    </td>
                                                    <td class="sub-total">@{{ vnd(v.gia_hang_hoa * v.so_luong) }}</td>
                                                </tr>
                                            </template>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Total Column -->
                    <div class="total-column col-lg-4 col-md-12 col-sm-12">
                        <div class="inner-column">

                            <!-- Cart Total Outer -->
                            <div class="cart-total-outer">
                                <!-- Title Box -->
                                <div class="title-box">
                                    <h6>Cart Totals</h6>
                                </div>
                                <div class="cart-total-box">
                                    <ul class="cart-totals">
                                        <li>Số Lượng Món Hàng : <span>@{{ sizes }}</span></li>
                                        <li>Số Tiền Cần Thanh Toán : <span class="total-dondathang">@{{ vnd(totals.tong_tien) }}</span></li>
                                    </ul>
                                    <div id="iconLoad" class="mb-3 mt-3 d-none">
                                        <i style="margin-right: 10px" class="fa-solid fa-circle-notch fa-spin fa-lg"></i>
                                        <label for="type-1"><h6>Vui Lòng Đợi Trong Giây Lát...</h6></label>
                                    </div>
                                    <!-- Buttons Box -->
                                    <div class="buttons-box text-center">
                                        <a v-on:click="thanhtoan()" class="theme-btn proceed-btn">
                                            THANH TOÁN ĐƠN ĐẶT
                                        </a>
                                    </div>
                                    <div class="mt-3 text-center" id="QRCode">
                                        <button class="btn btn-outline-success d-none" disabled><h6>Quét Nhanh Mã QR</h6></button>
                                        <img src="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('title')[0].innerText = 'LC - Giỏ Hàng Của Tôi';

        })
    </script>
    <script>
        new Vue({
            el: '#app_order',
            data: {
                sizes: 0,
                totals: {},
                list_order: [],
            },
            created() {
                this.loadData()
            },
            methods: {
                loadData() {
                    axios
                        .post('{{ Route('dataDonDatMon') }}')
                        .then((res) => {
                            this.list_order = res.data.data;
                            this.soLuong();
                            this.cardTotal();
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0], 'Error');
                            });
                        });
                },
                cong(payload, stt) {
                    var a = ++this.list_order[stt].so_luong;
                    this.list_order[stt].tong_tien = a * this.list_order[stt].gia_hang_hoa;
                    this.cardTotal()
                },
                tru(payload, stt) {
                    var a = this.list_order[stt].so_luong;
                    a > 1 ? --this.list_order[stt].so_luong : 0;
                    this.list_order[stt].tong_tien = a * this.list_order[stt].gia_hang_hoa;
                    this.cardTotal()
                },
                cardTotal() {
                    this.totals.tong_tien = 0;
                    for (var i = 0; i < this.sizes; i++) {
                        this.totals.tong_tien += (this.list_order[i].gia_hang_hoa * this.list_order[i].so_luong);
                    }
                },
                soLuong() {
                    this.sizes = this.list_order.length;
                },
                xoaMon(id, k) {
                    var key = {
                        'id' : id
                    }
                    axios
                        .post('{{Route('eraseDonDatMon')}}', key)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                this.list_order.splice(k, 1);
                                this.soLuong();
                                this.cardTotal();
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
                vnd(number) {
                    if (number > 0) {
                        return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
                    } else {
                        return 0;
                    }
                },
                thanhtoan() {
                    $('#iconLoad').eq(0).removeClass('d-none');
                    axios
                        .post('{{Route('taoHoaDon')}}', this.list_order)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message, 'Success');
                                $('#iconLoad').eq(0).addClass('d-none');
                                $('#btnQR').eq(0).removeClass('d-none');
                                $('#QRCode button').eq(0).removeClass('d-none');
                                $('#QRCode img')[0].src = `https://img.vietqr.io/image/agribank-4502281004484-compact.jpg?amount=${res.data.codeOrder.tong_tien}&addInfo=${res.data.codeOrder.ma_hoa_don}&accountName=Nguyen%20Thai%20Bao%20Phuc`
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
            },
        });
    </script>
@endsection
